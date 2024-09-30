<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FavCompany extends Mailable
{

    use SerializesModels;

 
    public $jobApply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($jobApply,$company)
    {

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
    ->to($user->email, $user->name)
    ->subject( ' Add Fav Company "' . $this->company->name)
    ->view('emails.fav_job')
    ->with([
      
        'company_name' => $company->name,
        'user_name' => $user->name,
        'company_link' => route('company.detail', $company->slug),
     
    ]);
    
}


}

