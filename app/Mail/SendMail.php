<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $dataTemplate;

    public function __construct($data = null)
    {
        $this->dataTemplate = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->dataTemplate;

        return $this->from($user['email'])
            ->view('mail.demo')
            ->with(
                [
                    'name' => $user['name'],
                    'created_at' => Carbon::parse($user['created_at'])->format('Y-m-d H:i:s'),
                ]);
    }
}
