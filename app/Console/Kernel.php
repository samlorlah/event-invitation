<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SendEventDayReminderMail',
        'App\Console\Commands\SendReminderMail',
        'App\Console\Commands\SendInvitationEmail',
        'App\Console\Commands\SendGratitudeEmail',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reminder:pre-event')->dailyAt('13:00');
        $schedule->command('reminder:event-day')->dailyAt('8:00');
        $schedule->command('reminder:event-day')->dailyAt('8:10');
        $schedule->command('reminder:event-day')->dailyAt('8:20');
        $schedule->command('reminder:event-day')->dailyAt('8:30');
        $schedule->command('reminder:event-day')->dailyAt('8:40');
        $schedule->command('reminder:event-day')->dailyAt('8:50');
        $schedule->command('reminder:event-day')->dailyAt('9:00');
        $schedule->command('gratitude')->dailyAt('8:00');
        $schedule->command('gratitude')->dailyAt('8:10');
        $schedule->command('gratitude')->dailyAt('8:20');
        $schedule->command('gratitude')->dailyAt('8:30');
        $schedule->command('gratitude')->dailyAt('8:40');
        $schedule->command('gratitude')->dailyAt('8:50');
        $schedule->command('gratitude')->dailyAt('9:00');
        $schedule->command('send:invitation')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
