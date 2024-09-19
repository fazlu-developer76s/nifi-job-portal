<?php

namespace App\Http\Middleware;
use Auth;
use DB;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Kyc_middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company_id = Auth::guard('company')->user()->id;
        $get_user_info = DB::table('companies')->where('id',$company_id)->first();
        $get_kyc_reject_reason = DB::table('kyc_rejects')->where('company_id',$company_id)->orderBy('id','desc')->first();
        $reason = '';
        $reason = $get_kyc_reject_reason->reason;
        

        if($get_user_info->kyc_status == "pending" ){
            flash('Your KYC is currently under pending review. Please wait for further updates.!')->error();
            return redirect()->route('company.profile');
        }
        if($get_user_info->kyc_status == "submited" ){
            flash('Your KYC has been successfully submitted and is currently under review. We will notify you once the review process is complete. Thank you for your patience.')->error();
            return redirect()->route('company.profile');
        }
        if($get_user_info->kyc_status=="rejected"){
            flash('Your KYC has been rejected due to the following reason: '.$reason.'. Please address the issue and resubmit your KYC for further review.')->error();
            return redirect()->route('company.profile');
        }
        
        
        return $next($request);
    }
}
