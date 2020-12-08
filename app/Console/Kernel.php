<?php

namespace App\Console;

use App\Jobs\BotJob;
use App\Models\Address;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use GuzzleHttp;
use Illuminate\Support\Facades\Http;

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
        $schedule->call(function() {
            $addresses = Address::all();
            foreach ($addresses as $address){
                try {
                    // $status = $client->get($address->hostname);   guzzle
                    $status = Http::get($address->hostname);
                    if ($status->status() == 200){
                        $address->update(['status' => 1 ]);
                    }else{
                        if ($address->status == true) {
                            @BotJob::dispatch();
                        }
                        $address->update(['status' => 0 ]);
                    }
                }catch (\Exception $ex){
                    $address->update(['status' => 0 ]);
                }
            }
        })->everyMinute();
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
