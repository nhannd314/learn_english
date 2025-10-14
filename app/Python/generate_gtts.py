from gtts import gTTS
import sys
import os

def main():
    if len(sys.argv) < 2:
        print("Error: missing word")
        return

    # Tạo thư mục nếu chưa có
    output_dir = "storage/app/public/words"
    os.makedirs(output_dir, exist_ok=True)

    # Nối từ
    #word = " ".join(sys.argv[1:])
    word = sys.argv[1]
    language = 'en'
    filename = word.replace(" ", "-").lower() + ".mp3"
    filepath = os.path.join(output_dir, filename)

    # Kiểm tra file đã tồn tại chưa
    if os.path.exists(filepath):
        print(f"File exists: {filepath}")
        return

    # Tạo file mp3
    tts = gTTS(text=word, lang=language)
    tts.save(filepath)

    print(f"Created:{filepath}")

if __name__ == "__main__":
    main()
