<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeMail extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public function __construct($user)
    {
        
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Welcome!!!')
                    ->line('We are happy you are here.')
                    //->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')
                    ->markdown('welcome.index', ['user' => $this->user->name]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
