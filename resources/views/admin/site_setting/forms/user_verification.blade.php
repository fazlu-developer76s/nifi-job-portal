{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">

    <div class="form-group">
        <label class="bold">Candidate Email OTP Verification</label>
        <br>
        <span>On:</span>
        <input type="radio" name="candidate_verification" value="1" @checked($siteSetting->candidate_verification == 1)>
        <span>Off:</span>
        <input type="radio" name="candidate_verification" value="0" @checked($siteSetting->candidate_verification == 0)>
    </div>
    
    <div class="form-group">
        <label class="bold">Employer Email OTP Verification</label>
        <br>
        <span>On:</span>
        <input type="radio" name="emp_verification" value="1" @checked($siteSetting->emp_verification == 1)>
        <span>Off:</span>
        <input type="radio" name="emp_verification" value="0" @checked($siteSetting->emp_verification == 0)>
    </div>
       

</div>
