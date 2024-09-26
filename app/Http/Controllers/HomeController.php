<?php

namespace App\Http\Controllers;

use App\Traits\Cron;
use App\Job;
use DB;
use App\FavouriteCompany;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    use Cron;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->runCheckPackageValidity();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        
        $user_id = auth()->user()->id;
        $getUser = DB::table('users')->where('id',$user_id)->first();
        $getTitle = DB::table('functional_areas')->where('id',$getUser->functional_area_id)->first();
        $title = (!empty($getTitle->functional_area))?$getTitle->functional_area:'';
        $functional_area_id = (!empty($getTitle->functional_area_id))?$getTitle->functional_area_id:'';
        $current_salary = $getUser->current_salary;
        $expected_salary = $getUser->expected_salary;
        $country = $getUser->country_id;
        $state = $getUser->state_id;
        $city  = $getUser->city_id;
        $matchingJobs = Job::when($title, function ($query) use ($title) {
                return $query->where('title', 'LIKE', "%{$title}%");
            })
            ->when($current_salary, function ($query) use ($current_salary) {
                return $query->where('salary_from', '>=', $current_salary);
            })
            ->when($expected_salary, function ($query) use ($expected_salary) {
                return $query->where('salary_to',    '<=', $expected_salary);
            })
      
            ->when($title, function ($query) use ($functional_area_id) {
                return $query->orWhere('functional_area_id', $functional_area_id);
            })
            ->when($state, function ($query) use ($state) {
                return $query->orWhere('state_id', $state);
            })
            ->when($city, function ($query) use ($city) {
                return $query->orWhere('city_id', $city);
            })
            ->paginate(5);

		$followers = FavouriteCompany::where('user_id', auth()->user()->id)->limit(5)->get();
        $chart='';
        return view('home', compact('chart', 'matchingJobs', 'followers'));
    }

}
