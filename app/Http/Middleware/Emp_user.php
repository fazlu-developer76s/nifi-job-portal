<?php

namespace App\Http\Middleware;
use Auth;
use DB;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class Emp_user
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $emp_user_id  = session('emp_user');
        $get_permission = array();
        $get_permission = DB::table('companies_users')->where('id',$emp_user_id)->first();

        if( isset($get_permission->dashboard_per) &&  $get_permission->dashboard_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->edit_per) &&  $get_permission->edit_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->public_profile_per) &&  $get_permission->public_profile_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->post_job_per) &&  $get_permission->post_job_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->company_job_per) &&  $get_permission->company_job_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->cv_search_per) &&  $get_permission->cv_search_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->unlocked_user_per) &&  $get_permission->unlocked_user_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->company_message_per) &&  $get_permission->company_message_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->recommended_seeker_per) &&  $get_permission->recommended_seeker_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->company_follower_per) &&  $get_permission->company_follower_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }

        if( isset($get_permission->report_per) &&  $get_permission->report_per == 1){
            return $next($request);
        }elseif(empty(session('emp_user'))){
            return $next($request);
        }else{
            flash('You Have No Permission View This Page')->error();
            return redirect()->route('/');            
        }        
        
    }
}

