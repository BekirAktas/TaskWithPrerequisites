<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;


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

Route::post('/create-task', [SystemController::class, 'create']);
Route::post('/add-prerequisite/{taskId}', [SystemController::class, 'addPrerequisite']);
Route::get('/get-all-tasks', [SystemController::class, 'getAllTasks']);
Route::get('/order-tasks', [SystemController::class, 'orderTasks']);

