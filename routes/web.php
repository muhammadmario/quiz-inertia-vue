<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;


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

Route::get('/', function () {
    $users = ['1', '2', '3'];
    return Inertia::render('Home', ['users' => $users]);
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/questions', [QuestionController::class, 'index']);
Route::post('/questions', [QuestionController::class, 'store']);


Route::put('/answer', [AnswerController::class, 'update']);
