<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat với AI</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white shadow-lg rounded-lg p-6 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Chat với AI</h2>
        
        <div class="mb-4">
            <textarea id="prompt" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Nhập câu hỏi..."></textarea>
        </div>
        
        <button id="send" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Gửi</button>
        
        <div class="mt-4 p-3 border rounded-lg bg-gray-50 min-h-[50px]">
            <h3 class="text-lg font-semibold text-gray-700">Câu trả lời:</h3>
            <p id="response" class="mt-2 text-gray-600">...</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#send").click(function() {
                var prompt = $("#prompt").val();
                $("#response").text("Đang xử lý...");
                
                $.ajax({
                    url: "/ask-ollama",
                    type: "POST",
                    data: { prompt: prompt },
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    success: function(response) {
                        $("#response").text(response.response);
                    },
                    error: function() {
                        $("#response").text("Lỗi! Không thể kết nối với Ollama.");
                    }
                });
            });
        });
    </script>

</body>
</html>