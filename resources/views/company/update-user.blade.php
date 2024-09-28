@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Company Profile')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="userccount">
                            <div class="formpanel mt0"> @include('flash::message')
                                <!-- Personal Information -->
                                <div class="row">
                                    <div class="container">
                                        <h1>Update User</h1>
                                        <form method="POST" action="{{ route('user.update.user') }}">
                                            @csrf
                                             <input type="text" name="hidden_id" value="{{ $users->id }}"  hidden>
                                            <!-- Title Field -->
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <select name="title" class="form-control @error('title') is-invalid @enderror">
                                                    <option value="">Select Title</option>
                                                    <option value="HR" {{ ($users->title == 'HR') ? 'selected' : '' }}>HR</option>
                                                    <option value="HR" {{ ($users->title == 'Admin') ? 'selected' : '' }}>Admin</option>
                                                    <option value="HR" {{ ($users->title == 'HOD') ? 'selected' : '' }}>HOD</option>
                                                    <option value="HR" {{ ($users->title == 'Other') ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Name Field -->
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" value="{{ $users->name }}" class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Email Field -->
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" value="{{ $users->email }}" class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Mobile Field -->
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" name="mobile" value="{{ $users->mobile }}" class="form-control @error('mobile') is-invalid @enderror">
                                                @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Password Field -->
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Permission Checkboxes -->
                                            <div class="form-group">
                                                <br>
                                                <h2>Permissions</h2>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="dashboard_per" value="1" id="dashboard_per" {{ ($users->dashboard_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="dashboard_per">Dashboard</label> 
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="edit_per" value="1" id="edit_per" {{ ($users->edit_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="edit_per">Edit Profile</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="public_profile_per" value="1" id="public_profile_per" {{ ($users->public_profile_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="public_profile_per">Public Profile</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="post_job_per" value="1" id="post_job_per" {{ ($users->post_job_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="post_job_per">Post Job</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="company_job_per" value="1" id="company_job_per" {{ ($users->company_job_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="company_job_per">Company Jobs</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="cv_search_per" value="1" id="cv_search_per" {{ ($users->cv_search_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="cv_search_per">CV Search</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="unlocked_user_per" value="1" id="unlocked_user_per" {{ ($users->unlocked_user_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="unlocked_user_per">Unlocked User</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="company_message_per" value="1" id="company_message_per" {{ ($users->company_message_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="company_message_per">Company Messages</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="recommended_seeker_per" value="1" id="recommended_seeker_per" {{ ($users->recommended_seeker_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="recommended_seeker_per">Recommended Seekers</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="company_follower_per" value="1" id="company_follower_per" {{ ($users->company_follower_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="company_follower_per">Company Follower</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="report_per" value="1" id="report_per" {{ ($users->report_per==1)  ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="report_per">Report Management</label>
                                                </div>

                                            </div>


                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>


                                    </div>
                                </div>
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
@push('styles')
<style type="text/css">
    .userccount p {
        text-align: left !important;
    }
</style>
@endpush