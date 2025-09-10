<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        /*$courses = Course::where('business_id', auth()->user()->business_id)
            ->withCount('registrations')
            ->latest()
            ->paginate(10);*/

        $courses = Course::where('business_id', auth()->user()->business_id)->latest()->paginate(10);
        dd($courses);
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,all level',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Course::create([
            'business_id' => auth()->user()->business_id,
            'title' => $request->title,
            'level' => $request->level,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('courses.index')->with('success', 'Cours ajouté avec succès.');
    }
}
