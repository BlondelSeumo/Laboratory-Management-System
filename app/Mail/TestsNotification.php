<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Patient;
use App\Models\Setting;

class TestsNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $patient;
    public $info;
    public $emails;
    public $body;

    public function __construct(Patient $patient)
    {
        $this->patient=$patient;

        //info
        $this->info=setting('info');

        //patient code email
        $emails=setting('emails');
        $this->emails=$emails;

        //body
        $this->body=str_replace(['{patient_code}','{patient_name}'],[$patient['code'],$patient['name']],$emails['tests_notification']['body']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.tests_notification',[
            'body'=>$this->body,
            'emails'=>$this->emails,
            'info'=>$this->info
        ])
        ->subject($this->emails['tests_notification']['subject'])
        ->from($this->info['email'],'noreply');
    }
}
