<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\CvFolder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CvFolderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CvFolder $cvFolder, Application $application)
    {
        $this->cvFolder = $cvFolder;
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content= str_replace(['{{name}}','{{company}}'], [$this->application->candidate->name,$this->cvFolder->company->name], $this->cvFolder->email_template);
        return $this->from('no-reply@bala-tar.com', $this->cvFolder->jobPost->user->name)
            ->subject('آخرین وضعیت درخواست همکاری')
            ->html($content)
            ->with([
                'company'=> $this->cvFolder->company->name,
                'name' => $this->application->candidate->name,
            ]);    }
}
