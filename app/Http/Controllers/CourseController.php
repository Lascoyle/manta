<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;

use Inertia\Inertia;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')->withCount('chapters')->get();

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function show(int $id)
    {
        $course = Course::where('id', $id)->with('chapters')->first();

        return Inertia::render('Courses/Show', [
            'course' => $course
        ]);
    }
}
