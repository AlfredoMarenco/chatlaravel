<?php

use App\Http\Controllers\ContactController;
use App\Http\Livewire\ChatComponent;
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
    return view('welcome');
});

Route::middleware('auth')->get('chat', ChatComponent::class)->name('chat.index');

Route::middleware('auth')->resource('contacts', ContactController::class)->middleware('auth')->except(['show']);
