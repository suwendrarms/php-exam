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
        Commands\update_open_status::class,
        Commands\send_booking_sms::class,
        Commands\six_month_service_sms::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //->dailyAt('18:00')

        $schedule->command('command:booking_sms')
                 ->dailyAt('18:00')
                 ->timezone('Asia/Colombo');

        $schedule->command('command:six_month_service_sms')
                 ->dailyAt('18:30')
                 ->timezone('Asia/Colombo');
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
