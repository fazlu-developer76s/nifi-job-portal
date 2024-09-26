@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title' => __('Applied Jobs')])
    <!-- Inner Page Title end -->
    <style>
        .job-tracking-vertical {
            display: flex;
            flex-direction: row;
            /* align-items: flex-start; */
            justify-content: space-between;
            position: relative;
            padding-left: 30px;
            margin-top: 20px;
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

        /* Vertical Line */
        .job-tracking-vertical:before {
            content: '';
            position: absolute;
            left: 17px;
            height: 2px;
            top: 10px;
            bottom: 0;
            width: 100%;
            background-color: #ddd;
        }

        strong {
            /* margin-top: 25px; */
            position: relative;
            top: 24px;
            right: 50px;

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
            <div class="row">
                @include('includes.user_dashboard_menu')

                <div class="col-md-9 col-sm-8">
                    <div class="myads">
                        <h3>{{ __('Applied Jobs') }}</h3>
                        <ul class="searchList">
                            <!-- job start -->
                            @if (isset($jobs) && count($jobs))
                                @foreach ($jobs as $job)
                                    @php $company = $job->getCompany(); @endphp
                                    @if (null !== $company)
                                        <li>
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="jobimg">{{ $company->printCompanyImage() }}</div>
                                                    <div class="jobinfo">
                                                        <h3><a href="{{ route('job.detail', [$job->slug]) }}"
                                                                title="{{ $job->title }}">{{ $job->title }}</a></h3>
                                                        <div class="companyName"><a
                                                                href="{{ route('company.detail', $company->slug) }}"
                                                                title="{{ $company->name }}">{{ $company->name }}</a></div>
                                                        <div class="location">
                                                            <label class="fulltime"
                                                                title="{{ $job->getJobShift('job_shift') }}">{{ $job->getJobShift('job_shift') }}</label>
                                                            - <span>{{ $job->getCity('city') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="listbtn"><a
                                                            href="{{ route('job.detail', [$job->slug]) }}">{{ __('View Details') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150, '...') }}
                                            </p>

                                            @php
                                                // Initialize an array with null values for each index
                                                $filtered_jobs = [
                                                    0 => null, // Index 0 for "applied"
                                                    1 => null, // Index 1 for "shortlist"
                                                    2 => null, // Index 2 for "hired"
                                                    3 => null, // Index 3 for "rejected"
                                                ];
                                                // Loop through the jobs and assign them based on their status to the correct index
                                                foreach ($job->track_job as $job_tracking) {
                                                    switch ($job_tracking->status) {
                                                        case 'applied':
                                                            $filtered_jobs[0] = $job_tracking;
                                                            break;

                                                        case 'shortlist':
                                                            $filtered_jobs[1] = $job_tracking;
                                                            break;

                                                        case 'hired':
                                                            $filtered_jobs[2] = $job_tracking;
                                                            break;

                                                        case 'rejected':
                                                            $filtered_jobs[3] = $job_tracking;
                                                            break;
                                                    }
                                                }

                                                // Filter out null values to clean up the array
                                                $filtered_jobs = array_filter($filtered_jobs);
                                            @endphp

                                            <div class="job-tracking-vertical">
                                                @if (!empty($filtered_jobs))
                                                    @if (isset($filtered_jobs[0]->status) && $filtered_jobs[0]->status == 'applied')
                                                        <div class="status">
                                                            <div class="status-dot submitted"></div>
                                                            <div class="status-text">
                                                                <strong>Application Submitted</strong><br>
                                                            </div>
                                                        </div>

                                                        <div class="status">
                                                            <div class="status-dot completed"></div>
                                                            <div class="status-text">
                                                                <strong>{{ ucfirst($filtered_jobs[0]->status) }}</strong><br>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (isset($filtered_jobs[1]->status) && $filtered_jobs[1]->status == 'shortlist')
                                                        <div class="status">
                                                            <div class="status-dot in-progress"></div>
                                                            <div class="status-text">
                                                                <strong>Viewed</strong><br>
                                                            </div>
                                                        </div>

                                                        <div class="status">
                                                            <div class="status-dot shortlisted"></div>
                                                            <div class="status-text">
                                                                <strong>Shortlisted</strong><br>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="status blur">
                                                            <div class="status-dot in-progress"></div>
                                                            <div class="status-text">
                                                                <strong>Viewed</strong><br>
                                                            </div>
                                                        </div>

                                                        <div class="status blur">
                                                            <div class="status-dot shortlisted"></div>
                                                            <div class="status-text">
                                                                <strong>Shortlisted</strong><br>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (isset($filtered_jobs[2]->status) && $filtered_jobs[2]->status == 'hired')
                                                        <div class="status">
                                                            <div class="status-dot interview"></div>
                                                            <div class="status-text">
                                                                <strong>Interview Scheduled</strong><br>
                                                            </div>
                                                        </div>

                                                        <div class="status">
                                                            <div class="status-dot hired"></div>
                                                            <div class="status-text">
                                                                <strong>Hired</strong><br>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="status blur">
                                                            <div class="status-dot interview"></div>
                                                            <div class="status-text">
                                                                <strong>Interview Scheduled</strong><br>
                                                            </div>
                                                        </div>

                                                        <div class="status blur">
                                                            <div class="status-dot hired"></div>
                                                            <div class="status-text">
                                                                <strong>Hired</strong><br>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (isset($filtered_jobs[3]->status) && $filtered_jobs[3]->status == 'rejected')
                                                        <div class="status">
                                                            <div class="status-dot rejected"></div>
                                                            <div class="status-text">
                                                                <strong>Rejected</strong><br>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>



                                        </li>
                                        <!-- job end -->
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
@endsection
@push('scripts')
    @include('includes.immediate_available_btn')
@endpush
