<?php

namespace App\Console\Commands;

use App\Guest;
use Illuminate\Console\Command;
use App\Mail\SendPreEventReminder;
use Illuminate\Support\Facades\Mail;

class SendReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:pre-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder to all invited guests before the event';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminder_date = date('Y-m-d', strtotime('2023-01-28'));
        $today = date('Y-m-d');

        if($today == $reminder_date) {
            $guests = Guest::all();
            foreach($guests as $guest) {
                Mail::to($guest->email)->send(new SendPreEventReminder($guest));
            }
        }
    }
}
