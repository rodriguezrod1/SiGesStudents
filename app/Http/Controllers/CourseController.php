<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Inertia\Inertia;
use Carbon\Carbon;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $top = Course::withCount('students')
            ->whereHas('students', function ($query) use ($sixMonthsAgo) {
                $query->where('courses.created_at', '>', $sixMonthsAgo);
            })
            ->orderByDesc('students_count')
            ->take(3)
            ->get();

        $courses_one = Course::whereHas('students', function ($query) {
            $query->groupBy('course_id')
                ->havingRaw('COUNT(*) = 1');
        })->get();

        $courses = Course::withCount('students')->get();
        return Inertia::render('Courses/Index', [
            'courses' => $courses,
            'top' => $top,
            'one' => $courses_one
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Courses/Create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'schedule' => 'required',
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return Inertia::render('Courses/Show', [
            'course' => $course,
            'students' => $course->students->count(),
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return Inertia::render('Courses/Edit', [
            'course' => $course,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'schedule' => 'required',
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
