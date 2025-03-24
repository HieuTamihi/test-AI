<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('messages', compact('messages'));
    }

    public function getMessages()
    {
        $messages = Message::all(); // Lấy tất cả tin nhắn từ DB
        return response()->json($messages); // Trả về JSON
    }

    public function store(Request $request)
    {
        Log::info('Dữ liệu nhận được:', $request->all());
        try {
            $message = Message::create([
                'sender_id'   => $request->sender_id,
                'sender_name' => $request->sender_name,
                'message'     => $request->message,
            ]);
    
            return response()->json(['message' => 'Tin nhắn đã được lưu!', 'data' => $message]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
