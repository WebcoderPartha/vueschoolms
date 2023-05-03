<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Setup\ClassController;
use App\Http\Controllers\Api\Setup\YearController;
use App\Http\Controllers\Api\Setup\GroupController;
use App\Http\Controllers\Api\Setup\ShiftController;
use App\Http\Controllers\Api\Setup\ExamTypeController;
use App\Http\Controllers\Api\Setup\SubjectController;
use App\Http\Controllers\Api\Setup\AssignSubjectController;
use App\Http\Controllers\Api\ManageFee\RegistrationFeeController;
use App\Http\Controllers\Api\ManageFee\ExamFeeController;
use App\Http\Controllers\Api\ManageFee\MonthlyFeeController;
use App\Http\Controllers\Api\MonthController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->controller(AuthController::class)->group(function(){

    Route::post('/register', 'Register');
    Route::post('/login', 'Login');
    Route::get('/me', 'Me');
    Route::get('/logout', 'Logout');

});

Route::middleware('jwtAuth')->group(function (){

    // Class APIs
    Route::apiResource('class', ClassController::class);
    Route::post('/class/alldel', [ClassController::class, 'allDelete']);

    // Class APIs
    Route::apiResource('year', YearController::class);
    Route::post('/year/alldel', [YearController::class, 'allDelete']);

    // Group APIs
    Route::apiResource('group', GroupController::class);
    Route::post('/group/alldel', [GroupController::class, 'allDelete']);

    // Shift APIs
    Route::apiResource('shift', ShiftController::class);
    Route::post('/shift/alldel', [ShiftController::class, 'allDelete']);

    // Exam Type APIs
    Route::apiResource('examtype', ExamTypeController::class);
    Route::post('/examtype/alldel', [ExamTypeController::class, 'allDelete']);

    // Subject Type APIs
    Route::apiResource('subject', SubjectController::class);
    Route::post('/subject/alldel', [SubjectController::class, 'allDelete']);

    // Assign Subject APIs
    Route::apiResource('assignsubject', AssignSubjectController::class);
    Route::post('/assignsubject/alldel', [AssignSubjectController::class, 'allDelete']);

    // Registration Fee APIs
    Route::apiResource('regifee', RegistrationFeeController::class);
    Route::post('/regifee/alldel', [RegistrationFeeController::class, 'allDelete']);

    // Monthly Fee APIs
    Route::apiResource('month', MonthController::class);

    // Monthly Fee APIs
    Route::apiResource('monthlyfee', MonthlyFeeController::class);
    Route::get('monthlyfee/{year}/{class}', [MonthlyFeeController::class, 'showByYearMonth']);
    Route::put('monthlyfee/{year}/{class}', [MonthlyFeeController::class, 'updateByYearMonth']);
    Route::delete('monthlyfee/{year}/{class}', [MonthlyFeeController::class, 'deleteByYearMonth']);
    Route::post('/monthlyfee/alldel', [MonthlyFeeController::class, 'allDelete']);



});