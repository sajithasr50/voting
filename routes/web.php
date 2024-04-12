<?php

use App\Models\Candidate;
use App\Models\VoteCandidate;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('candidate/', [CandidateController::class, 'index'])->name('candidate.index');
        Route::get('candidate/create', [CandidateController::class, 'create'])->name('candidate.create');
        Route::post('candidate/store', [CandidateController::class, 'store'])->name('candidate.store');
        Route::post('vote/votecandidate', [VoteController::class, 'votecandidate'])->name('votecandidate');
        Route::get('vote/candidatedetails', [VoteController::class, 'candidatedetails'])->name('vote.candidatedetails');
        Route::get('vote/userdetails/{id}', [VoteController::class, 'userdetails'])->name('vote.userdetails');
        Route::get('candidate/delete/{id}', [CandidateController::class, 'delete'])->name('candidate.delete');
        Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
    });
});
