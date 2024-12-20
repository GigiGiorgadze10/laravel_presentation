<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GitHubController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/github', [GitHubController::class, 'redirectToProvider'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'handleProviderCallback']);
Route::post('logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
Route::get('home', function () {
    return view('home');
})->middleware('auth');

