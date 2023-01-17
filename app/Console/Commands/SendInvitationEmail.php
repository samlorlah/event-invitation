<?php

namespace App\Console\Commands;

use App\Guest;
use App\Mail\SendGuestInvite;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendInvitationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invitation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Inviation Email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $guests = Guest::where('invitation_sent', 0)->get();

        foreach($guests as $guest) {
            try {
                Mail::to($guest->email)->send(new SendGuestInvite($guest));
                $guest->invitation_sent = 1;
                $guest->update();
            } catch(\Exception $e) {
                dd($e->getMessage());
            }
        }
    }
}
