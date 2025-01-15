{!! Form::model($company, array('method' => 'put', 'route' => array('update.company.profile'), 'class' => 'form', 'files'=>true)) !!}
<h5>{{__('Acount Information')}}</h5>
<div class="row">
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
            <label>{{__('Email')}}</label>
            {!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('Company Email'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
            <label>{{__('Password')}}</label>
            {!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>__('Password'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!}
        </div>
    </div>
</div>
<hr>
<h5>{{__('Complete Your KYC')}}</h5>
<span class="text_success text-success"></span>
<input type="hidden" id="company_type" value="{{ $company->company_type }}">
<input type="hidden" id="company_id" value="{{ $company->id }}">
@if($company->company_type == "private_limited" || $company->company_type == "public_limited")
<div class="row mb-3">
    <div class="col-md-12">
        <h4>{{ ucwords(str_replace('_',' ', $company->company_type)) }}</h4>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company Name" value="{{ $company->company_name ?? old('company_name') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_pan_no">Company PAN</label>
            <input type="text" name="company_pan_no" class="form-control" id="company_pan_no" placeholder="Company Pancard" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>

    {{-- <div class="col-md-6">
        <div class="formrow">
            <label for="company_coi">Company COI</label>
            <input type="text" name="company_coi" class="form-control" id="company_coi" placeholder="Company COI" value="{{ $company->company_coi ?? old('company_coi') }}">
        </div>
    </div> --}}

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_gst">Company GST (Optional)</label>
            <input type="text" name="company_gst" class="form-control" id="company_gst" placeholder="Company GST" value="{{ $company->company_gst ?? old('company_gst') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_pan_attachment">Attach Company PAN</label>
            <input type="file" name="company_pan_attachment" class="form-control" id="company_pan_attachment">
        </div>
    </div>
{{-- 
    <div class="col-md-6">
        <div class="formrow">
            <label for="company_coi_attachment">Attach Company COI</label>
            <input type="file" name="company_coi_attachment" class="form-control" id="company_coi_attachment">
        </div>
    </div> --}}

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_gst_attachment">Attach GST (Optional)</label>
            <input type="file" name="company_gst_attachment" class="form-control" id="company_gst_attachment">
        </div>
    </div>
</div>
@endif

<!-- For Partnership -->
@if($company->company_type == "partnership")
<div class="row mb-3">
    <div class="col-md-12">
        <h4>{{ ucwords(str_replace('_',' ', $company->company_type)) }}</h4>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_name">Firm Name</label>
            <input type="text" name="firm_name" class="form-control" id="firm_name" placeholder="Firm Name" value="{{ $company->firm_name ?? old('firm_name') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_pan">Firm PAN</label>
            <input type="text" name="firm_pan" class="form-control" id="firm_pan" placeholder="Firm Pancard" value="{{ $company->firm_pan ?? old('firm_pan') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_gst">Firm GST (Optional)</label>
            <input type="text" name="firm_gst" class="form-control" id="firm_gst" placeholder="Firm GST" value="{{ $company->firm_gst ?? old('firm_gst') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="partnership_deed_attachment">Attach Partnership Deed</label>
            <input type="file" name="partnership_deed_attachment" class="form-control" id="partnership_deed_attachment" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_pan_attachment">Attach Company PAN</label>
            <input type="file" name="company_pan_attachment" class="form-control" id="company_pan_attachment" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_gst_attachment">Attach GST</label>
            <input type="file" name="company_gst_attachment" class="form-control" id="company_gst_attachment" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>
</div>
@endif

<!-- For Proprietorship -->
@if($company->company_type == "proprietorship")
<div class="row mb-3">
    <div class="col-md-12">
        <h4>{{ ucwords(str_replace('_',' ', $company->company_type)) }}</h4>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_name">Firm Name</label>
            <input type="text" name="firm_name" class="form-control" id="firm_name" placeholder="Firm Name" value="{{ $company->firm_name ?? old('firm_name') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_pan">Firm Pancard</label>
            <input type="text" name="firm_pan" class="form-control" id="firm_pan" placeholder="Firm Pancard" value="{{ $company->firm_pan ?? old('firm_pan') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="firm_gst">Firm GST (Optional)</label>
            <input type="text" name="firm_gst" class="form-control" id="firm_gst" placeholder="Firm GST" value="{{ $company->firm_gst ?? old('firm_gst') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_pan_attachment">Attach Company PAN (Optional)</label>
            <input type="file" name="company_pan_attachment" class="form-control" id="company_pan_attachment" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <label for="company_gst_attachment">Attach GST</label>
            <input type="file" name="company_gst_attachment" class="form-control" id="company_gst_attachment" value="{{ $company->company_pan_no ?? old('company_pan_no') }}">
        </div>
    </div>
</div>
@endif

<div class="col-md-12 mt-3">
    <span type="submit" id="submit_kyc" class="btn btn-primary">Submit</button>
</div>




<hr>

<h5>{{__('Company Information')}}</h5>
<div class="row">
    <div class="col-md-6">
        <div class="formrow">
            <label>{{__('Company Logo')}}</label>
            {{ ImgUploader::print_image("company_logos/$company->logo", 100, 100) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{__('Select Company Logo')}}
                <input type="file" name="logo" id="logo" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'logo') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'name') !!}">
            <label>{{__('Company Name')}}</label>
            {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>__('Company Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'name') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'ceo') !!}">
            <label>{{__('CEO Name')}}</label>
            {!! Form::text('ceo', null, array('class'=>'form-control', 'id'=>'ceo', 'placeholder'=>__('Company CEO'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'ceo') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">
            <label>{{__('Industry')}}</label>
            {!! Form::select('industry_id', ['' => __('Select Industry')]+$industries, null, array('class'=>'form-control', 'id'=>'industry_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'ownership_type') !!}">
            <label>{{__('Ownership')}}</label>
            {!! Form::select('ownership_type_id', ['' => __('Select Ownership type')]+$ownershipTypes, null, array('class'=>'form-control', 'id'=>'ownership_type_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'ownership_type_id') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'description') !!}">
            <label>{{__('Description')}}</label>
            {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>__('Company details'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'description') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'location') !!}">
            <label>{{__('Address')}}</label>
            {!! Form::text('location', null, array('class'=>'form-control', 'id'=>'location', 'placeholder'=>__('Location'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'location') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'no_of_offices') !!}">
            <label>{{__('No of Office')}}</label>
            {!! Form::select('no_of_offices', ['' => __('Select num. of offices')]+MiscHelper::getNumOffices(), null, array('class'=>'form-control', 'id'=>'no_of_offices')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'no_of_offices') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'no_of_employees') !!}">
            <label>{{__('No of Employees')}}</label>
            {!! Form::select('no_of_employees', ['' => __('Select num. of employees')]+MiscHelper::getNumEmployees(), null, array('class'=>'form-control', 'id'=>'no_of_employees')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'no_of_employees') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'established_in') !!}">
            <label>{{__('Established In')}}</label>
            {!! Form::select('established_in', ['' => __('Select Established In')]+MiscHelper::getEstablishedIn(), null, array('class'=>'form-control', 'id'=>'established_in')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'established_in') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'website') !!}">
            <label>{{__('Website URL')}}</label>
            {!! Form::text('website', null, array('class'=>'form-control', 'id'=>'website', 'placeholder'=>__('Website'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'website') !!}
        </div>
    </div>


    <div class="col-md-4 d-none">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'fax') !!}">
            <label>{{__('Fax')}}</label>
            {!! Form::text('fax', null, array('class'=>'form-control', 'id'=>'fax', 'placeholder'=>__('Fax'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'fax') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'phone') !!}">
            <label>{{__('Phone')}}</label>
            {!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>__('Phone'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'phone') !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'facebook') !!}">
            <label>{{__('Facebook')}}</label>
            {!! Form::text('facebook', null, array('class'=>'form-control', 'id'=>'facebook', 'placeholder'=>__('Facebook'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'facebook') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'twitter') !!}">
            <label>{{__('Twitter')}}</label>
            {!! Form::text('twitter', null, array('class'=>'form-control', 'id'=>'twitter', 'placeholder'=>__('Twitter'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'twitter') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'linkedin') !!}">
            <label>{{__('LinkedIn')}}</label>
            {!! Form::text('linkedin', null, array('class'=>'form-control', 'id'=>'linkedin', 'placeholder'=>__('Linkedin'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'linkedin') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'google_plus') !!}">
            <label>{{__('Google Plus')}}</label>
            {!! Form::text('google_plus', null, array('class'=>'form-control', 'id'=>'google_plus', 'placeholder'=>__('Google+'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'google_plus') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'pinterest') !!}">
            <label>{{__('Pinterest')}}</label>
            {!! Form::text('pinterest', null, array('class'=>'form-control', 'id'=>'pinterest', 'placeholder'=>__('Pinterest'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'pinterest') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">
            <label>{{__('Country')}}</label>
            {!! Form::select('country_id', ['' => __('Select Country')]+$countries, old('country_id', (isset($company))? $company->country_id:$siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
            <label>{{__('State')}}</label>
            <span id="default_state_dd"> {!! Form::select('state_id', ['' => __('Select State')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
            <label>{{__('City')}}</label>
            <span id="default_city_dd"> {!! Form::select('city_id', ['' => __('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'map') !!}">
            <label>{{__('Google Map Iframe')}}</label>
            {!! Form::textarea('map', null, array('class'=>'form-control', 'id'=>'map', 'placeholder'=>__('Google Map'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'map') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="formrow">
            <button type="submit" class="btn">{{__('Update Profile and Save')}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        </div>
    </div>
</div>
<input type="file" name="image" id="image" style="display:none;" accept="image/*" />
{!! Form::close() !!}
<hr>
@push('styles')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('includes.tinyMCEFront')
<script type="text/javascript">
    $(document).ready(function() {
        $('#country_id').on('change', function(e) {
            e.preventDefault();
            filterLangStates(0);
        });
        $(document).on('change', '#state_id', function(e) {
            e.preventDefault();
            filterLangCities(0);
        });
        filterLangStates(<?php echo old('state_id', (isset($company)) ? $company->state_id : 0); ?>);

        /*******************************/
        var fileInput = document.getElementById("logo");
        fileInput.addEventListener("change", function(e) {
            var files = this.files
            showThumbnail(files)
        }, false)
    });

    function showThumbnail(files) {
        $('#thumbnail').html('');
        for (var i = 0; i < files.length; i++) {
            var file = files[i]
            var imageType = /image.*/
            if (!file.type.match(imageType)) {
                console.log("Not an Image");
                continue;
            }
            var reader = new FileReader()
            reader.onload = (function(theFile) {
                return function(e) {
                    $('#thumbnail').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');
                };
            }(file))
            var ret = reader.readAsDataURL(file);
        }
    }


    function filterLangStates(state_id) {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {
                    country_id: country_id,
                    state_id: state_id,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#default_state_dd').html(response);
                    filterLangCities(<?php echo old('city_id', (isset($company)) ? $company->city_id : 0); ?>);
                });
        }
    }

    function filterLangCities(city_id) {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown') }}", {
                    state_id: state_id,
                    city_id: city_id,
                    _method: 'POST',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    $('#default_city_dd').html(response);
                });
        }
    }
</script>
<script>
    $(document).ready(function() {
        $("#submit_kyc").click(function(event) {
            var company_type = $("#company_type").val();
            
            event.preventDefault(); // Prevent the default form submission

            // Clear previous error messages
            $('.error').remove();

            // Validation flags
            let valid = true;

            // Helper function to validate fields
            function validateField(selector, message) {
                const value = $(selector).val();
                if (value === undefined || value.trim() === "") {
                    valid = false;
                    $(selector).after(`<span class="error" style="color:red;">${message}</span>`);
                }
            }

            // Helper function to validate PDF attachments
            function validatePDF(selector, message) {
                const fileInput = $(selector)[0].files[0];
                if (fileInput && fileInput.type !== "application/pdf") {
                    valid = false;
                    $(selector).after(`<span class="error" style="color:red;">${message}</span>`);
                }
            }

            // Regex for PAN Card and GST validation
            const panCardRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            const gstNumberRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z]{1}[Z][0-9A-Z]{1}$/;
          
            if(company_type == "private_limited" || company_type == "public_limited"){
                // Validate text fields
                validateField("#company_name", "Company Name is required.");
                validateField("#company_pan_no", "Company PAN Number is required.");
                // validateField("#company_coi", "Company COI is required.");
                validateField("#company_gst", "Company GST Number is required.");
            }
            if(company_type == "partnership"){
                validateField("#firm_name", "Firm Name is required.");
                validateField("#firm_pan", "Firm PAN is required.");
            }
            if(company_type == "proprietorship"){
                validateField("#firm_name", "Firm Name is required.");
                validateField("#firm_pan", "Firm PAN is required.");
            }

            // Validate PAN and GST numbers
            const companyPanNo = $("#company_pan_no").val();
            const firmPan = $("#firm_pan").val();

            if(company_type == "private_limited" || company_type == "public_limited"){
                if (!panCardRegex.test(companyPanNo)) {
                    valid = false;
                    $("#company_pan_no").after('<span class="error" style="color:red;">Invalid Company PAN Number.</span>');
                }
            }
            if(company_type == "partnership" || company_type == "proprietorship"){
                if (!panCardRegex.test(firmPan)) {
                    valid = false;
                    $("#firm_pan").after('<span class="error" style="color:red;">Invalid Firm PAN Number.</span>');
                }
            }

            // Validate file inputs and check for PDF
            if(company_type == "private_limited" || company_type == "public_limited"){
                if (!$("#company_pan_attachment")[0].files.length) {
                    valid = false;
                    $("#company_pan_attachment").after('<span class="error" style="color:red;">Company PAN Attachment is required.</span>');
                } else {
                    validatePDF("#company_pan_attachment", "Company PAN Attachment must be a PDF.");
                }

                // if (!$("#company_coi_attachment")[0].files.length) {
                //     valid = false;
                //     $("#company_coi_attachment").after('<span class="error" style="color:red;">Company COI Attachment is required.</span>');
                // } else {
                //     validatePDF("#company_coi_attachment", "Company COI Attachment must be a PDF.");
                // }

                if (!$("#company_gst_attachment")[0].files.length) {
                    // valid = false;
                    // $("#company_gst_attachment").after('<span class="error" style="color:red;">Company GST Attachment is required.</span>');
                } else {
                    validatePDF("#company_gst_attachment", "Company GST Attachment must be a PDF.");
                }
            }
            if(company_type == "partnership"){
                if (!$("#partnership_deed_attachment")[0].files.length) {
                    valid = false;
                    $("#partnership_deed_attachment").after('<span class="error" style="color:red;">Partnership Deed Attachment is required.</span>');
                } else {
                    validatePDF("#partnership_deed_attachment", "Partnership Deed Attachment must be a PDF.");
                }

                if (!$("#company_pan_attachment")[0].files.length) {
                    valid = false;
                    $("#company_pan_attachment").after('<span class="error" style="color:red;">Firm PAN Attachment is required.</span>');
                } else {
                    validatePDF("#company_pan_attachment", "Firm PAN Attachment must be a PDF.");
                }

                if (!$("#company_gst_attachment")[0].files.length) {
                    valid = false;
                    $("#company_gst_attachment").after('<span class="error" style="color:red;">Firm GST Attachment is required.</span>');
                } else {
                    validatePDF("#company_gst_attachment", "Firm GST Attachment must be a PDF.");
                }
            }
            if(company_type == "proprietorship"){
                if (!$("#company_pan_attachment")[0].files.length) {
                    // valid = false;
                    // $("#company_pan_attachment").after('<span class="error" style="color:red;">Firm PAN Attachment is required.</span>');
                } else {
                    validatePDF("#company_pan_attachment", "Firm PAN Attachment must be a PDF.");
                }

                if (!$("#company_gst_attachment")[0].files.length) {
                    valid = false;
                    $("#company_gst_attachment").after('<span class="error" style="color:red;">Firm GST Attachment is required.</span>');
                } else {
                    validatePDF("#company_gst_attachment", "Firm GST Attachment must be a PDF.");
                }
            }

            if (!valid) {
                return; // Stop the form submission if validation fails
            }

            // If validation passes, proceed with AJAX
            var formData = new FormData();
            
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('company_type', $("#company_type").val());
            formData.append('company_id', $("#company_id").val());
            
            if(company_type == "private_limited" || company_type == "public_limited"){
                formData.append('company_name', $("#company_name").val());
                formData.append('company_pan_no', $("#company_pan_no").val());
                // formData.append('company_coi', $("#company_coi").val());
                formData.append('company_gst', $("#company_gst").val());
                formData.append('company_pan_attachment', $("#company_pan_attachment")[0].files[0]);
                // formData.append('company_coi_attachment', $("#company_coi_attachment")[0].files[0]);
                formData.append('company_gst_attachment', $("#company_gst_attachment")[0].files[0]);
            }
            if(company_type == "partnership"){
                formData.append('firm_name', $("#firm_name").val());
                formData.append('firm_gst', $("#firm_gst").val());
                formData.append('firm_pan', $("#firm_pan").val());
                formData.append('partnership_deed_attachment', $("#partnership_deed_attachment")[0].files[0]);
                formData.append('company_pan_attachment', $("#company_pan_attachment")[0].files[0]);
                formData.append('company_gst_attachment', $("#company_gst_attachment")[0].files[0]);
            }
            if(company_type == "proprietorship"){
                formData.append('firm_name', $("#firm_name").val());
                formData.append('firm_gst', $("#firm_gst").val());
                formData.append('firm_pan', $("#firm_pan").val());
                formData.append('company_pan_attachment', $("#company_pan_attachment")[0].files[0]);
                formData.append('company_gst_attachment', $("#company_gst_attachment")[0].files[0]);
            }

            $.ajax({
                url: '{{ route('update.kyc') }}',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if(response){
                        $(".text_success").text("Kyc Submit Successfully");
                    }
                    console.log('Success:', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX Error: ', textStatus);
                }
            });
        });
    });
</script>




@endpush