<?php
$lang = config('default_lang');
$direction = MiscHelper::getLangDirection($lang);
?>
@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>        
                <li> <span>Edit Site Setting</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Site Setting Form</span> </div>
                    </div>
                    <div class="portlet-body form">          
                        <ul class="nav nav-tabs">              
                            <li class="active"> <a href="#site" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Site </a> </li>              
                            <li class=""> <a href="#email" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Email </a> </li>
                            <li class=""> <a href="#social" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Social Networks </a> </li>
                            <li class=""> <a href="#ads" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Manage Ads </a> </li>
                            <li class=""> <a href="#captcha" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Captcha </a> </li>
                            <li class=""> <a href="#socialMediaLogin" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Social Media Login </a> </li>
                            <li class=""> <a href="#paymentGateways" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Payment Gateways </a> </li>
                            <li class=""> <a href="#homePageSlider" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Home Page Slider </a> </li>
                            {{-- <li class=""> <a href="#mailChimp" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Mail Chimp </a> </li>
                            <li class=""> <a href="#googleAnalytics" data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Google Analytics </a> </li>              
                            <li class=""> <a href="#jobg8_API " data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> jobg8 API </a> </li>               --}}
                            <li class=""> <a href="#LIVEChat " data-toggle="tab" onclick="hideUpdateButton('0');" aria-expanded="false"> Live Chat </a> </li>            
                            <li class=""> <a href="#NotificationSetting" data-toggle="tab" onclick="hideUpdateButton('1');" aria-expanded="false"> Notification Setting </a> </li>
                            {{-- <li class=""> <a href="#SMSSetting " onclick="hideUpdateButton('1');" data-toggle="tab" aria-expanded="false"> SMS Setting </a> </li>               --}}
                        </ul>
                        {!! Form::model($siteSetting, array('method' => 'put', 'route' => array('update.site.setting'), 'class' => 'form', 'files'=>true)) !!}
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="site"> @include('admin.site_setting.forms.form') </div>
                            <div class="tab-pane fade" id="email"> @include('admin.site_setting.forms.siteEmailSetting_form') </div>
                            <div class="tab-pane fade" id="social"> @include('admin.site_setting.forms.siteSocialSetting_form') </div>
                            <div class="tab-pane fade" id="ads"> @include('admin.site_setting.forms.siteAds_form') </div>
                            <div class="tab-pane fade" id="captcha"> @include('admin.site_setting.forms.captchaSetting_form') </div>
                            <div class="tab-pane fade" id="socialMediaLogin"> @include('admin.site_setting.forms.socialMediaLoginSetting_form') </div>
                            <div class="tab-pane fade" id="paymentGateways"> @include('admin.site_setting.forms.paymentGatewaysSetting_form') </div>
                            <div class="tab-pane fade" id="homePageSlider"> @include('admin.site_setting.forms.homePageSliderSetting_form') </div>
                            {{-- <div class="tab-pane fade" id="mailChimp"> @include('admin.site_setting.forms.mailChimpSetting_form') </div>
                            <div class="tab-pane fade" id="googleAnalytics"> @include('admin.site_setting.forms.googleAnalytics_form') </div>
                            <div class="tab-pane fade" id="jobg8_API"> @include('admin.site_setting.forms.jobg8_API_form') </div> --}}
                            <div class="tab-pane fade" id="LIVEChat"> @include('admin.site_setting.forms.LIVEChat') </div>
                            <div class="tab-pane fade" id="NotificationSetting"> @include('admin.site_setting.forms.notification_form') </div>
                            {{-- <div class="tab-pane fade" id="SMSSetting"> @include('admin.site_setting.forms.sms_setting') </div> --}}
                        </div>

                        <div class="form-actions" >
                            {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary hide_update_button ', 'type'=>'submit')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY --> 
    </div>
    @endsection
    @push('scripts')
    @include('admin.shared.tinyMCE')
    @endpush
    <script>
        function hideUpdateButton(val){
            if(val==1){
                $(".hide_update_button").addClass("hidden", true);
            }else{
                $(".hide_update_button").removeClass("hidden");
            }
        }
    </script>