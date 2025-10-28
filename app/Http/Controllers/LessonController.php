<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LessonController extends Controller
{
    public function show(Lesson $lesson, Request $request)
    {
        $lesson->load('words');

        // Lưu vào danh sách bài học đã xem
        $cookieData = $request->cookie('recent_lessons');
        $recent_lessons = $cookieData ? json_decode($cookieData, true) : [];
        // 4. Đưa ID bài viết hiện tại lên đầu mảng
        $recent_lessons = array_unique(array_merge([(int)$lesson->id], $recent_lessons));

        // 5. Giới hạn số lượng bài viết (ví dụ: 5 bài gần nhất)
        $recent_lessons = array_slice($recent_lessons, 0, 5);

        // 6. Chuyển mảng trở lại thành chuỗi JSON
        $json_data = json_encode($recent_lessons);

        // 7. Tạo một đối tượng Cookie mới (sử dụng global helper 'cookie')
        // Tham số: Tên Cookie, Giá trị, Thời gian sống (phút)
        $cookie = cookie('recent_lessons', $json_data, 60 * 24 * 7);

        // trả về response kèm theo cookie
        $response = new Response(view('lesson', compact('lesson')));

        return $response->withCookie($cookie);
    }
}
