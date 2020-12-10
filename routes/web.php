<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Models\Address;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome',[
        'address' => App\Models\Address::latest()->get()
        ]);
});

Route::get('address', function () {
    $addresses = Address::paginate(10);
    $addresses->withPath('home/url');
});

Route::get('address/create', [AddressController::class, 'create'])->name('addresses.create');

Route::get('/address/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');

Route::put('/address/{id}', [AddressController::class, 'update'])->name('addresses.update');

Route::post('address', [AddressController::class, 'store'])->name('addresses.store');

Route::DELETE('address/{delete}',[AddressController::class, 'destroy'])->name('addresses.destroy');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

