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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('backup:clean')->daily()->at('15:55');
        // $schedule->command('backup:run')->daily()->at('16:00');
        // $schedule->call('App\Http\Controllers\PMS\Agenda\AgendaMastController@agenda_reminder')->everyThirtyMinutes();
        $schedule->call('App\Http\Controllers\TodosController@update_todo_missed')->dailyAt('10:53');
        $schedule->call('App\Http\Controllers\PMS\Agenda\AgendaResponseController@enter_agenda_missed')->dailyAt('23:55');

        $schedule->call('App\Http\Controllers\CRM\CRMController@expired_subscription')->dailyAt('10:00');
        $schedule->call('App\Http\Controllers\CRM\CRMController@expired_package')->dailyAt('23:55');

        $schedule->call('App\Http\Controllers\PMS\Schedule\ScheduleController@display_reminder')->dailyAt('10:00');
        $schedule->call('App\Http\Controllers\HomeController@cause_list_reminder')->dailyAt('06:30');
        // $schedule->call('App\Http\Controllers\HomeController@cause_list_reminder')->dailyAt('08:30');
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
