<?php

namespace App\Console\Commands;

use App\Jobs\BotJob;
use App\Models\Address;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchHostStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:host-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $addresses = Address::all();
        foreach ($addresses as $address) {
            try {
                $status = Http::get($address->hostname);
                 //$this->info(sprintf('%s | status %s',$address->hostname,$status->status()));  測試排成用

                if ($status->status() == 200) {
                    Address::where('hostname', '=', $address->hostname)
                        ->update(['status' => 1]);
                } else {
                    if ($address->status == true) {
                        BotJob::dispatch($address->hostname);
                    }
                    Address::where('hostname', '=', $address->hostname)
                        ->update(['status' => 0]);
                }
            } catch (Exception $ex) {
                Address::where('hostname', '=', $address->hostname)
                    ->update(['status' => 0]);
            }
        }
    }
}
