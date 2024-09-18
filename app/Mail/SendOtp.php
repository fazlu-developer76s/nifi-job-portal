<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOtp extends Mailable
{

    use Queueable,
        SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
 public function build()
    {

       $recipientAddress = $this->data['email'];
       $recipientName = $this->data['name'];
        
       return $this->from([
        'address' => config('mail.from.address'),
        'name' => config('mail.from.name'),
    ])
    ->to($recipientAddress, $recipientName)
    ->subject($this->data['subject'])
    ->view('emails.otp')
    ->with($this->data);
    }


}
