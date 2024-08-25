<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
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
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'course' => 'required|max:255',
            'phone' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        } else {

            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
    
            if($student) {
                return response()->json([
                    'message' => 'Student created successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong'
                ], 500);
            }
    
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $student = Student::find($id);
        if($student) {
            return response()->json([
                'student' => $student,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'course' => 'required|max:255',
            'phone' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        } else {
            $student = Student::find($id);
    
            if($student) {
                $student->name = $request->input('name');
                $student->course = $request->input('course');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');
                $student->save();

                return response()->json([
                    'message' => 'Student created successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Something went wrong'
                ], 404);
            }
    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::find($id);
        if($student) {
            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
    }
}
