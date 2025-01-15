@extends('layouts.app')

@section('content')

<!-- Header start -->

@include('includes.header')

<!-- Header end -->
<!-- Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Register')])
<!-- Title end -->


<div class="authpages">

    <div class="container">

        <div class="row">
            <div class="col-lg-5">
                @include('flash::message')



                <div class="useraccountwrap">
                    <div class="userbtns">

                        <ul class="nav nav-tabs">

                            <?php

                            $c_or_e = old('candidate_or_employer', 'candidate');

                            ?>

                            <li class="nav-item"><a class="nav-link {{($c_or_e == 'candidate')? 'active':''}}" data-bs-toggle="tab" href="#candidate" aria-expanded="true">{{__('Candidate')}}</a></li>

                            <li class="nav-item"><a class="nav-link {{($c_or_e == 'employer')? 'active':''}}" data-bs-toggle="tab" href="#employer" aria-expanded="false">{{__('Employer')}}</a></li>

                        </ul>

                    </div>

                    <div class="userccount whitebg">


                        <div class="tab-content">

                            <div id="candidate" class="formpanel mt-0 tab-pane {{($c_or_e == 'candidate')? 'active':''}}">
                                <h3>{{__('Register as a Candidate')}}</h3>
                                <form class="form-horizontal mt-3" method="POST" action="{{ route('register') }}">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="candidate_or_employer" value="candidate" />

                                    <div class="formrow{{ $errors->has('first_name') ? ' has-error' : '' }}">

                                        <input type="text" name="first_name" class="form-control" required="required" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">

                                        @if ($errors->has('first_name')) <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('middle_name') ? ' has-error' : '' }}">

                                        <input type="text" name="middle_name" class="form-control" placeholder="{{__('Middle Name')}}" value="{{old('middle_name')}}">

                                        @if ($errors->has('middle_name')) <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('last_name') ? ' has-error' : '' }}">

                                        <input type="text" name="last_name" class="form-control" required="required" placeholder="{{__('Last Name')}}" value="{{old('last_name')}}">

                                        @if ($errors->has('last_name')) <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">

                                        <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">

                                        @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('adhar_no') ? ' has-error' : '' }}">

                                        <input type="adhar_no" name="adhar_no" id="adhar_no" class="form-control" required="required" placeholder="{{__('Aadhar Number')}}" value="{{old('adhar_no')}}">

                                        @if ($errors->has('adhar_no')) <span class="help-block"> <strong>{{ $errors->first('adhar_no') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('pan_no') ? ' has-error' : '' }}">

                                        <input type="pan_no" name="pan_no" id="pan_no" class="form-control" required="required" placeholder="{{__('Pancard Number')}}" value="{{old('pan_no')}}">

                                        @if ($errors->has('pan_no')) <span class="help-block"> <strong>{{ $errors->first('pan_no') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">

                                        <input type="password" name="password" class="form-control" required="required" placeholder="{{__('Password')}}" value="">

                                        @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                                        <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{__('Password Confirmation')}}" value="">

                                        @if ($errors->has('password_confirmation')) <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif
                                    </div>



                                    <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">

                                        <?php

                                        $is_checked = '';

                                        if (old('is_subscribed', 1)) {

                                            $is_checked = 'checked="checked"';
                                        }

                                        ?>



                                        <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} />
                                        {{__('Subscribe to Newsletter')}}

                                        @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif
                                    </div>





                                    <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">

                                        <input type="checkbox" value="1" name="terms_of_use" />

                                        <a href="{{url('cms/terms-of-use')}}">{{__('I accept Terms of Use')}}</a>



                                        @if ($errors->has('terms_of_use')) <span class="help-block"> <strong>{{ $errors->first('terms_of_use') }}</strong> </span> @endif
                                    </div>

                                    <div class="form-group col-12 col-sm-12 col-md-10 text-center mx-auto mobile-padding-no {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response')) <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </span> @endif
                                    </div>

                                    <input type="submit" id="user_register" class="btn" value="{{__('Register')}}">

                                </form>

                            </div>

                            <div id="employer" class="formpanel mt-0 tab-pane fade {{($c_or_e == 'employer')? 'active':''}}">
                                <h3>{{__('Register as a Employer')}}</h3>
                                <form class="form-horizontal mt-3" id="form" method="POST" action="{{ route('company.register') }}">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="candidate_or_employer" value="employer" />

                                    <!-- Company Type Select -->
                                    <div class="formrow{{ $errors->has('company_type') ? ' has-error' : '' }}">
                                        <select name="company_type" id="company_type" class="form-control" required>
                                            <option value="" disabled selected>{{__('Select Company Type')}}</option>
                                            <option value="private_limited" {{ old('company_type') == 'private_limited' ? 'selected' : '' }}>
                                                {{__('Private Limited')}}
                                            </option>
                                            <option value="public_limited" {{ old('company_type') == 'public_limited' ? 'selected' : '' }}>
                                                {{__('Public Limited')}}
                                            </option>
                                            <option value="partnership" {{ old('company_type') == 'partnership' ? 'selected' : '' }}>
                                                {{__('Partnership')}}
                                            </option>
                                            <option value="proprietorship" {{ old('company_type') == 'proprietorship' ? 'selected' : '' }}>
                                                {{__('Proprietorship')}}
                                            </option>
                                        </select>

                                        @if ($errors->has('company_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('company_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <!-- Dynamic Fields for Company/Firm -->
                                    <div id="dynamic-fields" style="display: none;">
                                        <div id="company-fields" style="display: none;">
                                            <div class="formrow">
                                                <input type="text" id="company_name" name="company_name" class="form-control" placeholder="{{__('Company Name')}}">
                                            </div>
                                            <div class="formrow">
                                                <input type="text" id="company_pan" name="company_pan" class="form-control" placeholder="{{__('Company PAN')}}">
                                            </div>
                                            {{-- <div class="formrow">
                                                <input type="text" id="company_coi" name="company_coi" class="form-control" placeholder="{{__('Company COI')}}">
                                            </div> --}}
                                            <div class="formrow">
                                                <input type="text" id="company_gst" name="company_gst" class="form-control" placeholder="{{__('Company GST ')}}">
                                            </div>
                                        </div>

                                        <div id="firm-fields" style="display: none;">
                                            <div class="formrow">
                                                <input type="text" id="firm_name" name="firm_name" class="form-control" placeholder="{{__('Firm Name')}}">
                                            </div>
                                            <div class="formrow">
                                                <input type="text" id="firm_pan" name="firm_pan" class="form-control" placeholder="{{__('Firm PAN')}}">
                                            </div>
                                            <div class="formrow">
                                                <input type="text" id="firm_gst" name="firm_gst" class="form-control" placeholder="{{__('Firm GST')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="formrow{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input type="text" name="name" class="form-control" required="required" placeholder="{{__('Name')}}" value="{{old('name')}}">
                                        @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" name="email" class="form-control" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                        @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" name="password" class="form-control" required="required" placeholder="{{__('Password')}}" value="">
                                        @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{__('Password Confirmation')}}" value="">
                                        @if ($errors->has('password_confirmation')) <span class="help-block"> <strong>{{ $errors->first('password_confirmation') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('is_subscribed') ? ' has-error' : '' }}">
                                        <?php $is_checked = old('is_subscribed', 1) ? 'checked="checked"' : ''; ?>
                                        <input type="checkbox" value="1" name="is_subscribed" {{$is_checked}} /> {{__('Subscribe to Newsletter')}}
                                        @if ($errors->has('is_subscribed')) <span class="help-block"> <strong>{{ $errors->first('is_subscribed') }}</strong> </span> @endif
                                    </div>

                                    <div class="formrow{{ $errors->has('terms_of_use') ? ' has-error' : '' }}">
                                        <input type="checkbox" value="1" name="terms_of_use" />
                                        <a href="{{url('cms/terms-of-use')}}">{{__('I accept Terms of Use')}}</a>
                                        @if ($errors->has('terms_of_use')) <span class="help-block"> <strong>{{ $errors->first('terms_of_use') }}</strong> </span> @endif
                                    </div>

                                    <div class="form-group col-12 col-sm-12 col-md-10 text-center mx-auto mobile-padding-no {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response')) <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </span> @endif
                                    </div>

                                    <input type="submit" class="btn" value="{{__('Register')}}">

                                </form>


                            </div>

                        </div>

                        <!-- sign up form -->

                        <div class="newuser"><i class="fas fa-user" aria-hidden="true"></i> {{__('Have Account')}}? <a href="{{route('login')}}">{{__('Sign in')}}</a></div>

                        <!-- sign up form end-->



                    </div>

                </div>
            </div>

            <div class="col-lg-7">
                <div class="loginpageimg"><img src="{{asset('/')}}images/login-page-banner.png" alt=""></div>
            </div>

        </div>



    </div>

</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Aadhaar validation
        $('#adhar_no').on('input', function() {
            const adharRegex = /^\d{12}$/; // 12 digits
            const adharInput = $(this).val();
            if (!adharRegex.test(adharInput)) {
                $(this).next('.error-message').remove(); // Remove any previous error message
                $(this).after('<span class="error-message" style="color:red;">Invalid Aadhaar number. It must be 12 digits.</span>');
                $("#user_register").attr("disabled", true);
            } else {
                $(this).next('.error-message').remove(); // Valid, so remove the error message
                $("#user_register").attr("disabled", false);
            }
        });
        // PAN card validation
        $('#pan_no').on('input', function() {
            const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/; // 5 letters, 4 digits, 1 letter
            const panInput = $(this).val();
            if (!panRegex.test(panInput)) {
                $(this).next('.error-message').remove(); // Remove any previous error message
                $(this).after('<span class="error-message" style="color:red;">Invalid PAN number. Format should be AAAAA9999A.</span>');
                $("#user_register").attr("disabled", true);
            } else {
                $(this).next('.error-message').remove(); // Valid, so remove the error message
                $("#user_register").attr("disabled", false);
            }
        });

        $(document).ready(function() {
            // Handle company type change
            $('#company_type').on('change', function() {
                var selectedType = $(this).val();
                $('#dynamic-fields').show();
                $('#company-fields').hide();
                $('#firm-fields').hide();

                if (selectedType === 'private_limited' || selectedType === 'public_limited') {
                    $('#company-fields').show();
                 
                } else if (selectedType === 'partnership' || selectedType === 'proprietorship') {
                    $('#firm-fields').show();
                 
                }
            });


        });


    });
