<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Chapter;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

    public function store(Request $request)
    {
        Course::create($request->all());

        return Redirect::route('dashboard')->with('success', 'Félicitations, la formation a bien été mise en ligne.');
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('chapterId');
        $user = auth()->user();

        $user->chapters()->toggle($id);

        return $user->chapters;
    }
}
