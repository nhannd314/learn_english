<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        // lay du lieu bai hoc da xem gan day
        $cookieData = Cookie::get('recent_lessons');
        // var_dump($cookieData);
        $recentLessonsIds = $cookieData ? json_decode($cookieData, true) : [];

        $recent_lessons = collect();
        if (!empty ($recentLessonsIds)) {
            // Đảm bảo các ID là số nguyên (đặc biệt khi đọc từ Cookie)
            $recentLessonsIds = array_map('intval', $recentLessonsIds);
            $recent_lessons = Lesson::whereIn('id', $recentLessonsIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $recentLessonsIds) . ')')
                ->get();
        }

        $courses = Course::orderBy('order')->get();
        return view('home', compact('recent_lessons', 'courses'));
    }
}
