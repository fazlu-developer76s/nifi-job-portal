@extends('layouts.app')

@section('content')

    <!-- Header start -->

    @include('includes.header')

    <!-- Header end -->

    <!-- Inner Page Title start -->
    @include('includes.inner_top_search')

    <!-- Inner Page Title end -->

    <div class="listpgWraper">

        <div class="container">@include('flash::message')

            <div class="row"> @include('includes.user_dashboard_menu')

                <div class="col-lg-9">

                    {{ auth()->user()->printUserCoverImage() }}



                    <div class="profileban">

                        <div class="abtuser">

                            <div class="row">

                                <div class="col-lg-2 col-md-2">

                                    <div class="uavatar">{{ auth()->user()->printUserImage() }}</div>

                                </div>

                                <div class="col-lg-10 col-md-10">

                                    <div class="row">

                                        <div class="col-lg-9">

                                            <h4>{{ auth()->user()->name }}</h4>

                                            <h6><i class="fas fa-map-marker" aria-hidden="true"></i>
                                                {{ Auth::user()->getLocation() }}</h6>

                                        </div>

                                        <div class="col-lg-3">
                                            <div class="editbtbn"><a href="{{ route('my.profile') }}"><i
                                                        class="fas fa-pencil-alt" aria-hidden="true"></i> Edit Profile</a>

                                            </div>
                                        </div>

                                    </div>



                                    <ul class="row userdata">

                                        <li class="col-lg-6 col-md-6"><i class="fas fa-phone" aria-hidden="true"></i>
                                            {{ auth()->user()->phone }}</li>

                                        <li class="col-lg-6 col-md-6"><i class="fas fa-envelope" aria-hidden="true"></i>
                                            {{ auth()->user()->email }}</li>

                                    </ul>



                                </div>

                            </div>

                        </div>

                    </div>








                    @include('includes.user_dashboard_stats')

                    @if ((bool) config('jobseeker.is_jobseeker_package_active'))

                        @php

                            $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();

                            $package = Auth::user()->getPackage();

                            if (null !== $package) {
                                $packages = App\Package::where('package_for', 'like', 'job_seeker')
                                    ->where('id', '<>', $package->id)
                                    ->where('package_price', '>=', $package->package_price)
                                    ->get();
                            }

                        @endphp



                        @if (null !== $package)
                            @include('includes.user_package_msg')

                            @include('includes.user_packages_upgrade')
                        @else
                            @if (null !== $packages)
                                @include('includes.user_packages_new')
                            @endif
                        @endif

                    @endif





                    <div class="row">

                        <div class="col-lg-7">

                            <div class="profbox">

                                <h3><i class="fab fa-black-tie"></i> Recommended Jobs</h3>

                                <ul class="recomndjobs">

                                    @if (null !== $matchingJobs)
                                        @foreach ($matchingJobs as $match)
                                            <li>

                                                <h4><a
                                                        href="{{ route('job.detail', [$match->slug]) }}">{{ $match->title }}</a>
                                                </h4>

                                                <p>{{ $match->getCompany()->name }}</p>

                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
								
							<div class="allbtn"><a href="{{ route('recomanded.job') }}"><i class="fas fa-users"></i>
									View All</a>

							</div>

                            </div>
							
                        </div>



                        <div class="col-lg-5">

                            <div class="profbox followbox">

                                <h3><i class="fas fa-users"></i> My Followings</h3>



                                <ul class="followinglist">

                                    @if (isset($followers) && null !== $followers)
                                        @foreach ($followers as $follow)
                                            @php
                                                $company = DB::table('companies')
                                                    ->where('slug', $follow->company_slug)
                                                    ->where('is_active', 1)
                                                    ->first();
                                            @endphp
                                            @if (isset($company))
                                                <li>
                                                    
                                                    
                                                    @if (!empty($company->logo))
                                                    @php $image_path = "company_logos/".$company->logo @endphp
                                                    @else
                                                    @php $image_path = "admin_assets/no-image.png" @endphp
                                                    @endif
                                                    <div class="main-flex" style="display: flex ; justify-content:space-between; align-items:start">
                                                    <div class="flex">
                                                        <span>{{ $company->name }}</span>
                                                        <p>{{ $company->location }}</p>
                                                    </div>
                                                 <div class="flex" style="display: flex ; justify-content:space-center; gap:10px align-items:start">
                                                    <a href="{{ route('company.detail', $company->slug) }}"><img src="admin_assets/info.png" style="height:25px" alt=""></a>
                                                    <img src="{{ $image_path }}" alt="" width="35" height="35" style="border-radius: 50px"  >
                                                </div>
                                                 </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif



                                </ul>



                                <div class="allbtn"><a href="{{ route('my.followings') }}"><i class="fas fa-users"></i>
                                        View All</a>

                                </div>

                            </div>

                        </div>



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
