<?php

namespace App\Http\Controllers\Job;

use Auth;
use DB;
use Mail;
use Input;
use Redirect;
use App\Mail\ContactUs;
use Carbon\Carbon;
use App\Job;
use App\JobApply;
use App\FavouriteJob;
use App\Company;
use App\JobSkill;
use App\JobSkillManager;
use App\Country;
use App\CountryDetail;
use App\State;
use App\City;
use App\CareerLevel;
use App\FunctionalArea;
use App\JobType;
use App\JobShift;
use App\Gender;
use App\Seo;
use App\JobExperience;
use App\DegreeLevel;
use App\ProfileCv;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\JobFormRequest;
use App\Http\Requests\Front\ApplyJobFormRequest;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobs;
use App\Events\JobApplied;
use App\FavouriteCompany;
use Illuminate\Support\Arr;

class JobController extends Controller
{

    //use Skills;
    use FetchJobs;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['jobsBySearch', 'jobDetail', 'setStatus']]);

        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

    public function jobsBySearch(Request $request)
    {
        
        $search = $request->query('search', '');
        $job_titles = $request->query('job_title', array());
        $company_ids = $request->query('company_id', array());
        $industry_ids = $request->query('industry_id', array());
        $job_skill_ids = $request->query('job_skill_id', array());
        $functional_area_ids = $request->query('functional_area_id', array());
        $functionalAreaName = $request->input('functional_area_name');
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $is_freelance = $request->query('is_freelance', array());
        $career_level_ids = $request->query('career_level_id', array());
        $job_type_ids = $request->query('job_type_id', array());
        $job_shift_ids = $request->query('job_shift_id', array());
        $gender_ids = $request->query('gender_id', array());
        $degree_level_ids = $request->query('degree_level_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $salary_from = $request->query('salary_from', '');
        $salary_to = $request->query('salary_to', '');
        $salary_currency = $request->query('salary_currency', '');
        $is_featured = $request->query('is_featured', 2);
        $order_by = $request->query('order_by', 'id');        
        $limit = 16;
        $feature_jobs = Job::where('is_featured', 1)->notExpire()->get();
        

        
        $jobs = $this->fetchJobs($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, $order_by, $limit);
        

        /*         * ************************************************** */

        $jobTitlesArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.title');

        /*         * ************************************************* */

        $jobIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.city_id');

        /*         * ************************************************** */

        $companyIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.company_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIndustryIdsArray($companyIdsArray);

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.career_level_id');

        /*         * ************************************************** */

        $jobTypeIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_type_id');

        /*         * ************************************************** */

        $jobShiftIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_shift_id');

        /*         * ************************************************** */

        $genderIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.gender_id');

        /*         * ************************************************** */

        $degreeLevelIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.degree_level_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, 'jobs.job_experience_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $seo = Seo::where('seo.page_title', 'like', 'jobs')->first();
        return view('job.list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobs', $jobs)
                        ->with('jobTitlesArray', $jobTitlesArray)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        ->with('stateIdsArray', $stateIdsArray)
                        ->with('cityIdsArray', $cityIdsArray)
                        ->with('companyIdsArray', $companyIdsArray)
                        ->with('industryIdsArray', $industryIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('jobTypeIdsArray', $jobTypeIdsArray)
                        ->with('jobShiftIdsArray', $jobShiftIdsArray)
                        ->with('genderIdsArray', $genderIdsArray)
                        ->with('degreeLevelIdsArray', $degreeLevelIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('feature_jobs', $feature_jobs)
                        ->with('seo', $seo);                        
    }

    public function jobDetail(Request $request, $job_slug)
    {
        $user_id = (!empty(Auth::user()->id))?Auth::user()->id:'';
        $job = Job::where('slug', 'like', $job_slug)->firstOrFail();        
        $job_track_data = DB::table('job_apply')
        ->leftJoin('job_track', 'job_apply.id', '=', 'job_track.job_apply_id')
        ->select('job_track.created_at', 'job_track.status', 'job_track.id', 'job_apply.job_id')->where('job_apply.job_id',$job->id)->where('user_id',$user_id)->get();
        
        
        /*         * ************************************************** */
        $search = '';
        $job_titles = array();
        $company_ids = array();
        $industry_ids = array();
        $job_skill_ids = (array) $job->getJobSkillsArray();
        $functional_area_ids = (array) $job->getFunctionalArea('functional_area_id');
        $country_ids = (array) $job->getCountry('country_id');
        $state_ids = (array) $job->getState('state_id');
        $city_ids = (array) $job->getCity('city_id');
        $is_freelance = $job->is_freelance;
        $career_level_ids = (array) $job->getCareerLevel('career_level_id');
        $job_type_ids = (array) $job->getJobType('job_type_id');
        $job_shift_ids = (array) $job->getJobShift('job_shift_id');
        $gender_ids = (array) $job->getGender('gender_id');
        $degree_level_ids = (array) $job->getDegreeLevel('degree_level_id');
        $job_experience_ids = (array) $job->getJobExperience('job_experience_id');
        $salary_from = 0;
        $salary_to = 0;
        $salary_currency = '';
        $is_featured = 2;
        $order_by = 'id';
        $limit = 5;

        $relatedJobs = $this->fetchJobs($search, $job_titles, $company_ids, $industry_ids, $job_skill_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $is_freelance, $career_level_ids, $job_type_ids, $job_shift_ids, $gender_ids, $degree_level_ids, $job_experience_ids, $salary_from, $salary_to, $salary_currency, $is_featured, $order_by, $limit);
        /*         * ***************************************** */

        $seoArray = $this->getSEO((array) $job->functional_area_id, (array) $job->country_id, (array) $job->state_id, (array) $job->city_id, (array) $job->career_level_id, (array) $job->job_type_id, (array) $job->job_shift_id, (array) $job->gender_id, (array) $job->degree_level_id, (array) $job->job_experience_id);
        /*         * ************************************************** */
        $seo = (object) array(
                    'seo_title' => $job->title,
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('job.detail')
                        ->with('job', $job)
                        ->with('track_job', $job_track_data)
                        ->with('relatedJobs', $relatedJobs)
                        ->with('seo', $seo);
    }


    public function setStatus(Request $request) {

      
        
        $applied = json_decode($request->applied, true);
        $shortlist = json_decode($request->shortlist, true);
        $hired = json_decode($request->hired, true);
        $rejected = json_decode($request->rejected, true);

        if($applied){
            JobApply::whereIn('id', $applied)->update(['status' => 'applied']);
            $prev_job_track = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','applied')->first();
            if(!$prev_job_track){
                // tracking code 
                $job_track_array = array(
                    'job_apply_id'=>$request->dataId,
                    'status' => "applied"
                );
                $track_job = DB::table('job_track')->insert($job_track_array);
                // tracking code 
            }
        }
        if($shortlist){
            JobApply::whereIn('id', $shortlist)->update(['status' => 'shortlist']);
            $prev_job_track = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','shortlist')->first();
            if(!$prev_job_track){
                // tracking code 
                $job_track_array = array(
                    'job_apply_id'=>$request->dataId,
                    'status' => "shortlist"
                );
                $track_job = DB::table('job_track')->insert($job_track_array);
                // tracking code 
            }
        }
        if($hired){
            JobApply::whereIn('id', $hired)->update(['status' => 'hired']);
            $prev_job_track = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','hired')->first();
            $check_reject_job = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','rejected')->first();
            if($check_reject_job){
              // tracking code 
              $delete_reject = DB::table('job_track')->where('id',$check_reject_job->id)->delete();
              // tracking code 
               
            }
            if(!$prev_job_track){
                // tracking code 
                $job_track_array = array(
                    'job_apply_id'=>$request->dataId,
                    'status' => "hired"
                );
                $track_job = DB::table('job_track')->insert($job_track_array);
                // tracking code 
            }
        }
        if($rejected){
            JobApply::whereIn('id', $rejected)->update(['status' => 'rejected']);
            $prev_job_track = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','rejected')->first();
            $check_reject_job = DB::table('job_track')->where('job_apply_id',$request->dataId)->where('status','hired')->first();
            if($check_reject_job){
                // tracking code 
                $delete_reject = DB::table('job_track')->where('id',$check_reject_job->id)->delete();
                // tracking code 
                 
              }
            if(!$prev_job_track){
                // tracking code 
                $job_track_array = array(
                    'job_apply_id'=>$request->dataId,
                    'status' => "rejected"
                );
                $track_job = DB::table('job_track')->insert($job_track_array);
                // tracking code 
            }
        }




        
        
        
        

         
    }



    /*     * ************************************************** */

    public function addToFavouriteJob(Request $request, $job_slug)
    {
        

        $job = Job::where('slug', 'like', $job_slug)->first();
        $user_id = Auth::user()->id;
        sendnotification(2,'Fav Job Added',$user_id,$job->id);
        // Favourite Company 
        $get_company_info = DB::table('companies')->where('id',$job->company_id)->first();
        $data['company_slug'] = $get_company_info->slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteCompany::create($data);
        // Favourite Company 

        $data['job_slug'] = $job_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteJob::create($data);
        flash(__('Job has been added in favorites list'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function removeFromFavouriteJob(Request $request, $job_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteJob::where('job_slug', 'like', $job_slug)->where('user_id', $user_id)->delete();

        flash(__('Job has been removed from favorites list'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function applyJob(Request $request, $job_slug)
    {
        
        $user = Auth::user();
        $job = Job::where('slug', 'like', $job_slug)->first();
        
        if ((bool)$user->is_active === false) {
            flash(__('Your account is inactive contact site admin to activate it'))->error();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            if (
                    ($user->jobs_quota <= $user->availed_jobs_quota) ||
                    ($user->package_end_date->lt(Carbon::now()))
            ) {
                flash(__('Please subscribe to package first'))->error();
                return \Redirect::route('home');
                exit;
            }
        }
        if ($user->isAppliedOnJob($job->id)) {
            flash(__('You have already applied for this job'))->success();
            return \Redirect::route('job.detail', $job_slug);
            exit;
        }
        
        

        $myCvs = ProfileCv::where('user_id', '=', $user->id)->pluck('title', 'id')->toArray();

        return view('job.apply_job_form')
                        ->with('job_slug', $job_slug)
                        ->with('job', $job)
                        ->with('myCvs', $myCvs);
    }

    public function postApplyJob(ApplyJobFormRequest $request, $job_slug)
    {
      
        $user = Auth::user();
        $user_id = $user->id;
        $job = Job::where('slug', 'like', $job_slug)->first();
        
        // Favourite Company 
        $get_company_info = DB::table('companies')->where('id',$job->company_id)->first();
        $data['company_slug'] = $get_company_info->slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteCompany::create($data);

        
    

        $jobApply = new JobApply();
        $jobApply->user_id = $user_id;
        $jobApply->job_id = $job->id;
        $jobApply->cv_id = $request->post('cv_id');
        $jobApply->current_salary = $request->post('current_salary');
        $jobApply->expected_salary = $request->post('expected_salary');
        $jobApply->salary_currency = $request->post('salary_currency');
        $jobApply->comment = $request->post('comment');
        $jobApply->save();
        // notification code
        sendnotification(2,'Job Apply',$user_id,$job->id);
        sendnotification(1,'Job Apply Seeker',$user_id,$job->id);
        // notification code
        /*         * ******************************* */
        if ((bool) config('jobseeker.is_jobseeker_package_active')) {
            $user->availed_jobs_quota = $user->availed_jobs_quota + 1;
            $user->update();
        }
        /*         * ******************************* */
        $event = new JobApplied($job, $jobApply);
        $insertId = $event->getInsertId();
        // tracking code 
        $job_track_array = array(
            'job_apply_id'=>$insertId,
            'status' => "applied"
        );
        $track_job = DB::table('job_track')->insert($job_track_array);
        // tracking code 


        flash(__('You have successfully applied for this job'))->success();
        return \Redirect::route('job.detail', $job_slug);
    }

    public function myJobApplications(Request $request)
    {   
        
  
        $user_id = Auth::user()->id;
        $myAppliedJobIds = Auth::user()->getAppliedJobIdsArray();
        $jobs = array();
        $create_job_array = Job::whereIn('id', $myAppliedJobIds)->paginate(10);
        foreach($create_job_array as $job_id){
            
            $job_track_data = DB::table('job_apply')
            ->leftJoin('job_track', 'job_apply.id', '=', 'job_track.job_apply_id')
            ->select('job_track.created_at', 'job_track.status', 'job_track.id', 'job_apply.job_id')->where('job_apply.job_id',$job_id->id)->where('user_id',$user_id)->get(); 
            $job_id->track_job = $job_track_data;
            $jobs[] = $job_id;
        
        }
        return view('job.my_applied_jobs')
                        ->with('jobs', $jobs);
    }

    public function RecomandedJob(Request $request)
    {   

        $user_id = Auth::user()->id;
        $getUser = DB::table('users')->where('id',$user_id)->first();
        $getTitle = DB::table('functional_areas')->where('id',$getUser->functional_area_id)->first();
        $title = (!empty($getTitle->functional_area))?$getTitle->functional_area:'';
        $functional_area_id = (!empty($getTitle->functional_area_id))?$getTitle->functional_area_id:'';
        $current_salary = $getUser->current_salary;
        $expected_salary = $getUser->expected_salary;
        $country = $getUser->country_id;
        $state = $getUser->state_id;
        $city  = $getUser->city_id;
        $jobs = Job::when($title, function ($query) use ($title) {
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
            ->paginate(10);
        return view('job.recomanded_job')
                        ->with('jobs', $jobs);
    }

    public function myFavouriteJobs(Request $request)
    {
        $myFavouriteJobSlugs = Auth::user()->getFavouriteJobSlugsArray();
        $jobs = Job::whereIn('slug', $myFavouriteJobSlugs)->paginate(10);
        return view('job.my_favourite_jobs')
                        ->with('jobs', $jobs);
    }

}
