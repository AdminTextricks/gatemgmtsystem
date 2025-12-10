<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeeDetailsController;
use App\Http\Controllers\ForgotMailController;
use App\Http\Controllers\RecordBookController;
use App\Http\Controllers\LeaveModuleController;
use App\Http\Controllers\FamilyMembersController;
use App\Http\Controllers\Admin\CityMatserController;
use App\Http\Controllers\Admin\ClassMasterController;
use App\Http\Controllers\Admin\StateMatserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\TeacherMasterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\EquipmentMasterController;
use App\Http\Controllers\Admin\TherapistMasterController;
use App\Http\Controllers\Admin\DisabilityMatserController;
use App\Http\Controllers\Admin\OccupationMasterController;
use App\Http\Controllers\Admin\UpdateStudentFLYController;
use App\Http\Controllers\CustomNotificationController;
use App\Http\Controllers\Student\ProgressReportController;
use App\Http\Controllers\Student\StudentAdmissionController;
use App\Http\Controllers\Student\AcademicReportController;
use App\Http\Controllers\StudentVideosController;
use App\Http\Controllers\DomainDetailsController;
use App\Http\Controllers\DomainMasterController;
use App\Http\Controllers\TestMailContoller;
use App\Http\Controllers\TimeTableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	if (Auth::check()) {
		return redirect('/dashboard');
	}
	return view('welcome');
});

