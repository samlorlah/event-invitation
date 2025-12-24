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
        $reminder_date = date('Y-m-d', env('EVENT_DATE'));
        $today = date('Y-m-d');

        if($today == $reminder_date) {
            $guests = Guest::where('dday_reminder_sent', 0)->get();
            foreach($guests as $guest) {
                if($guest->dday_reminder_sent == 0) {
                    Mail::to($guest->email)->send(new SendEventDayReminder($guest));
                    $guest->dday_reminder_sent = 1;
                    $guest->update();
                }
            }
        }
    }
}
