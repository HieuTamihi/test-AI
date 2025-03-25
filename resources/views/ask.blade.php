<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỏi AI</title>
</head>
<body>
    <h2>Hỏi AI</h2>
    <form id="ask-form">
        @csrf
        <input type="text" id="question" placeholder="Nhập câu hỏi..." required>
        <button type="submit">Hỏi</button>
    </form>
    <div id="answer"></div>

    <script>
        document.querySelector("#ask-form").addEventListener("submit", async (e) => {
            e.preventDefault();
            let question = document.getElementById("question").value;
            let response = await fetch("{{ route('ask') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Content-Type": "application/json" },
                body: JSON.stringify({ question })
            });
            let result = await response.json();
            document.getElementById("answer").innerText = result.answer;
        });
    </script>
</body>
</html>