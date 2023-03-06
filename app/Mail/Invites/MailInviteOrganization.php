<?php

namespace App\Mail\Invites;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInviteOrganization extends Mailable
{
    use Queueable, SerializesModels;
    private $data = [];
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
        return $this->from('klimushkin_test@mail.ru', $this->data['name'])
            ->subject($this->data['subject'])
            ->view('emails.invite_user_organization')->with('data', $this->data);
    }
}
