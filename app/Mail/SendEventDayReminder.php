<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEventDayReminder extends Mailable
{
    use Queueable, SerializesModels;
    public $guest;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($guest)
    {
        $this->guest = $guest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.on_day_reminder')
        ->subject('REMINDER - '. config('app.name'). ' - INVITE FOR '.strtoupper($this->guest->full_name))
        ->from('becomingthesannis23@gmail.com', config('app.name'));
    }
}
