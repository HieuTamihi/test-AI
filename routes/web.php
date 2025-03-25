<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('ask');
});

//telegram
Route::get('/telegram-messages', [TelegramController::class, 'index']);
Route::get('/get-messages', [TelegramController::class, 'getMessages']);

//chat-AI
Route::get('/ask', function () {
    return view('ask');
});
Route::post('/ask', [DocumentController::class, 'ask'])->name('ask');

//
Route::get('/import', function () {
    return view('upload');
});
Route::post('/upload', [DocumentController::class, 'upload'])->name('upload');