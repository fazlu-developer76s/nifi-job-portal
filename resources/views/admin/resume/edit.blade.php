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
                <li> <a href="{{ route('list.resume') }}">Resume</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Edit Resume</span> </li>
            </ul>
        </div>

        <br />
        @include('flash::message')
        <div class="row">
            <div  class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Update Resume Form</span> </div>
                    </div>
                    <div class="portlet-body form">          
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="Details"> @include('admin.resume.forms.edit_form') </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY --> 
    </div>
    @endsection