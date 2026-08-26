<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return Inertia::render('/Students',[
        'students'=>Student::all(),
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validate = $request ->validate([
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'birthday'=> 'required|date|before:today',
        'email' => 'required|email|unique:students:email',
        'program' => 'required|string|max:60',
        'gender' => 'required|string|max:60',
        'year_level' => 'required|integer|min:1|max:4'
    ]);
    $student =Student::Create($validated);
    return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $student = Student :: findOrFail($id);
    return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student :: findOrFail($id);
        $validated = $request->validate([
         'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'birthday'=> 'required|date|before:today',
        'email' => 'required|email|unique:students:email'.$student->id,
        'program' => 'required|string|max:60',
        'gender' => 'required|string|max:60',
        'year_level' => 'required|integer|min:1|max:4'
        ]);
        $student->update($validated);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
     $student = Student :: findOrFail($id);
     $student->delete();
     return response()->json([
        'message'=>'Student successfully removed'
     ]);
    }
}
