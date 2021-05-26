<?php

namespace App\Mail\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterCompanyProvider extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $password;
    private $email;
    private $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $email, $company)
    {
        $this->user = $user;
        $this->password = $password;
        $this->email = $email;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(config('app.name').'-'.__('asunto_titulo_credenciales') )
            ->markdown('email.provider.register-company')
            ->with('user',$this->user)
            ->with('password',$this->password)
            ->with('company',$this->company)
            ->with('email',$this->email);
    }
}
