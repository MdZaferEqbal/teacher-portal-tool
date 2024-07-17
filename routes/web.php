<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Middleware\EnsureUserLoggedIn;

Route::get('/', [AppController::class, 'home'])->name('home');

Route::get('/unauthroized', function() {
    if(! Auth::check()) {
        return view('unauthroized-page');
    }
    return redirect()->back();
})->name('unauthroized.page');

Route::match(['get', 'post'], '/login', [AppController::class, 'logIn'])->name('login');

Route::match(['get', 'post'], '/signUp', [AppController::class, 'signUp'])->name('signup');

Route::get('/log-out', [AppController::class, 'logout'])->name('logout');

Route::get('/profile', [AppController::class, 'profileView'])->name('profile.view')->middleware(EnsureUserLoggedIn::class);

Route::get('/students', [AppController::class, 'studentsView'])->name('students.view')->middleware(EnsureUserLoggedIn::class);
