<?php

namespace App\Http\Controllers\Company\Auth;

use Auth;
use DB;
use App\Company;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\CompanyFrontRegisterFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\CompanyRegistered;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/company-home';
    protected $userTable = 'companies';
    protected $redirectIfVerified = '/company-home';
    protected $redirectAfterVerification = '/company-home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company.guest', ['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('company');
    }

    public function register(CompanyFrontRegisterFormRequest $request)
    {
        
        $company = new Company();
        $get_kyc_info = DB::table('site_settings')->where('id',1272)->first();

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->company_type = $request->input('company_type');
        $company->company_name = $request->input('company_name');
        $company->company_pan_no = $request->input('company_pan');
        $company->company_coi = $request->input('company_coi');
        $company->company_gst = $request->input('company_gst');
        $company->firm_name = $request->input('firm_name');
        $company->firm_pan = $request->input('firm_pan');
        $company->firm_gst = $request->input('firm_gst');
        $company->password = bcrypt($request->input('password'));
        if($get_kyc_info->kyc_auto_approved ==  1){
        $company->kyc_status = "approved";
        }else{
        $company->kyc_status = "pending";
        }
        $company->is_active = 0;
        $company->verified = 0;
        $company->save();
        /*         * ******************** */
        $company->slug = Str::slug($company->name, '-') . '-' . $company->id;
        $company->update();
        /*         * ******************** */

        event(new Registered($company));
        event(new CompanyRegistered($company));
        $this->guard()->login($company);
        UserVerification::generate($company);
        UserVerification::send($company, 'Company Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));
        return $this->registered($request, $company) ?: redirect($this->redirectPath());
    }

}
