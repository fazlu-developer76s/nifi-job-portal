<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobAppliedEmp extends Mailable
{

    use SerializesModels;

    public $job;
    public $jobApply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job, $jobApply,$company)
    {
        $this->job = $job;
        $this->jobApply = $jobApply;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    
    $company = $this->company;
    $user = $this->jobApply;
    

    $recipientAddress = config('mail.recieve_to.address');
    $recipientName = config('mail.recieve_to.name');

    return $render =   $this->from([
        'address' => $recipientAddress,
        'name' => $recipientName,
    ])
    ->replyTo($recipientAddress, $recipientName)
    ->to($company->email, $company->name)
    ->subject($company->name . ' job applied  "' . $user->name ." Job Title : " . $this->job->title)
    ->view('emails.job_applied_emp')
    ->with([
        'job_title' => $this->job->title,
        'company_name' => $company->name,
        'user_name' => $user->name,
        'user_email' => $user->email,
        'company_link' => route('company.detail', $company->slug),
        'job_link' => route('job.detail', [$this->job->slug])
    ]);
    
}


}

