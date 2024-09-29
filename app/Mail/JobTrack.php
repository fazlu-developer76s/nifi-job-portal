<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobTrack extends Mailable
{

    use SerializesModels;

    public $job;
    public $jobApply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job, $jobApply,$company,$status)
    {
        $this->job = $job;
        $this->jobApply = $jobApply;
        $this->company = $company;
        $this->status = $status;
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
    $job_status = $this->status;
    

    $recipientAddress = config('mail.recieve_to.address');
    $recipientName = config('mail.recieve_to.name');

    return $render =   $this->from([
        'address' => $recipientAddress,
        'name' => $recipientName,
    ])
    ->replyTo($recipientAddress, $recipientName)
    ->to($user->email, $user->name)
    ->subject($user->name . ' your Job Status "' . $this->job->title)
    ->view('emails.job_track')
    ->with([
        'job_title' => $this->job->title,
        'company_name' => $company->name,
        'user_name' => $user->name,
        'job_status' => $job_status,
        'company_link' => route('company.detail', $company->slug),
        'job_link' => route('job.detail', [$this->job->slug]),
    ]);
    
}


}