//Start Forget Password
Route::post('/forgot-send', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.send');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
//End Forget Password

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/student_details/{id}', [StudentAdmissionController::class, 'getStudentDetails'])->name('getStudentDetails')->middleware('guest');

// Dashboard Route (After Login)
Route::group(['dashboard', 'middleware' => 'auth'], function () {

	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::group(['prefix' => 'classlist'], function () {
		Route::get('/', [ClassMasterController::class, 'index'])->name('classlist');
		Route::get('/{action}/{id?}', [ClassMasterController::class, 'classmaster_action'])->name('classmaster_action');
		Route::post('/post', [ClassMasterController::class, 'classmaster_post_action'])->name('classmaster.action');
		Route::delete('/delete/{id}', [ClassMasterController::class, 'delete'])->name('classmaster.delete');
	});

	Route::group(['prefix' => 'timetalblelist'], function () {
		Route::get('/', [TimeTableController::class, 'index'])->name('timetablelist');
		Route::get('/{action}/{id?}', [TimeTableController::class, 'timetable_action'])->name('timetable_action');
		Route::post('/post', [TimeTableController::class, 'timetable_post_action'])->name('timetable.action');
		Route::delete('/delete/{id}', [TimeTableController::class, 'delete'])->name('timetable.delete');
	});
	Route::group(['prefix' => 'disabilitylist'], function () {
		Route::get('/', [DisabilityMatserController::class, 'index'])->name('disabilitylist');
		Route::get('/{action}/{id?}', [DisabilityMatserController::class, 'disability_action'])->name('disability_action');
		Route::post('/post', [DisabilityMatserController::class, 'disability_post_action'])->name('disability.action');
		Route::delete('/delete/{id}', [DisabilityMatserController::class, 'delete'])->name('disability.delete');
	});

	Route::group(['prefix' => 'teacherlist'], function () {
		Route::get('/', [TeacherMasterController::class, 'index'])->name('teacherlist');
		Route::post('updatestatus/{id?}', [TeacherMasterController::class, 'updatestatus']);
		Route::get('/{action}/{id?}', [TeacherMasterController::class, 'teacher_action'])->name('teacher_action');
		Route::post('/post/{action?}', [TeacherMasterController::class, 'teacher_post_action'])->name('teacher.action');
		Route::delete('/delete/{id}', [TeacherMasterController::class, 'delete'])->name('teacher.delete');
	});

	Route::group(['prefix' => 'userlist'], function () {
		Route::get('/', [UserController::class, 'index'])->name('userlist');
		Route::get('/login_activity', [UserController::class, 'login_activity'])->name('login.activities');
		Route::post('updatestatus/{id?}', [UserController::class, 'updatestatus']);
		Route::get('/{action}/{id?}', [UserController::class, 'user_action'])->name('user_action');
		Route::post('/post/{action?}', [UserController::class, 'user_post_action'])->name('user.action');
		Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
	});


	Route::group(['prefix' => 'citylist'], function () {
		Route::get('/', [CityMatserController::class, 'index'])->name('citylist');
		Route::get('/{action}/{id?}', [CityMatserController::class, 'city_action'])->name('city_action');
		Route::post('/post', [CityMatserController::class, 'city_post_action'])->name('city.action');
		Route::delete('/delete/{id}', [CityMatserController::class, 'delete'])->name('city.delete');
	});

	Route::group(['prefix' => 'statelist'], function () {
		Route::get('/', [StateMatserController::class, 'index'])->name('statelist');
		Route::get('/{action}/{id?}', [StateMatserController::class, 'state_action'])->name('state_action');
		Route::post('/post', [StateMatserController::class, 'state_post_action'])->name('state.action');
		Route::delete('/delete/{id}', [StateMatserController::class, 'delete'])->name('state.delete');
	});

	Route::group(['prefix' => 'therapistlist'], function () {
		Route::get('/', [TherapistMasterController::class, 'index'])->name('therapistlist');
		Route::get('/{action}/{id?}', [TherapistMasterController::class, 'therapist_action'])->name('therapist_action');
		Route::post('/post', [TherapistMasterController::class, 'therapist_post_action'])->name('therapist.action');
		Route::delete('/delete/{id}', [TherapistMasterController::class, 'delete'])->name('therapist.delete');
	});

	Route::group(['prefix' => 'occupationlist'], function () {
		Route::get('/', [OccupationMasterController::class, 'index'])->name('occupationlist');
		Route::get('/{action}/{id?}', [OccupationMasterController::class, 'occupation_action'])->name('occupation_action');
		Route::post('/post', [OccupationMasterController::class, 'occupation_post_action'])->name('occupation.action');
		Route::delete('/delete/{id}', [OccupationMasterController::class, 'delete'])->name('occupation.delete');
	});

	Route::group(['prefix' => 'equipmentlist'], function () {
		Route::get('/', [EquipmentMasterController::class, 'index'])->name('equipmentlist');
		Route::get('/{action}/{id?}', [EquipmentMasterController::class, 'equipment_action'])->name('equipment_action');
		Route::post('/post', [EquipmentMasterController::class, 'equipment_post_action'])->name('equipment.action');
		Route::delete('/delete/{id}', [EquipmentMasterController::class, 'delete'])->name('equipment.delete');
	});

	Route::group(['prefix' => 'studentlist'], function () {
		Route::get('/', [StudentAdmissionController::class, 'index'])->name('studentlist');
		Route::get('/studentdetailsbyid/{id?}', [StudentAdmissionController::class, 'student_details_by_id'])->name('studentdetailsbyid');
		Route::get('/get_studentby_id/{id?}', [StudentAdmissionController::class, 'student_by_id'])->name('studentby_id');
		Route::get('/studentbytype/{id_type?}/{id?}', [StudentAdmissionController::class, 'index']);
		Route::get('/get-cities/{id?}', [StudentAdmissionController::class, 'get_cities']);
		Route::get('/get-domain-therapy/{id?}/{class?}', [StudentAdmissionController::class, 'get_domains_therapies'])->name('get_domains_therapies');
		Route::get('/{action}/{id?}', [StudentAdmissionController::class, 'student_action'])->name('student_action');
		Route::post('/post', [StudentAdmissionController::class, 'student_post_action'])->name('student.action');

		Route::delete('/delete/{id}', [StudentAdmissionController::class, 'delete'])->name('student.delete');
	});

	Route::group(['prefix' => 'studentdocuments'], function () {

		Route::get('/{action}/{student_id?}', [StudentAdmissionController::class, 'student_documents'])->name('student_documents');
		Route::post('/post', [StudentAdmissionController::class, 'student_post_documents'])->name('student.documents');
		Route::delete('/delete/{column?}/{id?}', [StudentAdmissionController::class, 'delete_document'])->name('delete.document');
	});

	Route::group(['prefix' => 'studentregister'], function () {
		Route::get('/', [StudentAdmissionController::class, 'student_filter'])->name('studentregister');
		Route::post('/studentregister/fetch', [StudentAdmissionController::class, 'fetchStudents'])->name('studentregister.fetch');
	});

	Route::group(['prefix' => 'studentfamily'], function () {
		Route::get('/{action}/{student_id?}', [FamilyMembersController::class, 'student_family'])->name('student_family');
		// Route::post('/get-family-member', [FamilyMembersController::class, 'member_by_id'])->name('get-family-member');
		Route::post('/post', [FamilyMembersController::class, 'student_post_family'])->name('student.family');
	});

	Route::group(['prefix' => 'studentFLY'], function () {
		Route::get('/', [UpdateStudentFLYController::class, 'studentfly_action'])->name('studentFLY');
		Route::get('/getstudentbyid/{id?}', [UpdateStudentFLYController::class, 'getStudentById'])->name('getStudentById');
		Route::post('/post', [UpdateStudentFLYController::class, 'studentfly_post_action'])->name('studentfly.action');
	});


	Route::group(['prefix' => 'archivedstudents'], function () {
		Route::get('/', [StudentAdmissionController::class, 'archivedstudents'])->name('archivedstudents');
	});

	Route::group(['prefix' => 'leavelist'], function () {
		Route::get('/', [LeaveModuleController::class, 'index'])->name('leavelist');
		Route::get('/{action}/{id?}', [LeaveModuleController::class, 'leave_action'])->name('leave_action');
		Route::post('/post/{action?}', [LeaveModuleController::class, 'leave_post_action'])->name('leave.action');
		Route::delete('/delete/{id}', [LeaveModuleController::class, 'delete'])->name('leave.delete');
		// Route::post('updatestatus/{id?}', [UserController::class, 'updateleavestatus']);
		Route::post('/updatestatus/{id?}', [LeaveModuleController::class, 'update_leave_status'])->name('updateleavestatus');
	});

	Route::group(['prefix' => 'feedetails'], function () {
		Route::post('/post', [FeeDetailsController::class, 'fee_post_action'])->name('fee.action');
		Route::get('/', [FeeDetailsController::class, 'pendingfee'])->name('pendingfeelist');
		Route::get('/{action}/{id?}', [FeeDetailsController::class, 'fee_action'])->name('fee_form');
		Route::post('/feestatus', [FeeDetailsController::class, 'update_fee_status'])->name('updatefeestatus');
		Route::delete('/delete/{id}', [FeeDetailsController::class, 'delete'])->name('fee.delete');
	});

	Route::group(['prefix' => 'studentreports'], function () {
		Route::get('/studentreportlist/{id?}', [ProgressReportController::class, 'studentlist_progressreport'])->name('progressreport_list');
		Route::get('/{action}/{id?}', [ProgressReportController::class, 'progressreport_action'])->name('progressreport_form');
		Route::post('/post/{action?}', [ProgressReportController::class, 'progressreport_action_post'])->name('progressreport.action');
	});

	Route::group(['prefix' => 'academicreport'], function () {
		Route::get('/academicreportlist/{id?}', [AcademicReportController::class, 'studentlist_academicreport'])->name('academicreport_list');
		Route::get('/{action}/{id?}', [AcademicReportController::class, 'academicreport_action'])->name('academicreport_form');
		Route::post('/post/{action?}', [AcademicReportController::class, 'academicreport_action_post'])->name('academicreport.action');
	});

	Route::group(['prefix' => 'recordbook'], function () {
		Route::get('/generate/{id?}', [RecordBookController::class, 'generate_recordBook'])->name('generate.recordbook');
	});

	Route::group(['prefix' => 'studentvideo'], function () {
		Route::get('/', [StudentVideosController::class, 'therapyvideo_list'])->name('therapyvideo.list');
		Route::get('/videogallary', [StudentVideosController::class, 'therapyvideo_gallary'])->name('childvideo.gallary');
		Route::get('/{action}/{id?}', [StudentVideosController::class, 'therapyvideo_action'])->name('therapyvideo.action');
		Route::post('/post/{action?}', [StudentVideosController::class, 'therapyvideo_action_post'])->name('therapyvideo_post.action');
		Route::delete('/delete/{id}', [StudentVideosController::class, 'delete'])->name('video.delete');
	});


	Route::group(['prefix' => 'notification'], function () {
		Route::get('/', [CustomNotificationController::class, 'index'])->name('notificationlist');

		Route::get('/create', [CustomNotificationController::class, 'create'])->name('notification.create');
		Route::post('/store', [CustomNotificationController::class, 'store'])->name('notification.store');
		Route::post('/post/{action?}', [CustomNotificationController::class, 'notification_action_post'])->name('notification_post.action');
		Route::post('/email/resend/{id?}', [CustomNotificationController::class, 'resendFailed'])->name('email.resend');
		Route::delete('/delete/{id}', [CustomNotificationController::class, 'delete'])->name('notification.delete');
	});

	Route::group(['prefix' => 'domain'], function () {
		Route::get('/motor', [DomainDetailsController::class, 'motorCodeList'])->name('motorCode.list');
		Route::get('/personal', [DomainDetailsController::class, 'personalCodeList'])->name('personalCode.list');
		Route::get('/social', [DomainDetailsController::class, 'socialCodeList'])->name('socialCode.list');
		Route::get('/language', [DomainDetailsController::class, 'languageCodeList'])->name('languageCode.list');
		Route::get('/numberTimeMoneyMeasurement', [DomainDetailsController::class, 'numberTimeMoneyMeasurementCodeList'])->name('numberTimeMoneyMeasurementCode.list');
		Route::get('/environmentalScience', [DomainDetailsController::class, 'environmentalScienceCodeList'])->name('environmentalScienceCode.list');
		Route::get('/occupationalVocational', [DomainDetailsController::class, 'occupationalVocationalCodeList'])->name('occupationalVocationalCode.list');
		Route::get('/coCurricular', [DomainDetailsController::class, 'coCurricularCodeList'])->name('coCurricularCode.list');
		Route::get('/parentalInvolvementPlan', [DomainDetailsController::class, 'parentalInvolvementPlanCodeList'])->name('parentalInvolvementPlanCode.list');
	});
});
