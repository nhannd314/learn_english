import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import 'bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log('Alpine loaded');

window.playAudio = async function (word) {
    const audio = new Audio(audioUrl);

    try {
        await audio.play();
    } catch (error) {
        console.error("Lỗi phát âm thanh:", error);
    }

    // Nếu audio bị lỗi (404 hoặc không load được)
    audio.onerror = async () => {
        console.warn("File audio không tồn tại, đang gửi yêu cầu tạo lại...");

        // Gửi request lên server để tạo lại file audio
        try {
            const response = await fetch(`/api/words/${wordId}/regenerate`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
            });

            if (response.ok) {
                alert("Đang tạo lại file âm thanh, vui lòng thử lại sau vài giây.");
            } else {
                alert("Không thể tạo lại file audio.");
            }
        } catch (e) {
            console.error("Gửi request thất bại:", e);
        }
    };
};
