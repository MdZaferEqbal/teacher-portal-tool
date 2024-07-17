<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Api\AppApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/update-user', [AppApiController::class, 'updateUser'])->name('update.user');

Route::post('/add-student', [AppApiController::class, 'addStudent'])->name('add.student');

Route::get('/update-student', [AppApiController::class, 'updateStudent'])->name('update.student');

Route::get('/delete-student', [AppApiController::class, 'deleteStudent'])->name('delete.student');
