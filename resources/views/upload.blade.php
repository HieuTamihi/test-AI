<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tài Liệu</title>
</head>
<body>
    <h2>Upload Tài Liệu</h2>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
    <div id="message"></div>

    <script>
        document.querySelector("form").addEventListener("submit", async (e) => {
            e.preventDefault();
            let formData = new FormData(e.target);
            let response = await fetch("{{ route('upload') }}", {
                method: "POST",
                body: formData,
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            });
            let result = await response.json();
            document.getElementById("message").innerText = result.message;
        });
    </script>
</body>
</html>
