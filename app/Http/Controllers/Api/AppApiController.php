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
    /**
     * Add a student record or update marks with same name & subject combination of a student record.
     *
     * This method accepts student name, subject, and marks, validates the input,
     * and either updates an existing record with same name & subject combination or adds a new one. 
     * It returns an appropriate response based on the operation performed.
     *
     * @param Request $request The HTTP request containing student data.
     * 
     * @return JSON response with the operation result.
     *
     * @api {post} /api/addStudent Add or update a student
     * @apiName AddStudent
     * @apiGroup Student
     * @apiParam {String} name The name of the student.
     * @apiParam {String} subject The subject the student is enrolled in.
     * @apiParam {Integer} marks The marks obtained by the student.
     * @apiSuccess {Boolean} success Indicates if the operation was successful.
     * @apiSuccess {String} message A message describing the result.
     * @apiError {String} message A message describing the error.
     * @apiError {Object} errors The validation errors.
    */
    public function addStudent(Request $req) {
        $validator = Validator::make($req->all(), [
            'name'    => 'required',
            'subject' => 'required',
            'marks'   => 'required|numeric|min:0|max:100',
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
                        'message' => 'Student Data added successfully.',
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
                        'message' => 'Student Data Updated Successfully.',
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
                    'message' => 'Student Data Deleted Successfully.',
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
