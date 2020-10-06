<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FranchiseeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ControllerData)
    {
        $this->data = $ControllerData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('it-noreply@cpbangladesh.com')
            ->subject('Application for new franchisee')
            ->view('mail.apply-franchisee')
            ->with('data', $this->data);
    }
}
