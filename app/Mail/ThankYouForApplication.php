<?php

namespace App\Mail;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThankYouForApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobPost $jobPost,Request $request)
    {
        $this->jobPost = $jobPost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(JobPost $jobPost, Request $request)
    {
        return $this->from($jobPost->user->email, $jobPost->user->name)
            ->subject('تشکر')
            ->markdown('mails.exmpl')
            ->with([
                'name' => 'New Mailtrap User',
                'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}
