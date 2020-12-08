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

class BotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $addresses  = Address::all();
        foreach ($addresses as $address){
            $add = $address->hostname;
        }
        $link = 'https://api.telegram.org/bot1422625730:AAEoBRxtV1xfZYjyrI8uL0bf0KKN4xK706w/sendMessage?chat_id=-476202703&text=網址錯誤或網站已關閉·請檢查:';
        Http::get($link . $add);
    }
}
