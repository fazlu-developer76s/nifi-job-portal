@extends('admin.layouts.admin_layout')
@push('css')
@endpush
@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Company Details</span> </li>
            </ul>
        </div>
        <div class="listpgWraper">
            <div class="container">
                <br><br>
                @include('flash::message')
                <!-- Job Header start -->
                <div class="job-header">
                    <div class="jobinfo">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <!-- Candidate Info -->
                                <div class="candidateinfo">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="userPic">{{$company->printCompanyImage()}}</div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="title">{{$company->name}}</div>
                                            <div class="desi">{{$company->getIndustry('industry')}}</div>
                                            <div class="loctext"><i class="fa fa-history" aria-hidden="true"></i>
                                                {{__('Member Since')}}, {{$company->created_at->format('M d, Y')}}
                                            </div>
                                            <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                {{$company->location}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            

                                <!-- Candidate Contact -->
                                <div class="candidateinfo">
                                    @if(!empty($company->phone))
                                    <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$company->phone}}">{{$company->phone}}</a></div>
                                    @endif
                                    @if(!empty($company->email))
                                    <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$company->email}}">{{$company->email}}</a></div>
                                    @endif
                                    @if(!empty($company->website) && filter_var($company->website, FILTER_VALIDATE_URL) !== FALSE)
                                    <div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> <a href="{{$company->website}}" target="_blank">{{$company->website}}</a></div>
                                    @else
                                    URL not present in profile
                                    @endif
                                    <div class="cadsocial"> {!!$company->getSocialNetworkHtml()!!} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job Detail start -->
                <div class="row">
                    <div class="col-md-8">
                        <!-- About Employee start -->
                        <div class="job-header">
                            <div class="contentbox">
                                <h3>{{__('About Company')}}</h3>
                                <p>{!! $company->description !!}</p>
                            </div>
                        </div>
                        <!-- Opening Jobs start -->
                        <div class="relatedJobs">
                            <h3>{{__('Job Openings')}}</h3>
                            <ul class="searchList">
                                <?php $jobs = $company->jobs()->notExpire()->where('jobs.is_active', 1)->get(); ?>
                                @if(isset($jobs) && count($jobs))
                                @foreach($jobs as $companyJob)
                                <!--Job start-->
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="jobinfo">
                                                <h3><a href="{{ route('public.job', ['id' => $companyJob->id]) }}"
                                                        title="{{$companyJob->title}}">{{$companyJob->title}}</a></h3>
                                                <div class="location">
                                                    <label class="fulltime"
                                                        title="{{$companyJob->getJobType('job_type')}}">{{$companyJob->getJobType('job_type')}}</label>
                                                    <label class="partTime"
                                                        title="{{$companyJob->getJobShift('job_shift')}}">{{$companyJob->getJobShift('job_shift')}}</label>
                                                    - <span>{{$companyJob->getCity('city')}}</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="listbtn"><a
                                                    href="{{ route('public.job', ['id' => $companyJob->id]) }}">{{__('View Job Details')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p>{{\Illuminate\Support\Str::limit(strip_tags($companyJob->description), 150, '...')}}</p>
                                </li>
                                <!--Job end-->
                                @endforeach
                                @endif
                                <!-- Job end -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Company Detail start -->
                        <div class="job-header">
                            <div class="jobdetail">
                                <h3>{{__('KYC Status')}}</h3>
                                <div class="form-group">
                                <label>Kyc Auto Approved:</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="active"  onclick="AutoapprovedKyc('1')" {{ ($site_setting->kyc_auto_approved==1)?'checked':''; }}> On
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" value="inactive" onclick="AutoapprovedKyc('0')" {{ ($site_setting->kyc_auto_approved==0)?'checked':''; }}> Off
                                    </label>
                                </div>
                            </div>
                                @if($company->company_type == "private_limited" || $company->company_type == "public_limited")
                                <ul class="jbdetail">
                                <span class="kyc_status_update text-primary"></span>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Type')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_type}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Name')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_name}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Pan')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_pan_no}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Coi')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_coi}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Gst')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_gst}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company PAN')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->company_pan_attachment) }}" target="_blank">View PAN Attachment</a></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company COI')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->company_coi_attachment) }}" target="_blank">View COI Attachment</a></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Gst PDF')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->company_gst_attachment) }}" target="_blank">View GST Attachment</a></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Action')}}</div>
                                        <div class="col-md-6 col-xs-6">
                                            <span>
                                                <select class="form-control" onchange="Kyc_status_update(this.value, {{$company->id}});">
                                                    <option value="" disabled selected>Select Status</option>
                                                    <option value="pending" {{ ($company->kyc_status == "pending")?'selected':'';}}>Pending</option>
                                                    <option value="submited" {{ ($company->kyc_status == "submited")?'selected':'';}}>Submited</option>
                                                    <option value="approved" {{ ($company->kyc_status == "approved")?'selected':'';}}>Approved</option>
                                                    <option value="rejected" {{ ($company->kyc_status == "rejected")?'selected':'';}}>Rejected</option>
                                                </select>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                @endif
                                @if($company->company_type == "proprietorship" || $company->company_type == "partnership")
                                <ul class="jbdetail">
                                    <span class="kyc_status_update text-primary"></span>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company Type')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->company_type}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Firm Name')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->firm_name}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Firm Pan')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->firm_pan}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Firm Gst')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->firm_gst}}</span>
                                        </div>
                                    </li>
                                    @if($company->company_type!="proprietorship")
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Partnership Deed')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->partnership_deed_attachment) }}" target="_blank">View Partnership Deed Attachment</a></span>
                                        </div>
                                    </li>
                                    @endif
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Company PAN')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->company_pan_attachment) }}" target="_blank">View Company Pan Attachment</a></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Gst')}}</div>
                                        <div class="col-md-6 col-xs-6"> <span><a href="{{ Storage::url($company->company_gst_attachment) }}" target="_blank">View Company GST Attachment</a></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Action')}}</div>
                                        <div class="col-md-6 col-xs-6">
                                            <span>
                                                <select class="form-control" onchange="Kyc_status_update(this.value, {{$company->id}});">
                                                    <option value="" disabled selected>Select Status</option>
                                                    <option value="pending" {{ ($company->kyc_status == "pending")?'selected':'';}}>Pending</option>
                                                    <option value="submited" {{ ($company->kyc_status == "submited")?'selected':'';}}>Submited</option>
                                                    <option value="approved" {{ ($company->kyc_status == "approved")?'selected':'';}}>Approved</option>
                                                    <option value="rejected" {{ ($company->kyc_status == "rejected")?'selected':'';}}>Rejected</option>
                                                </select>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="job-header">
                            <div class="jobdetail">
                                <h3>{{__('Company Details')}}</h3>
                                <ul class="jbdetail">
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Email Verified')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{((bool)$company->verified)? 'Yes':'No'}}</span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Total Employees')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->no_of_employees}}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Established In')}}</div>
                                        <div class="col-md-6 col-xs-6"><span>{{$company->established_in}}</span></div>
                                    </li>
                                    <li class="row">
                                        <div class="col-md-6 col-xs-6">{{__('Current jobs')}}</div>
                                        <div class="col-md-6 col-xs-6">
                                            <span>{{$company->countNumJobs('company_id',$company->id)}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">KYC Rejected Reason</h4>
            </div>
            <div class="modal-body">
                <form id="modalForm" action="{{ route('reject.kyc') }}" method="post">
                    @csrf
                    <input type="hidden" name="kyc_status" id="kyc_status">
                    <input type="hidden" name="company_id" id="company_id">
                    <div class="form-group">
                        <label for="reason">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>



@endsection
@push('styles')
<style type="text/css">
    .formrow iframe {
        height: 78px;
    }
</style>
@endpush
@push('scripts')
<script type="text/javascript"></script>
<script>
    function Kyc_status_update(kyc_status,company_id) {

        if (kyc_status === 'rejected') {
            $("#kyc_status").val(kyc_status);
            $("#company_id").val(company_id);
            $('#myModal').modal('show');
        } else {
            let confirmation = confirm('Are You Sure Update Kyc Status');
            if (confirmation) {
                
                var kyc_status = kyc_status;
                var company_id = company_id;
                $.ajax({
                    url: '{{ route('update.kyc_status') }}',
                    type: 'post',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        kyc_status: kyc_status,
                        company_id: company_id,
                    }),
                    success: function(response) {
                        $(".kyc_status_update").text("Update Kyc Status successfully")
                        if (response === 1 ) {
                            setTimeout(function() {
                                $(".kyc_status_update").text(" ")
                                window.location.reload(); 
                            }, 2000);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('AJAX Error: ', textStatus);
                    }
                });
            } else {
                return false;
            }
        }

    }
</script>
<script>
    function AutoapprovedKyc(kyc_status){
        
        
        var kyc_status = kyc_status;
      
        $.ajax({
            url: '{{ route('kyc.autoapproved') }}',
            type: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                _token: '{{ csrf_token() }}',
                kyc_status: kyc_status,
            }),
            success: function(response) {

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    
    }
</script>
@endpush