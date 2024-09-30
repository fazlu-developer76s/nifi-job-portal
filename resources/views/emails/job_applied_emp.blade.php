@extends('admin.layouts.email_template')
@section('content')
<table border="0" cellpadding="0" cellspacing="0" class="force-row" style="width: 100%; border-bottom: solid 1px #ccc;">
    <tr>
        <td class="content-wrapper" style="padding-left:24px;padding-right:24px"><br>
            <div class="title" style="font-family: Helvetica, Arial, sans-serif; font-size: 18px;font-weight:400;color: #000;text-align: left; padding-top: 20px;">
                Hello {{$company_name}} ,
            </div>
        </td>
    </tr>
    <tr>
        <td class="cols-wrapper" style="padding-left:12px;padding-right:12px">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="force-row" style="width: 100%;">
                <tr>
                    <td class="row" valign="top" style="padding-left:12px;padding-right:12px;padding-top:18px;padding-bottom:12px">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td class="subtitle" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:22px;font-weight:400;color:#333;padding-bottom:30px; text-align: left;">
                                    <p>You have received a new job application for the position "{{ $job_title }}" on your company "{{ $company_name }}".</p>                  

                                    <p>Here are the details of the applicant:</p>
                                    <ul>
                                        <li>Applicant Name: {{ $user_name }}</li>
                                        <li>Email: {{ $user_email }}</li>
                                    </ul>

                                    <p>You can view the full details of the job application using the link below:</p>

                                    <br>
                                    Job application details link:
                                    <span style="color: #fff;text-decoration: none;background: #f25a55; padding: 7px 10px;text-align: center;display: inline-block;margin-top: 20px;">
                                        <a href="{{ $job_link}}" style="color: #fff; text-decoration: none;">View Application</a>
                                    </span>
                                    <br><br>

                                    <p>For more details about the job posting, you can view the job details here:</p>

                                    Job details link:
                                    <span style="color: #fff;text-decoration: none;background: #f25a55; padding: 7px 10px;text-align: center;display: inline-block;margin-top: 20px;">
                                        <a href="{{ $job_link }}" style="color: #fff; text-decoration: none;">View Job</a>
                                    </span>
                                    <br>

                                    <br>
                                    Company profile link:
                                    <span style="color: #fff;text-decoration: none;background: #f25a55; padding: 7px 10px;text-align: center;display: inline-block;margin-top: 20px;">
                                        <a href="{{ $company_link }}" style="color: #fff; text-decoration: none;">View Company</a>
                                    </span>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Helvetica, Arial, sans-serif;font-size: 14px;line-height: 22px;font-weight: 400;color: #333; padding-bottom: 30px;text-align: left;">
                                    Thanks,<br>The {{ $siteSetting->site_name }} Team
                                </td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection
