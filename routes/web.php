<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

Route::get('/', [AppController::class, 'home'])->name('home');

Route::match(['get', 'post'], '/login', [AppController::class, 'logIn'])->name('login');

Route::match(['get', 'post'], '/signUp', [AppController::class, 'signUp'])->name('signup');

Route::get('/log-out', [AppController::class, 'logout'])->name('logout');

Route::get('/students', [AppController::class, 'studentsView'])->name('students.view');
Route::get('/add-student', [AppController::class, 'addStudentView'])->name('add.student');
