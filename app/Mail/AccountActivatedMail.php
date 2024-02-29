<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountActivatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $type;
    public string $data;

    public string $action;

    public string $password;

    /**
     * Create a new message instance.
     */
    public function __construct(string $type, string $data,$password, $action = 'created')
    {
        $this->type = $type;
        $this->data = $data;
        $this->action = $action;
        $this->password = $password;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Activated Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->type === 'etudiant') {
            return new Content(
                view: 'components.mails.etudiant-activated',
                with: ['data' => $this->data, 'action' => $this->action, 'password' => $this->password],
            );
        }
        elseif ($this->type === 'parent') {
            return new Content(
                view: 'components.mails.parent-activated',
                 with: ['data' => $this->data, 'action' => $this->action, 'password' => $this->password],
            );
        }

        elseif ($this->type === 'professeur') {
            return new Content(
                view: 'components.mails.prof-activated',
                 with: ['data' => $this->data, 'action' => $this->action, 'password' => $this->password],
            );
        }
        else{
            return new Content(
                view: 'components.mails.admin-activated',
                 with: ['data' => $this->data, 'action' => $this->action, 'password' => $this->password],
            );
        };



    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
