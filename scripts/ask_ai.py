import sys
import requests
import json

OLLAMA_URL = "http://127.0.0.1:11434/api/generate"  # API Ollama trên server

if len(sys.argv) < 2:
    print("Thiếu câu hỏi!")
    sys.exit(1)

question = sys.argv[1]

# Gửi yêu cầu đến Ollama
payload = {
    "model": "mistral",  # Chọn mô hình AI
    "prompt": question,
    "stream": False
}

response = requests.post(OLLAMA_URL, json=payload, headers={"Content-Type": "application/json"})

if response.status_code == 200:
    data = response.json()
    print(data["response"])  # In ra kết quả từ AI
else:
    print(f"Lỗi: {response.status_code}")
    print(response.text)
