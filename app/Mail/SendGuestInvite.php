<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendGuestInvite extends Mailable
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
        return $this->view('emails.invite')
        ->subject(config('app.name').' - INVITE FOR '.strtoupper($this->guest->full_name))
        ->with(['message' => $this])
        ->from('becomingthesannis23@gmail.com', config('app.name'));
    }
}
