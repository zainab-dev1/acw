<?php

use App\Models\AcademicYear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\VisitController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ExhibitionRegistrationController;
use App\Http\Controllers\ExhibitionAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PublicController::class,'public'])->name('public');
Route::get('/activities/upcoming', [PublicController::class,'upcomingActivities'])->name('public.upcoming');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'postlogin'])->name('postlogin');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

Route::get('loginas/{id}',[AuthController::class,'loginas'])->name('loginas'); 
Route::post('loginas/{id}',[AuthController::class,'postloginas'])->name('postloginas'); 

// Exhibition registration (public)
Route::get('/exhibition/register', [ExhibitionRegistrationController::class, 'create'])->name('exhibition.register');
Route::post('/exhibition/register', [ExhibitionRegistrationController::class, 'store'])->name('exhibition.register.store');

Route::middleware('auth')->group(function() {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

    // Route::get('/visits',[VisitController::class,'index'])->name('visits.index');
    // Route::get('/visits/request',[VisitController::class,'request'])->name('visits.request');
    // Route::post('/visits/request',[VisitController::class,'postrequest'])->name('visits.postrequest');
    // Route::get('/visits/calendar',[VisitController::class,'calendar'])->name('visits.calendar');

    // Route::get('/visits/{id}/approve',[VisitController::class,'approve'])->name('visits.approve');
    // Route::get('/visits/{id}/reject',[VisitController::class,'reject'])->name('visits.reject');

    // Route::get('/visits/{id}/conducted',[VisitController::class,'conducted'])->name('visits.conducted');
    // Route::get('/visits/{id}/notconducted',[VisitController::class,'notconducted'])->name('visits.notconducted');

    Route::get('/userrole',[UserRoleController::class,'index'])->name('userrole.index');
    Route::get('/userrole/create', [UserRoleController::class,'create'])->name('userrole.create');
    Route::post('/userrole/create', [UserRoleController::class,'store'])->name('userrole.store');
    Route::get('/userrole/{id}/delete',[UserRoleController::class,'destroy'])->name('userrole.destroy');

    Route::get('/academicyear',[AcademicYearController::class,'index'])->name('academicyear.index');
    Route::get('/academicyear/create',[AcademicYearController::class,'create'])->name('academicyear.create');
    Route::post('/academicyear/create',[AcademicYearController::class,'store'])->name('academicyear.store');
    Route::get('/academicyear/{id}/edit',[AcademicYearController::class,'edit'])->name('academicyear.edit');
    Route::post('/academicyear/{id}/edit',[AcademicYearController::class,'update'])->name('academicyear.update');
    Route::get('/academicyear/{id}/setactive',[AcademicYearController::class,'setactive'])->name('academicyear.setactive');
    Route::get('/academicyear/{id}/setinactive',[AcademicYearController::class,'setinactive'])->name('academicyear.setinactive');

    Route::get('/activity',[ActivityController::class,'index'])->name('activity.index');
    Route::get('/activity/prepare',[ActivityController::class,'prepare'])->name('activity.prepare');
    Route::post('/activity/prepare',[ActivityController::class,'postprepare'])->name('activity.postprepare');
    Route::get('/activity/{id}/edit',[ActivityController::class,'edit'])->name('activity.edit');
    Route::post('/activity/{id}/edit',[ActivityController::class,'update'])->name('activity.update');
    Route::get('/activity/{id}/isopen',[ActivityController::class,'isopen'])->name('activity.isopen');
    Route::get('/activity/{id}/isclose',[ActivityController::class,'isclose'])->name('activity.isclose');
    Route::get('/activity/{id}/mean', [ActivityController::class,'mean'])->name('activity.mean');
    Route::get('/activity/{id}/participants', [ActivityController::class,'participants'])->name('activity.participants');
    Route::get('/activity/{id}/participants/export', [ActivityController::class,'exportParticipants'])->name('activity.participants.export');

    Route::get('/certificate/{id}/edit', [CertificateController::class,'edit'])->name('certificate.edit');
    Route::post('/certificate/{id}/edit', [CertificateController::class,'update'])->name('certificate.update');
    Route::get('/certificate/{id}/email',[CertificateController::class,'email'])->name('certificate.email');
    Route::get('/activity/public',[ActivityController::class,'public'])->name('activity.public');


    // Backward compatible (old Event URLs) -> redirect to Activity URLs
    Route::get('/event', fn() => redirect()->route('activity.index'));
    Route::get('/event/prepare', fn() => redirect()->route('activity.prepare'));
    Route::get('/event/public', fn() => redirect()->route('activity.public'));

    // Exhibition admin
    Route::get('/exhibition/admin', [ExhibitionAdminController::class, 'index'])->name('exhibition.admin.index');
    Route::get('/exhibition/admin/open', [ExhibitionAdminController::class, 'open'])->name('exhibition.admin.open');
    Route::get('/exhibition/admin/close', [ExhibitionAdminController::class, 'close'])->name('exhibition.admin.close');
    Route::get('/exhibition/admin/export', [ExhibitionAdminController::class, 'export'])->name('exhibition.admin.export');
    Route::get('/exhibition/admin/file/{fileId}/download', [ExhibitionAdminController::class, 'downloadFile'])->name('exhibition.admin.file.download');

});

Route::get('/activity/public/{id}', [ActivityController::class, 'showPublic'])->name('activity.show');
Route::get('/activity/public/feedback/{event_id}',[ActivityController::class,'feedback'])->name('activity.feedback');
Route::post('/activity/public/feedback/{event_id}',[ActivityController::class,'postfeedback'])->name('activity.postfeedback');

Route::get('/activity/public/open-form/{id}', [ActivityController::class, 'publicForm'])->name('activity.publicform');

// Old public paths -> redirect
Route::get('/event/public/feedback/{event_id}', fn($event_id) => redirect()->route('activity.feedback', $event_id));
Route::post('/event/public/feedback/{event_id}', fn($event_id) => redirect()->route('activity.feedback', $event_id));

Route::get('/activity/public/formcts/{id}/{attendance}',[ActivityController::class,'formcts'])->name('activity.formcts');
Route::get('/activity/public/formiv/{id}/{attendance}',[ActivityController::class,'formiv'])->name('activity.formiv');
Route::get('/activity/public/formgl/{id}/{attendance}',[ActivityController::class,'formgl'])->name('activity.formgl');

Route::post('/activity/public/postform/{id}',[ActivityController::class,'postform'])->name('activity.postform');

Route::get('/activity/public/{id}/register', [ActivityController::class,'attendance'])->name('activity.register');
Route::post('/activity/public/{id}/register', [ActivityController::class,'postattendance'])->name('activity.postregister');

// Backward compatible public paths -> redirect
Route::get('/activity/public/{id}/attendance', fn($id) => redirect()->route('activity.register', $id));
Route::post('/activity/public/{id}/attendance', fn($id) => redirect()->route('activity.register', $id));

Route::get('/event/public/{id}/attendance', fn($id) => redirect()->route('activity.register', $id));
Route::post('/event/public/{id}/attendance', fn($id) => redirect()->route('activity.register', $id));

Route::get('/certificate/verify', [CertificateController::class,'verify'])->name('certificate.verify');
Route::post('/certificate/verify', [CertificateController::class,'postverify'])->name('certificate.postverify');

Route::get('/certificate/list',[CertificateController::class,'list'])->name('certificate.list');
Route::post('/certificate/list',[CertificateController::class,'postlist'])->name('certificate.postlist');

Route::get('/certificate/{id}/view',[CertificateController::class,'view'])->name('certificate.view');