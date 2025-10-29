<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->subject('Thank You for Contacting Jochan Tech')
                    ->view('emails.customer-auto-reply')
                    ->with([
                        'submission' => $this->submission,
                    ]);
    }
}