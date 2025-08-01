<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (){
   return ['name' => 'VUSHW', 'Coordinator' => 'Wajahat Hashmi', 'Laravel Group Supervisor' => 'Wajahat Hashmi', 'iOS Supervisor' => 'Sheikh Haroon Irfan', 'Address' => '54-Lawrence Road, Lahore'];
});

Route::post('signup', [UserAuthController::class, 'signup']);
Route::post('login', [UserAuthController::class, 'login']);


Route::group(['middleware' => 'auth:sanctum'], function(){

    Route::get('students', [StudentController::class, 'list']);

    Route::post('add-student', [StudentController::class, 'addStudent']);

    Route::put('update-student', [StudentController::class, 'updateStudent']);

    Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);

    Route::get('search-student/{name}', [StudentController::class, 'searchStudent']);

});

Route::get('login', [UserAuthController::class, 'login'])->name('login');