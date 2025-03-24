<?php

use App\Http\Controllers\TelegramController;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/telegram-messages', [TelegramController::class, 'store']);
Route::post('/save-message', function (Request $request) {
    return response()->json([
        'message' => 'Tin nhắn đã được lưu!',
        'data' => $request->all(),
    ]);
});

Route::post('/send-message', function (Request $request) {
    $python_api_url = "http://127.0.0.1:5000/send-message";

    Log::info("Đang gửi request đến Python API:", $request->all()); // Kiểm tra request gửi đi

    try {
        $response = Http::post($python_api_url, [
            'chat_id' => $request->chat_id,
            'username' => $request->username,
            'message' => $request->message,
        ]);

        Log::info("Phản hồi từ Python API:", $response->json()); // Kiểm tra phản hồi từ Flask

        // 🟢 **Lưu tin nhắn vào database nếu gửi thành công**
        if ($response->successful()) {
            Message::create([
                'sender_id' => 933328807,
                'sender_name' => 'Bạn', // Có thể lấy từ Auth nếu có
                'message' => $request->message,
            ]);
        }
    } catch (\Exception $e) {
        Log::error("Lỗi gửi request:", ['error' => $e->getMessage()]);
        return response()->json(["error" => "Không thể kết nối đến Flask"], 500);
    }

    return response()->json($response->json());
});
