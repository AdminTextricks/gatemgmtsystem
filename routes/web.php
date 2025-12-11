<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Student\StudentAdmissionController;
use App\Http\Controllers\VisitorDetailController;

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
	return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/student_details/{id}', [StudentAdmissionController::class, 'getStudentDetails'])->name('getStudentDetails')->middleware('guest');

//Start Forget Password
Route::post('/forgot-send', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.send');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
//End Forget Password

// Dashboard Route (After Login)
Route::group(['dashboard', 'middleware' => 'auth'], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::group(['prefix' => 'memberlist'], function () {
		Route::get('/', [MemberController::class, 'index'])->name('memberlist');
		Route::get('/{action}/{id?}', [MemberController::class, 'member_action'])->name('member_action');
		Route::post('/post', [MemberController::class, 'member_post_action'])->name('member.action');
		Route::delete('/delete/{id}', [MemberController::class, 'delete'])->name('member.delete');
	});

	Route::group(['prefix' => 'visitorlist'], function () {
		Route::get('/', [VisitorDetailController::class, 'index'])->name('visitorlist');
		Route::get('/{action}/{id?}', [VisitorDetailController::class, 'visitor_action'])->name('visitor_action');
		// Route::get('/updatestatus', [VisitorDetailController::class, 'updatestatus'])->name('update_status');
		Route::post('/post', [VisitorDetailController::class, 'visitor_post_action'])->name('visitor.action');
		Route::delete('/delete/{id}', [VisitorDetailController::class, 'delete'])->name('visitor.delete');
	});

	// Route::group(['prefix' => 'teacherlist'], function () {
	// 	Route::get('/', [TeacherMasterController::class, 'index'])->name('teacherlist');
	// 	Route::get('/{action}/{id?}', [TeacherMasterController::class, 'teacher_action'])->name('teacher_action');
	// 	Route::post('/post', [TeacherMasterController::class, 'teacher_post_action'])->name('teacher.action');
	// 	Route::delete('/delete/{id}', [TeacherMasterController::class, 'delete'])->name('teacher.delete');
	// });


	// Route::group(['prefix' => 'citylist'], function () {
	// 	Route::get('/', [CityMatserController::class, 'index'])->name('citylist');		
	// 	Route::get('/{action}/{id?}', [CityMatserController::class, 'city_action'])->name('city_action');
	// 	Route::post('/post', [CityMatserController::class, 'city_post_action'])->name('city.action');
	// 	Route::delete('/delete/{id}', [CityMatserController::class, 'delete'])->name('city.delete');
	// });

	// Route::group(['prefix' => 'statelist'], function () {
	// 	Route::get('/', [StateMatserController::class, 'index'])->name('statelist');
	// 	Route::get('/{action}/{id?}', [StateMatserController::class, 'state_action'])->name('state_action');
	// 	Route::post('/post', [StateMatserController::class, 'state_post_action'])->name('state.action');
	// 	Route::delete('/delete/{id}', [StateMatserController::class, 'delete'])->name('state.delete');
	// });

	// Route::group(['prefix' => 'therapistlist'], function () {
	// 	Route::get('/', [TherapistMasterController::class, 'index'])->name('therapistlist');
	// 	Route::get('/{action}/{id?}', [TherapistMasterController::class, 'therapist_action'])->name('therapist_action');
	// 	Route::post('/post', [TherapistMasterController::class, 'therapist_post_action'])->name('therapist.action');
	// 	Route::delete('/delete/{id}', [TherapistMasterController::class, 'delete'])->name('therapist.delete');
	// });

	// Route::group(['prefix' => 'equipmentlist'], function () {
	// 	Route::get('/', [EquipmentMasterController::class, 'index'])->name('equipmentlist');
	// 	Route::get('/{action}/{id?}', [EquipmentMasterController::class, 'equipment_action'])->name('equipment_action');
	// 	Route::post('/post', [EquipmentMasterController::class, 'equipment_post_action'])->name('equipment.action');
	// 	Route::delete('/delete/{id}', [EquipmentMasterController::class, 'delete'])->name('equipment.delete');
	// });

	// Route::group(['prefix' => 'studentlist'], function () {
	// 	Route::get('/', [StudentAdmissionController::class, 'index'])->name('studentlist');
	// 	Route::get('/get-cities/{id?}', [StudentAdmissionController::class, 'get_cities']);
	// 	Route::get('/{action}/{id?}', [StudentAdmissionController::class, 'student_action'])->name('student_action');
	// 	Route::post('/post', [StudentAdmissionController::class, 'student_post_action'])->name('student.action');

	// 	Route::delete('/delete/{id}', [StudentAdmissionController::class, 'delete'])->name('student.delete');
	// });

	// Route::group(['prefix' => 'studentdocuments'], function () {

	// 	Route::get('/{action}/{student_id?}', [StudentAdmissionController::class, 'student_documents'])->name('student_documents');
	// 	Route::post('/post', [StudentAdmissionController::class, 'student_post_documents'])->name('student.documents');
	// });

	// Route::group(['prefix' => 'studentregister'], function () {
	// 	Route::get('/', [StudentAdmissionController::class, 'student_filter'])->name('studentregister');
	// 	Route::post('/studentregister/fetch', [StudentAdmissionController::class, 'fetchStudents'])->name('studentregister.fetch');
	// });
});
