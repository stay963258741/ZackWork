<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
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


Route::get('address/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('address', [AddressController::class, 'store'])->name('addresses.store');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

