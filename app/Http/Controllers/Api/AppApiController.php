<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppApiController extends Controller
{
    public function addStudent(Request $req) {
        $validator = Validator::make($req->all(), [
            'name'    => 'required',
            'subject' => 'required',
            'marks'   => 'required',
        ]);
    
        if ($validator->fails()) {
            $response = [
                'message' => 'Validation Failed.',
                'errors'  => $validator->errors(),
                'status'  => 0
            ];
            $responseCode = 422;
        } else {
            $added_student = Student::where('name', $req['name'])->where('subject', $req['subject'])->first();
            if($added_student) {
                $added_student->marks = $req['marks'];
                $added_student->save();

                $response = [
                    'message' => 'Student with this name & subject combination updated successfully.',
                    'student' => $added_student,
                    'status'  => 1
                ];
                $responseCode = 200;
            } else {
                DB::beginTransaction();
                try {
                    $data = [
                        'name'    => $req['name'],
                        'subject' => $req['subject'],
                        'marks'   => $req['marks'],
                    ];
                    $student = Student::create($data);
                    DB::commit();
    
                    $response = [
                        'message' => 'Student added successfully.',
                        'student' => $student,
                        'status'  => 1
                    ];
                    $responseCode = 200;
                } catch (\Exception $error) {
                    DB::rollBack();
    
                    $response = [
                        'message' => 'Failed to add student. Please try again.',
                        'status'  => 0
                    ];
                    $responseCode = 500;
                }
            }
        }
        return response()->json($response,$responseCode);
    }

    public function updateStudent(Request $req) {
        if($req['id']) {
            $student = Student::find($req['id']);
            if(! is_null($student)) {
                try {
                    $student->name    = $req['name'];
                    $student->subject = $req['subject'];
                    $student->marks   = $req['marks'];
                    $student->save();

                    $response = [
                        'message' => 'Student Updated Successfully.',
                        'student' => $student,
                        'status'  => 1
                    ];
                    $responseCode = 200;
                } catch (\Exception $error) {
                    $response = [
                        'message' => $error->getMessage(),
                        'status'  => 0
                    ];
                    $responseCode = 500;
                }
            }
        } else {
            $response = [
                'message' => 'Student Id Missing.',
                'status'  => 0
            ];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    public function deleteStudent(Request $req) {
        if($req['id']) {
            $student = Student::where('id', $req['id']);
            if(! is_null($student)) {
                $student->forceDelete();

                $response = [
                    'message' => 'Student Deleted Successfully.',
                    'status'  => 1
                ];
                $responseCode = 200;
            } else {
                $response = [
                    'message' => 'Student Not Found.',
                    'status'  => 0
                ];
                $responseCode = 500;
            }
        } else {
            $response = [
                'message' => 'Student Id Missing.',
                'status'  => 0
            ];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode); 
    }
}
