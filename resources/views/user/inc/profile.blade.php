
{!! Form::model($user, array('method' => 'put', 'route' => array('my.profile'), 'class' => 'form', 'files'=>true)) !!}

<h5>{{__('Account Information')}}</h5>
<div class="row">
<div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'email') !!}">
			<label for="">{{__('Email')}}</label>
			{!! Form::text('email', null, array('class'=>'form-control', 'id'=>'email', 'placeholder'=>__('Email'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'email') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'password') !!}">
			<label for="">{{__('Password')}}</label>
			{!! Form::password('password', array('class'=>'form-control', 'id'=>'password', 'placeholder'=>__('Password'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'password') !!} </div>
    </div>
</div>

<hr>

<h5>{{__('Personal Information')}}</h5>

<div class="row">
    <div class="col-md-6">
        <div class="formrow">
			<label>{{__('Profile Image')}}</label>
			{{ ImgUploader::print_image("user_images/$user->image", 100, 100) }} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail"></div>
            <label class="btn btn-default"> {{__('Select Profile Image')}}
                <input type="file" name="image" id="image" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'image') !!} </div>
    </div>
	
		
</div>


<h6>{{__('Cover Photo')}}</h6>

<div class="row">
    <div class="col-md-6">
        <div class="formrow"> {{ ImgUploader::print_image("user_images/$user->cover_image", 120, 50) }} </div>
    </div>

    <div class="col-md-6">
        <div class="formrow">
            <div id="thumbnail_cover_image"></div>
            <label class="btn btn-default"> {{__('Select Cover Photo')}}
                <input type="file" name="cover_image" id="cover_image" style="display: none;">
            </label>
            {!! APFrmErrHelp::showErrors($errors, 'cover_image') !!} </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'first_name') !!}">
			<label for="">{{__('First Name')}}</label>
			{!! Form::text('first_name', null, array('class'=>'form-control', 'id'=>'first_name', 'placeholder'=>__('First Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'first_name') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'middle_name') !!}">
			<label for="">{{__('Midlle Name')}}</label>
			{!! Form::text('middle_name', null, array('class'=>'form-control', 'id'=>'middle_name', 'placeholder'=>__('Middle Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'middle_name') !!}</div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'last_name') !!}">
			<label for="">{{__('Last Name')}}</label>
			{!! Form::text('last_name', null, array('class'=>'form-control', 'id'=>'last_name', 'placeholder'=>__('Last Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'last_name') !!}</div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'father_name') !!}">
			<label for="">{{__('Father Name')}}</label>
			{!! Form::text('father_name', null, array('class'=>'form-control', 'id'=>'father_name', 'placeholder'=>__('Father Name'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'father_name') !!} </div>
    </div>
    
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'gender_id') !!}">
			<label for="">{{__('Gender')}}</label>
			{!! Form::select('gender_id', [''=>__('Select Gender')]+$genders, null, array('class'=>'form-control', 'id'=>'gender_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'marital_status_id') !!}">
			<label for="">{{__('Martial Status')}}</label>
			{!! Form::select('marital_status_id', [''=>__('Select Marital Status')]+$maritalStatuses, null, array('class'=>'form-control', 'id'=>'marital_status_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'marital_status_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'country_id') !!}">
			<label for="">{{__('Country')}}</label>
            <?php $country_id = old('country_id', (isset($user) && (int) $user->country_id > 0) ? $user->country_id : $siteSetting->default_country_id); ?>
            {!! Form::select('country_id', [''=>__('Select Country')]+$countries, $country_id, array('class'=>'form-control', 'id'=>'country_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'country_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'state_id') !!}">
			<label for="">{{__('State')}}</label>
			<span id="state_dd"> {!! Form::select('state_id', [''=>__('Select State')], null, array('class'=>'form-control', 'id'=>'state_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'state_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'city_id') !!}">
			<label for="">{{__('City')}}</label>
			<span id="city_dd"> {!! Form::select('city_id', [''=>__('Select City')], null, array('class'=>'form-control', 'id'=>'city_id')) !!} </span> {!! APFrmErrHelp::showErrors($errors, 'city_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'nationality_id') !!}">
			<label for="">{{__('Nationality')}}</label>
			{!! Form::select('nationality_id', [''=>__('Select Nationality')]+$nationalities, null, array('class'=>'form-control', 'id'=>'nationality_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'nationality_id') !!} </div>
    </div>
    <div class="col-md-6">
       
		
		<div class="formrow {!! APFrmErrHelp::hasError($errors, 'date_of_birth') !!}">
            <?php 

            if(!empty($user->date_of_birth)){

                $d = $user->date_of_birth;
            }else{
                $d = date('Y-m-d', strtotime('-16 years'));
            }
            $dob = old('date_of_birth')?date('Y-m-d',strtotime(old('date_of_birth'))):date('Y-m-d',strtotime($d));


            ?>
			<label for="">{{__('Date of Birth')}}</label>
			{!! Form::date('date_of_birth', $dob, array('class'=>'form-control', 'id'=>'date_of_birth', 'placeholder'=>__('Date of Birth'), 'autocomplete'=>'off')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!} </div>
		
		
		
		
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'national_id_card_number') !!}">
			<label for="">{{__('National ID')}}</label>
			{!! Form::text('national_id_card_number', null, array('class'=>'form-control', 'id'=>'national_id_card_number', 'placeholder'=>__('National ID Card#'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'national_id_card_number') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'phone') !!}">
			<label for="">{{__('Phone')}}</label>
			{!! Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone', 'placeholder'=>__('Phone'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'phone') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'mobile_num') !!}">
			<label for="">{{__('Mobile')}}</label>
			{!! Form::text('mobile_num', null, array('class'=>'form-control', 'id'=>'mobile_num', 'placeholder'=>__('Mobile Number'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'mobile_num') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'adhar_no') !!}">
			<label for="">{{__('Aadhar')}}</label>
			{!! Form::text('adhar_no', null, array('class'=>'form-control', 'id'=>'adhar_no', 'placeholder'=>__('Aadhar Number'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'adhar_no') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'pan_no') !!}">
			<label for="">{{__('Pancard')}}</label>
			{!! Form::text('pan_no', null, array('class'=>'form-control', 'id'=>'pan_no', 'placeholder'=>__('Pancard Number'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'pan_no') !!} </div>
    </div>   
    <div class="col-md-12">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'street_address') !!}">
			<label for="">{{__('Street Address')}}</label>
			{!! Form::textarea('street_address', null, array('class'=>'form-control', 'id'=>'street_address', 'placeholder'=>__('Street Address'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'street_address') !!} </div>
    </div>
	
</div>

<hr>
<h5>{{__('Add Video Profile')}}</h5>

<div class="row">
    <div class="col-md-12" id="video_link_id">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'video_link') !!}">
            <label for="">{{__('Video Link')}} - sample: https://www.youtube.com/embed/538cRSPrwZU</label>
            {!! Form::textarea('video_link', null, array('class'=>'form-control', 'id'=>'video_link', 'placeholder'=>__('Video Link'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'video_link') !!} </div>
    </div>
</div>
<hr>

<h5>{{__('Career Information')}}</h5>

<div class="row">
 <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'job_experience_id') !!}">
			<label for="">{{__('Job Experience')}}</label>
			{!! Form::select('job_experience_id', [''=>__('Select Experience')]+$jobExperiences, null, array('class'=>'form-control', 'id'=>'job_experience_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'job_experience_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'career_level_id') !!}">
			<label for="">{{__('Career Level')}}</label>
			{!! Form::select('career_level_id', [''=>__('Select Career Level')]+$careerLevels, null, array('class'=>'form-control', 'id'=>'career_level_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'career_level_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'industry_id') !!}">
			<label for="">{{__('Select Industry')}}</label>
			{!! Form::select('industry_id', [''=>__('Select Industry')]+$industries, null, array('class'=>'form-control', 'id'=>'industry_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'industry_id') !!} </div>
    </div>
    <div class="col-md-6">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'functional_area_id') !!}">
			<label for="">{{__('Functional Area')}}</label>
			{!! Form::select('functional_area_id', [''=>__('Select Functional Area')]+$functionalAreas, null, array('class'=>'form-control', 'id'=>'functional_area_id')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'functional_area_id') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'current_salary') !!}">
			<label for="">{{__('Current Salary')}}</label>
			{!! Form::text('current_salary', null, array('class'=>'form-control', 'id'=>'current_salary', 'placeholder'=>__('Current Salary'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'current_salary') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'expected_salary') !!}">
			<label for="">{{__('Expected Salary')}}</label>
			{!! Form::text('expected_salary', null, array('class'=>'form-control', 'id'=>'expected_salary', 'placeholder'=>__('Expected Salary'))) !!}
            {!! APFrmErrHelp::showErrors($errors, 'expected_salary') !!} </div>
    </div>
    <div class="col-md-4">
        <div class="formrow {!! APFrmErrHelp::hasError($errors, 'salary_currency') !!}">
			<label for="">{{__('Salary Currency')}}</label>			
            @php
            $salary_currency = Request::get('salary_currency', (isset($user) && !empty($user->salary_currency))? $user->salary_currency:$siteSetting->default_currency_code);
            @endphp
            {!! Form::text('salary_currency', $salary_currency, array('class'=>'form-control', 'id'=>'salary_currency', 'placeholder'=>__('Salary Currency'), 'autocomplete'=>'off')) !!}
            {!! APFrmErrHelp::showErrors($errors, 'salary_currency') !!} </div>
    </div>
</div>
	
	
	
	<div class="row">
	
    <div class="col-md-12">
    <div class="formrow {!! APFrmErrHelp::hasError($errors, 'is_subscribed') !!}">
    <?php
	$is_checked = 'checked="checked"';	
	if (old('is_subscribed', ((isset($user)) ? $user->is_subscribed : 1)) == 0) {
		$is_checked = '';
	}
	?>
      <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
      {{__('Subscribe to news letter')}}
      {!! APFrmErrHelp::showErrors($errors, 'is_subscribed') !!}
      </div>
  </div>
    <div class="col-md-12">
        <div class="formrow"><button type="submit" id="Update_profile" class="btn">{{__('Update Profile and Save')}}  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></div>
    </div>
</div>


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
<script type="text/javascript">
    $(document).ready(function () {
        initdatepicker();
        $('#salary_currency').typeahead({
            source: function (query, process) {
                return $.get("{{ route('typeahead.currency_codes') }}", {query: query}, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });

        $('#country_id').on('change', function (e) {
            e.preventDefault();
            filterStates(0);
        });
        $(document).on('change', '#state_id', function (e) {
            e.preventDefault();
            filterCities(0);
        });
        filterStates(<?php echo old('state_id', $user->state_id); ?>);

        /*******************************/
        var fileInput = document.getElementById("image");
        fileInput.addEventListener("change", function (e) {
            var files = this.files
            showThumbnail(files)
        }, false)
		
		var fileInput_cover_image = document.getElementById("cover_image");

        fileInput_cover_image.addEventListener("change", function (e) {

            var files_cover_image = this.files

            showThumbnail_cover_image(files_cover_image)

        }, false)
		
		
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
                reader.onload = (function (theFile) {
                    return function (e) {
                        $('#thumbnail').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');
                    };
                }(file))
                var ret = reader.readAsDataURL(file);
            }
        }
		
		
		function showThumbnail_cover_image(files) {

        $('#thumbnail_cover_image').html('');

        for (var i = 0; i < files.length; i++) {

            var file = files[i]

            var imageType = /image.*/

            if (!file.type.match(imageType)) {

                console.log("Not an Image");

                continue;

            }

            var reader = new FileReader()

            reader.onload = (function (theFile) {

                return function (e) {

                    $('#thumbnail_cover_image').append('<div class="fileattached"><img height="100px" src="' + e.target.result + '" > <div>' + theFile.name + '</div><div class="clearfix"></div></div>');

                };

            }(file))

            var ret = reader.readAsDataURL(file);

        }

    }
		
		
    });

    function filterStates(state_id)
    {
        var country_id = $('#country_id').val();
        if (country_id != '') {
            $.post("{{ route('filter.lang.states.dropdown') }}", {country_id: country_id, state_id: state_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#state_dd').html(response);
                        filterCities(<?php echo old('city_id', $user->city_id); ?>);
                    });
        }
    }
    function filterCities(city_id)
    {
        var state_id = $('#state_id').val();
        if (state_id != '') {
            $.post("{{ route('filter.lang.cities.dropdown') }}", {state_id: state_id, city_id: city_id, _method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('#city_dd').html(response);
                    });
        }
    }
    function initdatepicker() {
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
    }

    // Aadhaar validation
    $('#adhar_no').on('input', function () {
        const adharRegex = /^\d{12}$/; // 12 digits
        const adharInput = $(this).val();
        if (!adharRegex.test(adharInput)) {
            $(this).next('.error-message').remove(); // Remove any previous error message
            $(this).after('<span class="error-message" style="color:red;">Invalid Aadhaar number. It must be 12 digits.</span>');
            $("#Update_profile").attr("disabled",true);
        } else {
            $(this).next('.error-message').remove(); // Valid, so remove the error message
            $("#Update_profile").attr("disabled",false);
        }
    });

    // PAN card validation
    $('#pan_no').on('input', function () {
        const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // 5 letters, 4 digits, 1 letter
        const panInput = $(this).val();
        if (!panRegex.test(panInput)) {
            $(this).next('.error-message').remove(); // Remove any previous error message
            $(this).after('<span class="error-message" style="color:red;">Invalid PAN number. Format should be AAAAA9999A.</span>');
            $("#Update_profile").attr("disabled",true);
        } else {
            $(this).next('.error-message').remove(); // Valid, so remove the error message
            $("#Update_profile").attr("disabled",false);
        }
    });
</script>
@endpush            