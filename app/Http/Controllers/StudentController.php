<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateStudentRequest;
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
        return Inertia::render('Students/Index', compact('students'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return Inertia::render('Students/Create', compact('courses'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateStudentRequest $request)
    {
        // Create a new Student object and assign the values ​​provided in the request
        $student = Student::create($request->only(['name', 'last_name', 'age', 'email']));

        // Assign the selected courses to the newly created student
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
    public function edit(Student $student)
    {
        $student->load('courses');
        $courses = Course::all();
        return Inertia::render('Students/Edit', compact('student', 'courses'));
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

        $student->update($request->only(['name', 'last_name', 'age', 'email']));

        // Assign the selected courses to the newly updated student
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
