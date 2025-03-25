<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx|max:10240' // Chỉ nhận PDF và Word, max 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->storeAs('documents', $file->getClientOriginalName(), 'public');

        // Chạy script import vào RAG
        $process = new Process(['python3', base_path('scripts/import_document.py'), storage_path("app/public/$filePath")]);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['message' => 'Lỗi import tài liệu!'], 500);
        }

        return response()->json(['message' => 'Tài liệu đã được import thành công!']);
    }
    public function ask(Request $request)
    {
        $question = $request->input('question');

        // Gọi AI để trả lời
        $process = new Process(['python3', base_path('scripts/ask_ai.py'), $question]);
        $process->run();

        return response()->json(['answer' => $process->getOutput()]);
    }
}
