<?php

namespace App\Console\Commands;

use App\Guest;
use Illuminate\Console\Command;
use App\Mail\SendEventDayReminder;
use Illuminate\Support\Facades\Mail;

class SendEventDayReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:event-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder email on event morning';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminder_date = date('Y-m-d', strtotime('2023-02-04'));
        $today = date('Y-m-d');

        if($today == $reminder_date) {
            $guests = Guest::all();
            foreach($guests as $guest) {
                Mail::to($guest->email)->send(new SendEventDayReminder($guest));
            }
        }
    }
}
