<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $token;
    /**
     * @var false
     */
    private bool $isLogin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $isLogin = false)
    {
        $this->token = $token;
        $this->isLogin = $isLogin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans("Khadamat OTP Code"))
            ->markdown($this->isLogin ? 'Email.loginOtp' : 'Email.resetPassword')
            ->with(['token' => $this->token]);
    }
}
