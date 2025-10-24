<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load('units');
        return view('course', compact('course'));
    }
}
