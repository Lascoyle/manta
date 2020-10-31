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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'chapters' => ['required', 'array'],
            'chapters.*.title' => 'required',
            'chapters.*.description' => 'required',
            'chapters.*.video_url' => 'required',
        ]);

        $course = Course::create($request->all());

        foreach($request->input('chapters') as $chapter)
        {
            $chapter['course_id'] = $course->id;
            Chapter::create($chapter);
        }

        return Redirect::route('dashboard')->with('success', 'Félicitations, votre formation a bien été mise en ligne.');
    }

    public function edit(int $id)
    {
        $course = Course::where('id', $id)->with('chapters')->first();
        $this->authorize('update', $course);

        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }

    public function update(Request $request)
    {
        $course = Course::where('id', $request->id)->with('chapters')->first();
        $this->authorize('update', $course);

        $course->update($request->all());
        $course->chapters()->delete();

        foreach($request->chapters as $chapter) {
            $chapter['course_id'] = $course->id;
            Chapter::create($chapter);
        }

        return Redirect::route('dashboard')->with('success', 'Félicitations, votre formation a bien été modifiée.');
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('chapterId');
        $user = auth()->user();

        $user->chapters()->toggle($id);

        return $user->chapters;
    }
}
