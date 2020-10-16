<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UnlockedForm extends Mailable
{
    use Queueable, SerializesModels;

    protected array $parameters;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
        /*
        array(
            'study'=>'',
            'patientCode'=>'',
            'visitType'=>''
        )
        */
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.mail_unlocked_form')
        ->subject($this->parameters['study']." - Form Unlocked Patient - ".$this->parameters['patientCode'])
        ->with($this->parameters);
    }
}