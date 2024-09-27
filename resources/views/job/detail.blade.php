@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->


    @include('includes.inner_top_search')
    @include('flash::message')

    @php
        $company = $job->getCompany();
    @endphp

    <!-- CSS -->
    <style>
        .job-tracking-vertical {
            display: flex;
            flex-direction: column;
            /* align-items: flex-start; */
            justify-content: space-between;
            position: relative;
            padding-left: 31px;
            margin-top: 30px;
        }

        .status {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .status-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .status-text {
            margin-left: 10px;
        }

        /* Colors for different statuses */
        .submitted i {
            color: blue;
        }

        .completed i {
            color: green;
        }

        .shortlisted i {
            color: purple;
        }

        .in-progress i {
            color: orange;
        }

        .interview i {
            color: teal;
        }

        .hired i {
            color: green;
        }

        .rejected i {
            color: red;
        }

        strong {
            margin-top: 10px !important;
        }

        /* Vertical Line */
        .job-tracking-vertical:before {
            content: '';
            position: absolute;
            left: 17px;
            height: 100%;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #ddd;
        }



        .status:before {
            content: '';
            position: absolute;
            left: -19px;
            top: 50%;
            width: 12px;
            height: 12px;
            background-color: white;
            border: 3px solid #ddd;
            border-radius: 50%;
            z-index: 1;
            background-color: green;
        }


        .status.submitted:before {
            border-color: blue;
        }

        .status.completed:before {
            border-color: green;
        }

        .status.shortlisted:before {
            border-color: purple;
        }

        .status.in-progress:before {
            border-color: orange;
        }

        .status.interview:before {
            border-color: teal;
        }

        .status.hired:before {
            border-color: green;
        }

        .status.rejected:before {
            border-color: red;
        }

        /* Ensure the vertical line stops at the last item */
        .status:last-child:before {
            bottom: 0;
        }

        .blur {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
            filter: blur(5px);
            opacity: 0.5;
        }

        .status-dot.blur {

            background-color: #ddd;
            /* Optional: make the dot look faded */
        }
    </style>


    <div class="listpgWraper">
        <div class="container">
            @include('flash::message')


            <div class="row jobPagetitle">
                <div class="col-lg-9">
                    <div class="jobinfo">
                        <h2>{{ $job->title }} - {{ $company->name }}</h2>
                        <div class="ptext">{{ __('Date Posted') }}: {{ $job->created_at->format('M d, Y') }}</div>

                        @if (!Auth::user() && !Auth::guard('company')->user())
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in" aria-hidden="true"></i>
                                {{ __('Login to View Salary') }} </a>
                        @else
                            @if (!(bool) $job->hide_salary)
                                <div class="salary">{{ $job->getSalaryPeriod('salary_period') }}:
                                    <strong>{{ $job->salary_from . ' ' . $job->salary_currency }} -
                                        {{ $job->salary_to . ' ' . $job->salary_currency }}</strong>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-3">

                    <div class="jobButtons applybox">
                        @if ($job->isJobExpired())
                            <span class="jbexpire"><i class="fas fa-paper-plane" aria-hidden="true"></i>
                                {{ __('Job is expired') }}</span>
                        @elseif(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                            <a href="javascript:;" class="btn apply applied"><i class="fas fa-paper-plane"
                                    aria-hidden="true"></i> {{ __('Already Applied') }}</a>
                        @else
                            <a href="{{ route('apply.job', $job->slug) }}" class="btn apply"><i class="fas fa-paper-plane"
                                    aria-hidden="true"></i> {{ __('Apply Now') }}</a>
                        @endif
                    </div>

                </div>
            </div>




            <!-- Job Detail start -->
            <div class="row">
                <div class="col-lg-7">

                    <!-- Job Header start -->
                    <div class="job-header">


                        <!-- Job Detail start -->
                        <div class="jobmainreq">
                            <div class="jobdetail">
                                <h3><i class="fa fa-align-left" aria-hidden="true"></i> {{ __('Job Detail') }}</h3>


                                <ul class="jbdetail">
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Location') }}:</div>
                                        <div class="col-md-8 col-xs-7">
                                            @if ((bool) $job->is_freelance)
                                                <span>Freelance</span>
                                            @else
                                                <span>{{ $job->getLocation() }}</span>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Company') }}:</div>
                                        <div class="col-md-8 col-xs-7"><a
                                                href="{{ route('company.detail', $company->id) }}">{{ $company->name }}</a>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Type') }}:</div>
                                        <div class="col-md-8 col-xs-7"><span
                                                class="permanent">{{ $job->getJobType('job_type') }}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Shift') }}:</div>
                                        <div class="col-md-8 col-xs-7"><span
                                                class="freelance">{{ $job->getJobShift('job_shift') }}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Career Level') }}:</div>
                                        <div class="col-md-8 col-xs-7">
                                            <span>{{ $job->getCareerLevel('career_level') }}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Positions') }}:</div>
                                        <div class="col-md-8 col-xs-7"><span>{{ $job->num_of_positions }}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Experience') }}:</div>
                                        <div class="col-md-8 col-xs-7">
                                            <span>{{ $job->getJobExperience('job_experience') }}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Gender') }}:</div>
                                        <div class="col-md-8 col-xs-7"><span>{{ $job->getGender('gender') }}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Degree') }}:</div>
                                        <div class="col-md-8 col-xs-7">
                                            <span>{{ $job->getDegreeLevel('degree_level') }}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-4 col-xs-5">{{ __('Apply Before') }}:</div>
                                        <div class="col-md-8 col-xs-7">
                                            <span>
                                                {{ $job->expiry_date ? \Carbon\Carbon::parse($job->expiry_date)->format('M d, Y') : '' }}
                                            </span>
                                        </div>
                                    </li>

                                </ul>



                            </div>
                        </div>

                        <hr>
                        <div class="jobButtons">
                            <a href="{{ route('email.to.friend', $job->slug) }}" class="btn"><i class="fas fa-envelope"
                                    aria-hidden="true"></i> {{ __('Email to Friend') }}</a>
                            @if (Auth::check() && Auth::user()->isFavouriteJob($job->slug))
                                <a href="{{ route('remove.from.favourite', $job->slug) }}" class="btn"><i
                                        class="fas fa-floppy" aria-hidden="true"></i> {{ __('Remove From Favourite Job') }}
                                    <i class="fas fa-times"></i></a>
                            @else
                                <a href="{{ route('add.to.favourite', $job->slug) }}" class="btn"><i
                                        class="fas fa-floppy"></i> {{ __('Add to Favourite') }}</a>
                            @endif
                            <a href="{{ route('report.abuse', $job->slug) }}" class="btn report"><i
                                    class="fas fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ __('Report Abuse') }}</a>
                        </div>
                    </div>



                    <!-- Job Description start -->
                    <div class="job-header">
                        <div class="contentbox">
                            <h3><i class="fas fa-file-text" aria-hidden="true"></i> {{ __('Job Description') }}</h3>
                            <p>{!! $job->description !!}</p>
                        </div>
                    </div>


                    <div class="job-header benefits">
                        <div class="contentbox">
                            <h3><i class="fa fa-file-text" aria-hidden="true"></i> {{ __('Benefits') }}</h3>
                            <p>{!! $job->benefits !!}</p>
                        </div>
                    </div>

                    <div class="job-header">
                        <div class="contentbox">
                            <h3><i class="fas fa-puzzle-piece" aria-hidden="true"></i> {{ __('Skills Required') }}</h3>
                            <ul class="skillslist">
                                {!! $job->getJobSkillsList() !!}
                            </ul>
                        </div>
                    </div>


                    <!-- Job Description end -->


                </div>
                <!-- related jobs end -->

                <div class="col-lg-5">



                    <div class="companyinfo">
                        <h3><i class="fas fa-building" aria-hidden="true"></i> {{ __('Company Overview') }}</h3>
                        <div class="companylogo"><a
                                href="{{ route('company.detail', $company->slug) }}">{{ $company->printCompanyImage() }}</a>
                        </div>
                        <div class="title"><a
                                href="{{ route('company.detail', $company->slug) }}">{{ $company->name }}</a></div>
                        <div class="ptext">{{ $company->getLocation() }}</div>
                        <div class="opening">
                            <a href="{{ route('company.detail', $company->slug) }}">
                                {{ App\Company::countNumJobs('company_id', $company->id) }}
                                {{ __('Current Jobs Openings') }}
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="companyoverview">

                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($company->description), 250, '...') }} <a
                                    href="{{ route('company.detail', $company->slug) }}">Read More</a></p>
                        </div>
                    </div>

                    @php
                        // Initialize an array with null values for each index
                        $filtered_jobs = [
                            0 => null, // Index 0 for "applied"
                            1 => null, // Index 1 for "view"
                            2 => null, // Index 2 for "download cv"
                            3 => null, // Index 3 for "shortlist"
                            4 => null, // Index 3 for "interview sheduled"
                            5 => null, // Index 4 for "hired"
                            6 => null, // Index 5 for "rejected"
                        ];
                        // Loop through the jobs and assign them based on their status to the correct index
                        foreach ($track_job as $job_tracking) {
                            switch ($job_tracking->status) {
                                case 'applied':
                                    $filtered_jobs[0] = $job_tracking;
                                    break;

                                case 'view':
                                    $filtered_jobs[1] = $job_tracking;
                                    break;

                                case 'download_cv':
                                    $filtered_jobs[2] = $job_tracking;
                                    break;

                                case 'shortlist':
                                    $filtered_jobs[3] = $job_tracking;
                                    break;

                                case 'interview':
                                    $filtered_jobs[4] = $job_tracking;
                                    break;

                                case 'hired':
                                    $filtered_jobs[5] = $job_tracking;
                                    break;

                                case 'rejected':
                                    $filtered_jobs[6] = $job_tracking;
                                    break;
                            }
                        }

                        // Filter out null values to clean up the array
                        $filtered_jobs = array_filter($filtered_jobs);
                    @endphp
                    @if (!empty($filtered_jobs))
                        <div class="companyinfo">
                            <h3><i class="fas fa-building" aria-hidden="true"></i> {{ __('Job Tracking') }}</h3>

                            <div class="title"><a
                                    href="{{ route('company.detail', $company->slug) }}">{{ $company->name }}</a></div>

                            <hr>
                            <!-- Job Tracking Status -->

                            <div class="job-tracking-vertical">
                                @if (!empty($filtered_jobs))
                                    @if (isset($filtered_jobs[0]->status) && $filtered_jobs[0]->status == 'applied')
                                        <div class="status">
                                            <div class="status-dot submitted"></div>
                                            <div class="status-text">
                                                <strong>Application Submitted</strong><br><br>
                                                <small>{{ isset($filtered_jobs[0]) && $filtered_jobs[0]->created_at ? \Carbon\Carbon::parse($filtered_jobs[0]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>

                                        <div class="status">
                                            <div class="status-dot completed"></div>
                                            <div class="status-text">
                                                <strong>Applied</strong><br><br>
                                                <small>{{ isset($filtered_jobs[0]) && $filtered_jobs[0]->created_at ? \Carbon\Carbon::parse($filtered_jobs[0]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($filtered_jobs[1]->status) && $filtered_jobs[1]->status == 'view')
                                        <div class="status">
                                            <div class="status-dot completed"></div>
                                            <div class="status-text">
                                                <strong>Application View </strong><br><br>
                                                <small>{{ isset($filtered_jobs[1]) && $filtered_jobs[1]->created_at ? \Carbon\Carbon::parse($filtered_jobs[1]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($filtered_jobs[2]->status) && $filtered_jobs[2]->status == 'download_cv')
                                        <div class="status">
                                            <div class="status-dot completed"></div>
                                            <div class="status-text">
                                                <strong>Download CV</strong><br><br>
                                                <small>{{ isset($filtered_jobs[2]) && $filtered_jobs[2]->created_at ? \Carbon\Carbon::parse($filtered_jobs[2]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status blur">
                                            <div class="status-dot shortlisted"></div>
                                            <div class="status-text">
                                                <strong>Download CV</strong><br><br>
                                                <small>{{ isset($filtered_jobs[2]) && $filtered_jobs[2]->created_at ? \Carbon\Carbon::parse($filtered_jobs[2]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($filtered_jobs[3]->status) && $filtered_jobs[3]->status == 'shortlist')
                                        <div class="status">
                                            <div class="status-dot shortlisted"></div>
                                            <div class="status-text">
                                                <strong>Shortlisted</strong><br><br>
                                                <small>{{ isset($filtered_jobs[3]) && $filtered_jobs[3]->created_at ? \Carbon\Carbon::parse($filtered_jobs[3]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status blur">
                                            <div class="status-dot shortlisted"></div>
                                            <div class="status-text">
                                                <strong>Shortlisted</strong><br><br>
                                                <small>{{ isset($filtered_jobs[3]) && $filtered_jobs[3]->created_at ? \Carbon\Carbon::parse($filtered_jobs[3]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($filtered_jobs[4]->status) && $filtered_jobs[4]->status == 'interview')
                                        <div class="status">
                                            <div class="status-dot shortlisted"></div>
                                            <div class="status-text">
                                                <strong>Interview Scheduled</strong><br><br>
                                                <small>{{ isset($filtered_jobs[4]) && $filtered_jobs[4]->created_at ? \Carbon\Carbon::parse($filtered_jobs[4]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status blur">
                                            <div class="status-dot shortlisted"></div>
                                            <div class="status-text">
                                                <strong>Interview Scheduled</strong><br><br>
                                                <small>{{ isset($filtered_jobs[4]) && $filtered_jobs[4]->created_at ? \Carbon\Carbon::parse($filtered_jobs[4]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($filtered_jobs[5]->status) && $filtered_jobs[5]->status == 'hired')
                                        <div class="status">
                                            <div class="status-dot hired"></div>
                                            <div class="status-text">
                                                <strong>Hired</strong><br><br>
                                                <small>{{ isset($filtered_jobs[5]) && $filtered_jobs[5]->created_at ? \Carbon\Carbon::parse($filtered_jobs[5]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="status blur">
                                            <div class="status-dot hired"></div>
                                            <div class="status-text">
                                                <strong>Hired</strong><br><br>
                                                <small>{{ isset($filtered_jobs[5]) && $filtered_jobs[5]->created_at ? \Carbon\Carbon::parse($filtered_jobs[5]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif
                                    @if (isset($filtered_jobs[6]->status) && $filtered_jobs[6]->status == 'rejected')
                                        <div class="status">
                                            <div class="status-dot rejected"></div>
                                            <div class="status-text">
                                                <strong>Rejected</strong><br><br>
                                                <small>{{ isset($filtered_jobs[6]) && $filtered_jobs[6]->created_at ? \Carbon\Carbon::parse($filtered_jobs[6]->created_at)->format('jS M Y, g:i A') : '' }}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    @endif



                    <!-- related jobs start -->
                    <div class="relatedJobs">
                        <h3>{{ __('Related Jobs') }}</h3>
                        <ul class="searchList">
                            @if (isset($relatedJobs) && count($relatedJobs))
                                @foreach ($relatedJobs as $relatedJob)
                                    <?php $relatedJobCompany = $relatedJob->getCompany(); ?>
                                    @if (null !== $relatedJobCompany)
                                        <!--Job start-->
                                        <li>


                                            <div class="jobinfo">
                                                <h3><a href="{{ route('job.detail', [$relatedJob->slug]) }}"
                                                        title="{{ $relatedJob->title }}">{{ $relatedJob->title }}</a>
                                                </h3>
                                                <div class="companyName"><a
                                                        href="{{ route('company.detail', $relatedJobCompany->slug) }}"
                                                        title="{{ $relatedJobCompany->name }}">{{ $relatedJobCompany->name }}</a>
                                                </div>
                                                <div class="location"><span>{{ $relatedJob->getCity('city') }}</span>
                                                </div>
                                                <div class="location">
                                                    <label
                                                        class="fulltime">{{ $relatedJob->getJobType('job_type') }}</label>
                                                    <label
                                                        class="partTime">{{ $relatedJob->getJobShift('job_shift') }}</label>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                        </li>
                                        <!--Job end-->
                                    @endif
                                @endforeach
                            @endif

                            <!-- Job end -->
                        </ul>
                    </div>

                    <!-- Google Map start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3><i class="fas fa-map-marker" aria-hidden="true"></i> {{ __('Google Map') }}</h3>
                            <div class="gmap">
                                {!! $company->map !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
@push('styles')
    <style type="text/css">
        .view_more {
            display: none !important;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function($) {
            $("form").submit(function() {
                $(this).find(":input").filter(function() {
                    return !this.value;
                }).attr("disabled", "disabled");
                return true;
            });
            $("form").find(":input").prop("disabled", false);

            $(".view_more_ul").each(function() {
                if ($(this).height() > 100) {
                    $(this).css('height', 100);
                    $(this).css('overflow', 'hidden');
                    //alert($( this ).next());
                    $(this).next().removeClass('view_more');
                }
            });



        });
    </script>
@endpush
