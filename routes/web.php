<?php

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
    return view('chat');
});

//telegram
Route::get('/telegram-messages', [TelegramController::class, 'index']);
Route::get('/get-messages', [TelegramController::class, 'getMessages']);

//chat-AI
Route::get('/chat', function () {
    return view('chat');
});
Route::post('/ask-ollama', function (Request $request) {
    $response = Http::post('http://127.0.0.1:11434/api/generate', [
        'model' => 'gemma:2b',
        'prompt' => $request->input('prompt'),
        'stream' => false
    ]);

    return response()->json($response->json());
});