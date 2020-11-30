<?php

namespace App\Http\Controllers;


use App\Models\Address;
use GuzzleHttp;
use Log;


class AddressController extends Controller
{
    public function create()
    {
        return view('addresses.create');
    }
    public function store()
    {
        $addresses = Address::updateOrCreate(
            ['hostname' =>  request('hostname')]
        );
        $addresses->save();
        $this->setStatus();
        return redirect('/home');  //儲存後回到ＨＯＭＥ
    }

    private function setStatus(){
        $addresses = Address::all();
        $client = new GuzzleHttp\Client;
        foreach ($addresses as $address){
            try {
                $status = $client->get($address->hostname);
                if ($status->getStatusCode() == 200){
                    Address::where('hostname','=',$address->hostname)
                        ->update(['status' => 1]);
                }else{
                    Address::where('hostname','=',$address->hostname)
                        ->update(['status' => 0]);
                }
            }catch (\Exception $ex){
                Address::where('hostname','=',$address->hostname)
                    ->update(['status' => 0]);
            }
        }
    }



}

;
