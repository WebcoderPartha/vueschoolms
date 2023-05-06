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
use App\Http\Controllers\Api\ManageStudent\RegisterStudentController;
use App\Http\Controllers\Api\ManageStudent\RollGenerateController;
use App\Http\Controllers\Api\ManageStudent\FeePayController;




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
    Route::get('/monthlyfee/{year}/{month}', [MonthlyFeeController::class, 'showByYearMonth']);
    Route::put('/monthlyfee/{year}/{month}', [MonthlyFeeController::class, 'updateByYearMonth']);
    Route::delete('/monthlyfee/{year}/{month}', [MonthlyFeeController::class, 'deleteByYearMonth']);
    Route::post('/monthlyfee/alldel', [MonthlyFeeController::class, 'allDelete']);


    // Exam Fee APIs
    Route::apiResource('examfee', ExamFeeController::class);
    Route::get('/examfee/{year}/{exam}', [ExamFeeController::class, 'ExamFeeShowByYear']);
    Route::put('/examfee/{year}/{exam}', [ExamFeeController::class, 'updateByYearExam']);
    Route::delete('/examfee/{year}/{exam}', [ExamFeeController::class, 'deleteByYearExam']);
    Route::post('/examfee/alldel', [ExamFeeController::class, 'allSelectedDelete']);


    // Student APIs
    Route::apiResource('student', RegisterStudentController::class);
    Route::post('/student/alldel', [RegisterStudentController::class, 'allDelete']);

    // RollGenerate
    Route::get('/searchrolgen/{year}/{class}', [RollGenerateController::class, 'SearchYearClassRollGenStudent']);
    Route::put('/rollgenupdate', [RollGenerateController::class, 'updateRollGenerate']);

    // Registration Fee Pay
    Route::post('/regifeepay', [FeePayController::class, 'SearchRegistrationFeePayStudent']);
    Route::get('/regifeepay/{year}/{class}/{student}', [FeePayController::class, 'getRegistrationPaySlipByID']);

    // Monthly Fee Pay
    Route::post('/monthlyfeepay', [FeePayController::class, 'SearchMonthlyFeePayStudent']);
    Route::get('/monthlyfeepay/{year}/{month}/{class}/{student}', [FeePayController::class, 'getMonthlyPaySlipByID']);

    // Monthly Fee Pay
    Route::post('/examfeepay', [FeePayController::class, 'SearchExamFeePayStudent']);
    Route::get('/examfeepay/{year}/{exam}/{class}/{student}', [FeePayController::class, 'getExamPaySlipByID']);


});