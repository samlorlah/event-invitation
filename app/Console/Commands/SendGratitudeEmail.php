<?php

namespace App\Console\Commands;

use App\Guest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendGratitudeEmail as GratitudeEmail;

class SendGratitudeEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gratitude';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminder_date = date('Y-m-d', env('EVENT_DATE'));
        $today = date('Y-m-d');

        if($today == $reminder_date) {
            $guests = Guest::where('gratitude_sent', 0)->get();
            foreach($guests as $guest) {
                if($guest->gratitude_sent == 0) {
                    Mail::to($guest->email)->send(new GratitudeEmail($guest));
                    $guest->gratitude_sent = 1;
                    $guest->update();
                }
            }
        }
    }
}
