<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Inertia\Inertia;

class StudentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('courses')->get();
        return Inertia::render('Students/Index', [
            'students' => $students,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return Inertia::render('Students/Create', [
            'courses' => $courses
        ]);
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
            'last_name' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:students',
            'courses' => 'required',
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->save();

        $student->courses()->attach($request->courses);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return Inertia::render('Students/Show', [
            'student' => $student->load('courses'),
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        $courses = Course::all();
        return Inertia::render('Students/Edit', [
            'student' => $student,
            'courses' => $courses,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'courses' => 'required'
        ]);

        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->save();

        $student->courses()->sync($request->courses);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->courses()->detach();
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