</script>
<script>
    
    $(document).ready(function() {
    // Add custom validation methods for PAN
    $.validator.addMethod("panFormat", function(value, element) {
        return this.optional(element) || /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(value);
    }, "Please enter a valid PAN number (e.g., ABCDE1234F).");

    // Initialize validation
    $('#form').validate({
        rules: {
            company_name: {
                required: function() {
                    return $('#company-fields').is(':visible');
                },
                minlength: 2
            },
            company_pan: {
                required: function() {
                    return $('#company-fields').is(':visible');
                },
                minlength: 10,
                maxlength: 10,
                panFormat: true // Validate using PAN regex
            },
            company_coi: {
                required: function() {
                    return $('#company-fields').is(':visible');
                }
            },
            // Removed validation for company_gst

            firm_name: {
                required: function() {
                    return $('#firm-fields').is(':visible');
                },
                minlength: 2
            },
            firm_pan: {
                required: function() {
                    return $('#firm-fields').is(':visible') && $('#company_type').val() === 'partnership';
                },
                minlength: 10,
                maxlength: 10,
                panFormat: true // Validate using PAN regex
            },
            // Removed validation for firm_gst
        },
        messages: {
            company_name: "Please enter a valid company name.",
            company_pan: "Please enter a valid PAN (10 characters).",
            company_coi: "Please provide the company COI.",
            firm_name: "Please enter a valid firm name.",
            firm_pan: "Please enter a valid PAN (10 characters)."
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('help-block');
            element.closest('.formrow').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.formrow').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.formrow').removeClass('has-error');
        }
    });

    // Function to update validation rules based on company type
    function updateValidationRules() {
        var companyType = $('#company_type').val();
        
        $('#form').validate().settings.rules['firm_pan'].required = function() {
            return $('#firm-fields').is(':visible') && companyType === 'partnership';
        };
        
        // Revalidate the form to apply new rules
        $('#form').validate().element('#firm_pan');
    }

    // Bind change event to update validation rules when company type changes
    $('#company_type').change(updateValidationRules);
    
    // Trigger change event on page load to apply initial rules
    $('#company_type').trigger('change');
});

</script>


@endpush
@include('includes.footer')

@endsection