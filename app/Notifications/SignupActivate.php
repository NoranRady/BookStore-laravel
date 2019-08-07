<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SignupActivate extends Notification implements ShouldQueue
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $url = url('/api/auth/signup/activate/'.$notifiable->activation_token);
       // $url = url('www.google.com');
       
        return (new MailMessage)
                    ->subject('Confirm your account')
                    ->line('Please confirm your email before proceeding')
                    ->action('Confirm Account', url($url))
                    ->line('Thank you!');

        
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
