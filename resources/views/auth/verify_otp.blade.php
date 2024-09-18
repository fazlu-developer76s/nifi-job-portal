@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Header start -->
    @include('includes.inner_page_title', ['page_title' => __('Verify Email OTP')])
    <!-- Header end -->



    <div class="authpages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="useraccountwrap">
                        <div class="userccount whitebg">


                            <div class="card-body text-center">
                                <h3>{{ __('Verify Your Email OTP') }}</h3>


                                {{-- <p>{{ __('Before proceeding, please check your email for a verification link.') }} <br> --}}
                                {{-- {{ __('If you did not receive the email') }}, --}}
                                </p>
                                @if ($user['candidate_or_employer'] == 'candidate')
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @else
                                        <form class="form-horizontal" method="POST"
                                            action="{{ env('APP_URL') . 'company/login' }}">
                                @endif

                                <h5 class="text-danger text_danger "></h5>
                                @csrf
                                <input type="hidden" name="otp_status" class="otp_status">
                                <input type="number" name="otp" id="otp" class="form-control" required>
                                <span class="text-danger form_error"></span>
                                <input type="hidden" name="email" id="email" class="form-control"
                                    value="{{ $user['email'] ?? '' }}">
                                <input type="hidden" name="password" id="password" class="form-control"
                                    value="{{ $user['password'] ?? '' }}">
                                <input type="hidden" name="candidate_or_employer" id="candidate_or_employer"
                                    class="form-control" value="{{ $user['candidate_or_employer'] ?? '' }}">
                                <span type="submit" class="btn btn-primary mt-3"
                                    onclick="CheckOtp();">{{ __('Submit') }}</span>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function CheckOtp() {

            let otp = $("#otp").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let candidate_or_employer = $("#candidate_or_employer").val();
            if (otp == '' || otp.length != 4) {
                $(".form_error").text("Please enter Valid OTP");
                return false;
            }
            $(".form_error").text(" ");
            $.ajax({
                url: '{{ route('auth.check_otp') }}',
                type: 'post',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    _token: '{{ csrf_token() }}',
                    otp: otp,
                    email: email,
                    candidate_or_employer: candidate_or_employer,
                    password: password
                }),
                success: function(response) {
                    if (response == 1) {
                        $(".otp_status").val("true");
                        $("form").submit();
                    }
                    if (response == 2) {
                        $(".text_danger").text("Invalid OTP");
                    } else {
                        $(".text_danger").text(" ");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX Error: ', textStatus);
                }
            });
        }
    </script>
    @include('includes.footer')
@endsection
