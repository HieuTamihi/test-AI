<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tin Nhắn Telegram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5ddd5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .chat-container {
            width: 700px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-header {
            background: #0088cc;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .chat-box {
            padding: 15px;
            height: 400px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .message {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            max-width: 70%;
        }

        .message .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message .content {
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            word-wrap: break-word;
            /* Cho trình duyệt tự xuống dòng */
            overflow-wrap: break-word;
            /* Đảm bảo xuống dòng đúng */
            white-space: pre-wrap;
        }

        .message.sent {
            justify-content: flex-end;
            text-align: right;
            align-self: flex-end;
        }

        .message.sent .content {
            background: #0088cc;
            color: white;
            border-radius: 10px 10px 0 10px;
        }

        .message.received {
            justify-content: flex-start;
            text-align: left;
            align-self: flex-start;
        }

        .message.received .content {
            background: #f1f0f0;
            color: black;
            border-radius: 10px 10px 10px 0;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            background: #fff;
            border-top: 1px solid #ddd;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .chat-input button {
            background: #0088cc;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
        }

        .username {
            font-size: 12px;
            color: gray;
            margin-bottom: 2px;
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <div class="chat-header">Chat Telegram</div>
        <ul id="message-list">
            @foreach ($messages as $msg)
                <li>
                    <b>{{ $msg->sender_name ?? 'Unknown' }}</b>
                    {{ $msg->message }}
                </li>
            @endforeach
        </ul>
        <div class="chat-input">
            <input type="text" id="recipient" placeholder="Nhập Chat ID hoặc @username"><br><br>
            <textarea id="messageInput" placeholder="Nhập tin nhắn"></textarea><br><br>
            <button onclick="sendMessage()">Gửi</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        function sendMessage() {
            let recipient = document.getElementById("recipient").value;
            let message = document.getElementById("messageInput").value;

            if (!recipient || !message) {
                alert("Vui lòng nhập Chat ID hoặc Username và tin nhắn!");
                return;
            }

            let requestBody = {
                message: message
            };

            if (/^\d+$/.test(recipient)) {
                requestBody.chat_id = recipient;
            } else {
                requestBody.username = recipient;
            }

            console.log("Đang gửi:", requestBody);

            fetch("http://127.0.0.1:8000/api/send-message", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(requestBody)
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Phản hồi từ server:", data);
                    if (data.success) {
                        alert("Gửi tin nhắn thành công!");

                        // 🟢 **Thêm tin nhắn vào danh sách ngay lập tức**
                        let messageList = document.getElementById("message-list");
                        let li = document.createElement("li");
                        li.innerHTML = `<b>Bạn:</b> ${message}`;
                        messageList.appendChild(li);

                        document.getElementById("messageInput").value = "";
                    } else {
                        console.log("Lỗi: " + data.error);
                    }
                })
                .catch(error => {
                    console.error("Lỗi fetch:", error);
                });
        }

        function loadMessages() {
            fetch("http://127.0.0.1:8000/get-messages")
                .then(response => response.json())
                .then(data => {
                    let messageList = document.getElementById("message-list");
                    messageList.innerHTML = "";
                    data.forEach(msg => {
                        let li = document.createElement("li");
                        li.innerHTML = `<b>${msg.sender_name}:</b> ${msg.message}`;
                        messageList.appendChild(li);
                    });
                })
                .catch(error => console.error("Lỗi:", error));
        }

        setInterval(loadMessages, 3000);
        loadMessages();
    </script>
</body>

</html>
