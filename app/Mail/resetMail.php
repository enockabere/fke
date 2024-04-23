<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class resetMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $random;
    public $domain;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$random,$domain)
    {
        $this->email = $email;
        $this->domain = $domain;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->email)
            ->from("maebaenock95@gmail.com")
            ->subject("Reset Password")
            ->replyTo('fkehq@fke-kenya.org')
            ->markdown('profile/resetEmail');
    }
}