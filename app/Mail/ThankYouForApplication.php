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
    protected $jobPost;
    protected $request;
    public function __construct(JobPost $jobPost,Request $request)
    {
        $this->jobPost = $jobPost;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->jobPost->user->email, $this->jobPost->user->name)
            ->subject('دریافت رزومه')
            ->markdown('mails.exmpl')
            ->with([
                'name' => $this->request->name,
                'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}
