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
        $watched = auth()->user()->chapters;

        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched
        ]);
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('chapterId');
        $user = auth()->user();

        $user->chapters()->toggle($id);

        return $user->chapters;
    }
}
