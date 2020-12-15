<?php

namespace App\Jobs;

use App\Models\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $timeout = 60;

    public $hostname;

    public function __construct($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $host = $this->hostname;
        $link = 'https://api.telegram.org/bot1422625730:AAEoBRxtV1xfZYjyrI8uL0bf0KKN4xK706w/sendMessage?chat_id=-476202703&text=The URL is wrong or the website has been closed, please check:';
        $response = Http::get($link . $host);

        Log::info($response->body());
    }
}
