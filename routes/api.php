<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
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

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('/logout',[ToDoController::class,'logout']);
    Route::get('/todolist',[ToDoController::class,'list']);
    Route::post('/createtodo',[ToDoController::class,'createtodo']);
    Route::put('/updatetodo/{id}',[ToDoController::class,'updatetodo']);
    Route::delete('/delete/{id}',[ToDoController::class,'delete']);
});
Route::post('/createuser',[ToDoController::class,'createuser']);
Route::post('/loginuser',[ToDoController::class,'login']);

