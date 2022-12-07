<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/welcome', function () {
    return 'Welcome to my tasks app';
});

Route::put('/tasks/{id}', function ($id) {
    return 'update task: '.$id;
});

Route::post('/tasks',  [TaskController::class, 'createTask']);

Route::delete('/tasks/{id}', function ($id) {
    return 'delete task: '. $id;
});

Route::get('/tasks', [TaskController::class, 'getTasks'] );

Route::get('/tasks/{id}', function ($id) {
    return 'get tasks: '. $id;
});
