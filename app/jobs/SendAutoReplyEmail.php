<?php

namespace App\Jobs;

use App\Mail\CustomerAutoReply;
use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAutoReplyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $submission;
    public $customerEmail;

    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
        $this->customerEmail = $submission->email; // Get email from submission
    }

    public function handle()
    {
        Mail::to($this->customerEmail)
            ->send(new CustomerAutoReply($this->submission));
    }
}