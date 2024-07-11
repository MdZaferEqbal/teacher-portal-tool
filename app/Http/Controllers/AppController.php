<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function home() {
        return view('home');
    }

    public function logIn(Request $req) {
        if(Auth::check()) {
            return redirect()->back();
        }

        if($req->isMethod('post')) {
            $req->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);
    
            $user = User::where('email', $req['email'])->first();
            if($user) {
                $auth_creds = $req->only(['email', 'password']);
                if(Auth::attempt($auth_creds)) {
                    return redirect('/students');
                } else {
                    return redirect('/login')->with('error', 'Email & Password Missmatch.');
                }
            } else {
                $error = "User doesn’t exists. <a href='" . url('/signUp') . "' class='text-info text-decoration-none'>Sign Up</a>";
                return redirect('/login')->with('error', $error);
            }
        }
        return view('login');
    }

    public function signUp(Request $req) {
        if($req->isMethod('post')) {
            $req->validate([
                'name'     => 'required',
                'email'    => 'required|email',
                'password' => 'required',
            ]);
    
            $data = [
                'name'     => $req['name'],
                'email'    => $req['email'],
                'password' => Hash::make($req['password'])
            ];

            if(User::where('email', $req['email'])->first()) {
                $error = "User already exists. <a href='" . url('/login') . "' class='text-info text-decoration-none'>Log In</a>";
                return redirect('/signUp')->with('error', $error);
            } else {
                DB::beginTransaction();
                try {
                    $user = User::create($data);
                    DB::commit();

                    $auth_creds = $req->only(['email', 'password']);
                    if(Auth::attempt($auth_creds)) {
                        return redirect('/students');
                    } else {
                        return redirect('/')->with('error', 'Sign Up Failed. Please try again.');
                    }
                } catch (\Exception $error) {
                    DB::rollBack();
                    return redirect('/signUp')->with('error', 'Sign Up Failed. Please try again.');
                }
            }
        }
        return view('sign-up');
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        Auth::logout();

        return redirect('/');
    }

    public function studentsView(Request $req){
        $students = array();
        if(isset( $req['search_input'])) {
            $search_input = $req['search_input'];
            switch($req['search_by']) {
                case "id":
                    $students = Student::where('id', 'LIKE', "%$search_input%")->orderBy('id', 'desc')->paginate(5);
                    $searched = TRUE;
                    break;
                case "name":
                    $students = Student::where('name', 'LIKE', "%$search_input%")->orderBy('id', 'desc')->paginate(5);
                    $searched = TRUE;
                    break;
                case "subject":
                    $students = Student::where('subject', 'LIKE', "%$search_input%")->orderBy('id', 'desc')->paginate(5);
                    $searched = TRUE;
                    break;
                case "marks":
                    $students = Student::where('marks', 'LIKE', "%$search_input%")->orderBy('id', 'desc')->paginate(5);
                    $searched = TRUE;
                    break;
                default:
                    $students = Student::where('id', 'LIKE', "%$search_input%")->orwhere('name', 'LIKE', "%$search_input%")->orwhere('subject', 'LIKE', "%$search_input%")->orwhere('marks', 'LIKE', "%$search_input%")->orderBy('id', 'desc')->paginate(5);
                    $searched = TRUE;
            }
        } else {
            $students = Student::orderBy('id', 'desc')->paginate(5);
            $searched = FALSE;
        }
        $data = compact('students', 'searched');

        return view('students')->with($data);
    }
}
