<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/logout', [TaskController::class,'logout']);
//tasks routes
Route::get('getTask',[TaskController::class,'getTask']);

Route::post('updateTask/{id}',[TaskController::class,'updateTask']);

Route::post('getTaskDataToUpdate/{id}',[TaskController::class,'getTaskDataToUpdate']);

Route::post('removeTask/{id}',[TaskController::class,'removeTask']);

Route::post('storeTask',[TaskController::class,'storeTask']);

//Sub Tasks Routes
Route::post('getSubTasksData/{id}',[TaskController::class,'getSubTasksData']);

Route::post('storeSubTask',[TaskController::class,'storeSubTask']);

Route::post('updateSubTask/{id}',[TaskController::class,'updateSubTask']);

Route::post('deleteSubTask/{id}',[TaskController::class,'deleteSubTask']);

Route::post('markSubTaskAsComplate/{id}',[TaskController::class,'markSubTaskAsComplate']);

Route::post('markSubTaskAsInComplate/{id}',[TaskController::class,'markSubTaskAsInComplate']);
