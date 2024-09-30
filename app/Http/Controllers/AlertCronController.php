<?php

namespace App\Http\Controllers;

use App\Job;
use App\Alert;
use App\Industry;
use DB;
use Mail;
use App\Mail\AlertJobsMail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AlertCronController extends Controller
{

	public function index()
	{
		$get_permission = 1;
		$CheckPermission = sendnotification(2,"Alert Jobs",null,null,null,$get_permission);

		if($CheckPermission->email_notify != 1){
			echo 'plesae allow alert notifications'; die;
		}
		// Fetch users with functional areas using a left join
		$getusers = DB::table('users')
			->leftJoin('functional_areas', 'users.functional_area_id', '=', 'functional_areas.id')
			->select('users.id', 'users.name', 'users.email', 'functional_areas.functional_area as search_title', 'users.country_id', 'users.state_id', 'users.city_id', 'users.functional_area_id', 'users.created_at', 'users.updated_at')
			->get()
			->toArray();

		// Convert the array of users to an array of objects
		$users = array_map(fn($user) => (object)$user, $getusers);

		// Fetch alerts and convert to an array of objects
		$alerts = Alert::get()->toArray();
		$alerts = array_map(fn($alert) => (object)$alert, $alerts); // Convert alerts to objects

		// Merge users and alerts
		$mergedArray = array_merge_recursive($users, $alerts);

		if (!empty($mergedArray)) {
			foreach ($mergedArray as $alert) {
	        
				// Use is_object to check if $alert is an object and has search_title
				if (is_object($alert) && isset($alert->search_title)) {
					$search = $alert->search_title ?? '';
					$country_id = $alert->country_id ?? '';
					$state_id = $alert->state_id ?? '';
					$city_id = $alert->city_id ?? '';
					$functional_area_id = $alert->functional_area_id ?? '';

					// Build the query for jobs
					$query = Job::query()
						// ->orWhere('created_at', '>=', Carbon::now()->subDay())
						->orderBy('jobs.id', 'DESC');

					// Apply filters based on the provided criteria
					if ($search !== '') {
						$query->where('title', 'like', '%' . $search . '%');
					}
					if ($country_id !== '') {
						$query->where('country_id', $country_id);
					}
					if ($state_id !== '') {
						$query->where('state_id', $state_id);
					}
					if ($city_id !== '') {
						$query->where('city_id', $city_id);
					}
					if ($functional_area_id !== '') {
						$query->where('functional_area_id', $functional_area_id);
					}

					// Fetch jobs with a limit of 10
					$jobs = $query->active()->take(10)->get();
					// echo "<pre>";
					// print_r($jobs);
					// If jobs are found, prepare and send the email
					if ($jobs->isNotEmpty()) {
						$data = [
							'email' => $alert->email,
							'subject' => count($jobs) . ' new ' . $search . ' jobs in ',
							'jobs' => $jobs,
						];

						Mail::send(new AlertJobsMail($data));
					}
				}
			}
			// die;
		}
	}
}
