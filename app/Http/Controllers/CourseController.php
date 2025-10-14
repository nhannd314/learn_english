<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($id)
    {
        $course = Course::with('units')->findOrFail($id);
        return view('course', compact('course'));
    }
}
