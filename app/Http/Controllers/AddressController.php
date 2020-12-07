<?php

namespace App\Http\Controllers;


use App\Models\Address;
use GuzzleHttp;
use Illuminate\Support\Facades\Http;


class AddressController extends Controller
{
    public function create()
    {
        return view('addresses.create');
    }

    public function store()
    {
        $addresses = Address::updateOrCreate(
            ['hostname' => request('hostname')]
        );
        $addresses->save();
        $this->setStatus();
        return redirect('/home');  //儲存後回到ＨＯＭＥ
    }

    private function setStatus()
    {
        $addresses = Address::all();
        $client = new GuzzleHttp\Client;
        foreach ($addresses as $address){
            try {
                // $status = $client->get($address->hostname);   guzzle
                $status = Http::get($address->hostname);
                if ($status->status() == 200){
                    $address->update(['status' => 1 ]);
                }else{
                    if ($address->status == true) {
                        Http::get('https://api.telegram.org/bot1422625730:AAEoBRxtV1xfZYjyrI8uL0bf0KKN4xK706w/sendMessage?chat_id=-476202703&text=網址錯誤');
                    }
                    $address->update(['status' => 0 ]);
                }
            }catch (\Exception $ex){
                $address->update(['status' => 0 ]);
            }
        }
    }

    public function destroy($id)
    {
        Address::where('id', $id)->delete();
        return redirect('home');
    }
}


