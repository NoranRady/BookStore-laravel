<?php

namespace App\Services;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailService extends Mailable
{
    use Queueable, SerializesModels;
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }


    public function build()
    {
        return $this->markdown('email.name');

    }
}