<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // I used api resources for laravel automaticly generate restful routes like get , post , put  , delete
    Route::apiResource('projects', ProjectController::class);

    // Using ->shallow() in nested routes helps simplify URLs for certain actions by excluding the parent resource’s ID in the URL.
    Route::apiResource('projects.tasks', TaskController::class)->shallow();
});

