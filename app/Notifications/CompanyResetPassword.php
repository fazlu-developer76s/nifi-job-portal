<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Ensure that the 'from' method takes email and name as two parameters, not an array
        return (new MailMessage)
            ->subject('Company Password Reset')
            ->from(config('mail.from.address'), config('mail.from.name')) // Fixed this line
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url('company/password/reset', $this->token))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
