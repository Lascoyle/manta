<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }
}
