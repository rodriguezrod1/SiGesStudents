<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCouseRequest;
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
         // Set the date six months before now.
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // Get the top three courses with the highest number of students in the last six months.
        $top = Course::withCount('students')
            ->whereHas('students', function ($query) use ($sixMonthsAgo) {
                $query->where('courses.created_at', '>', $sixMonthsAgo);
            })
            ->orderByDesc('students_count')
            ->take(3)
            ->get();

         // Get all courses that have only one student and their student counts.
        $courses_one = Course::has('students', '=', 1)->withCount('students')->get();

        // Get all courses and their student counts.
        $courses = Course::withCount('students')->get();

        // Render the inertia view with the course information.
        return Inertia::render('Courses/Index', compact('courses', 'top', 'courses_one'));
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
     * @param  \Illuminate\Http\StoreUpdateCouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCouseRequest $request)
    {
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
        return Inertia::render('Courses/Edit', compact('course'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateCouseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCouseRequest $request, Course $course)
    {
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
