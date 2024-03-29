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
use App\Http\Controllers\Api\ManageMark\GradeManage\GradeController;
use App\Http\Controllers\Api\ManageMark\MarkEntry\MarkController;
use App\Http\Controllers\Api\Result\ResultController;
use App\Http\Controllers\Api\ManageEmployee\DesignationController;
use App\Http\Controllers\Api\ManageEmployee\EmployeeController;
use App\Http\Controllers\Api\ManageEmployee\EmployeeSalaryController;
use App\Http\Controllers\Api\ManageEmployee\LeaveController;
use App\Http\Controllers\Api\ManageEmployee\LeavePurposeController;
use App\Http\Controllers\Api\ManageEmployee\AttendanceController;




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

    // RollGenerate APIs
    Route::get('/searchrolgen/{year}/{class}', [RollGenerateController::class, 'SearchYearClassRollGenStudent']);
    Route::put('/rollgenupdate', [RollGenerateController::class, 'updateRollGenerate']);

    // Registration Fee Pay APIs
    Route::post('/regifeepay', [FeePayController::class, 'SearchRegistrationFeePayStudent']);
    Route::get('/regifeepay/{year}/{class}/{student}', [FeePayController::class, 'getRegistrationPaySlipByID']);

    // Monthly Fee Pay APIs
    Route::post('/monthlyfeepay', [FeePayController::class, 'SearchMonthlyFeePayStudent']);
    Route::get('/monthlyfeepay/{year}/{month}/{class}/{student}', [FeePayController::class, 'getMonthlyPaySlipByID']);

    // Monthly Fee Pay APIs
    Route::post('/examfeepay', [FeePayController::class, 'SearchExamFeePayStudent']);
    Route::get('/examfeepay/{year}/{exam}/{class}/{student}', [FeePayController::class, 'getExamPaySlipByID']);

    // Grade APIs
    Route::apiResource('grade', GradeController::class);

    // Mark Entry  APIs
    Route::post('/getmarkstudent', [MarkController::class, 'SearchMarkStudent']);
    Route::post('/markstore', [MarkController::class, 'storeMark']);

    // Results  APIs
    Route::post('/searchresult', [ResultController::class, 'SearchAcademicTranscript']);
    Route::post('/resultall', [ResultController::class, 'ResultSearch']);
    Route::get('/getmarks/{year}/{class}/{exam_type_id}/{student}', [ResultController::class, 'getStudentResult']);


    // Designation APIs
    Route::apiResource('designation', DesignationController::class);
    Route::post('/designation/alldel', [DesignationController::class, 'allDelete']);

    // Designation APIs
    Route::apiResource('employee', EmployeeController::class);
    Route::post('/employee/alldel', [EmployeeController::class, 'deleteAll']);

    // Employee Salary
    Route::post('/incmentsalary/{id}', [EmployeeSalaryController::class, 'increment']);

    // Leave APIs
    Route::apiResource('leave', LeaveController::class);
    Route::post('/leave/delall', [LeaveController::class, 'deleteAll']);

    // Leave Purpose
    Route::get('/leavepurpose', [LeavePurposeController::class, 'index']);

    // Attendance APIs
    Route::apiResource('attendance', AttendanceController::class);
    Route::post('/attendance/delall', [AttendanceController::class, 'deleteAll']);


});