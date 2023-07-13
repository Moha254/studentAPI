<?php

namespace App\Http\Controllers\Api;

use App\Models\students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Requests\StudentStoreRequest;

class StudentController extends Controller
{
    public function index()
    {
        $students = students::all();

        if ($students->count() > 0) {

            return response()->json([
                'status' => 200,
                'students' => $students,
            ], 200);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'No record found',
            ], 404);
        }
    }
    public function store(StudentStoreRequest $request)
    {
        $request->Validated($request->all());

        $student = students::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        if ($student) {
            return response()->json([
                'status' => 200,
                'message' => 'Student created succesfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Error when creating the student',
            ], 500);
        }
    }
    public function show($id)
    {
        $student = students::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' =>  $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found',
            ], 404);
        }
    }
    public function edit($id)
    {
        $student = students::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' =>  $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found',
            ], 404);
        }
    }
    public function update(UpdateStoreRequest $request, int $id)
    {
        $request->validated($request->all());

        $student = students::find($id);
        if ($student) {
            $student->update([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'student Updated succesfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found',
            ], 404);
        }
    }
    public function destroy($id)
    {
        $student = students::find($id);

        if ($student) {
            $student->delete();

            return response()->json([
                'status' => 200,
                'message' => 'student deleted succesfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'no such student found',
            ], 404);
        }
    }
}
