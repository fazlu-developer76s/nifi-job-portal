<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use ImgUploader;
use Illuminate\Support\Facades\Validator;
use Input;
use Carbon\Carbon;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Resume;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests\FaqFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ResumeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexResume()
    {

        $resume = DB::table('resume_request as a')
            ->select('a.id as resume_id', 'a.user_id', 'a.title', 'a.created_at', 'a.resume_status', 'b.*')
            ->leftJoin('users as b', 'a.user_id', '=', 'b.id')
            ->orderBy('a.id', 'desc')
            ->get();

        return view('admin.resume.index')->with('resume', $resume);
    }

    public function editResume(Request $request, $user_id)
    {



        $get_resume_user = DB::table('resume_request as a')
            ->select('a.id as resume_id', 'a.user_id', 'a.title', 'a.created_at', 'a.resume_status', 'a.resume_file', 'b.*')
            ->leftJoin('users as b', 'a.user_id', '=', 'b.id')->where('user_id', $user_id)->orderBy('a.id', 'desc')
            ->get();

        return view('admin.resume.edit')->with('user_cv', $get_resume_user);
    }

    public function updateResume(Request $request)
    {
        if ($request->file('resume_file')) {
            $validator = Validator::make($request->all(), [
                'resume_file' => ['required', 'file', 'mimes:pdf'],
                'resume_status' => ['required'],
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        

        }
        $fileName = '';
        if ($request->hasFile('resume_file')) {
            $resume_file = $request->file('resume_file');
            $fileName = ImgUploader::UploadDoc('cvs', $resume_file, $request->input('title'));
        }else{
            $fileName = $request->hidden_file;
        }
        $resume_id = $request->resume_id;
        $user_id = $request->user_id;
        $resume_status = $request->resume_status;
        DB::table('resume_request')->where('id', $resume_id)->update(['resume_status' => $resume_status, 'resume_file' => $fileName]);
        if ($request->hidden_file=='') {
            DB::table('profile_cvs')->insert(['user_id' => $user_id, 'title' => 'Request Resume' . date('Y-m-d H:i:s') . '', 'resume_request_id' => $resume_id, 'cv_file' => $fileName, 'is_default' => 0, 'resume_status' => $resume_status, 'created_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('profile_cvs')->where('resume_request_id', $resume_id)->update(['cv_file' => $fileName, 'resume_status' => $resume_status, 'updated_at' => date('Y-m-d H:i:s')]);
        }
        return redirect()->route('edit.resume', ['user_id' => $user_id])->with('success', 'Resume updated successfully!');
    }
}
