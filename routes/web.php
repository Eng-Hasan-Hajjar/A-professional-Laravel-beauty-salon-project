<?php
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\RoleController;

use App\Http\Controllers\AdminDashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
 // روابط التحكم بالمستخدمين 
Route::get('/users', [UserController::class, 'index'])->name('users.index'); // عرض قائمة المستخدمين
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // إضافة مستخدم جديد
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // تخزين مستخدم جديد
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // عرض تفاصيل مستخدم معين
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // تعديل مستخدم
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); // تحديث بيانات المستخدم
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // حذف مستخدم
//Route::match(['get', 'post'], '/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('user.assign.role');
Route::post('/users/assign-role', [UserController::class, 'assignRole'])->name('user.assign.role');
//Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('user.assign.role');
Route::delete('/users/{user}/remove-role/{role}', [UserController::class, 'removeRole'])->name('user.remove.role');
Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
});
Route::get('admin-page',function(){
    return view('admin.index');
});
Route::get('template',function(){
    return view('website.index');
});
/**************************************************   website   */

Route::get('/', [AdminDashboardController::class, 'index'])->name('indexproperty'); 



Route::get('about-web',function(){
    return view('website.pages.about');
})->name('about');






use App\Http\Controllers\PersonController;
Route::resource('people', PersonController::class);




use App\Http\Controllers\FinancialSupportController;
Route::resource('financial-supports', FinancialSupportController::class);


use App\Http\Controllers\FundingOrganizationController;
Route::resource('funding-organizations', FundingOrganizationController::class);







use App\Http\Controllers\ServiceCategoryController;
Route::resource('service-categories', ServiceCategoryController::class);


use App\Http\Controllers\ServiceController;
Route::resource('services', ServiceController::class);




use App\Http\Controllers\InventoryController;
Route::resource('inventories', InventoryController::class);



use App\Http\Controllers\EmployeeController;
Route::resource('employees', EmployeeController::class);

use App\Http\Controllers\EmployeeScheduleController;
Route::resource('employee-schedules', EmployeeScheduleController::class);


use App\Http\Controllers\ClientController;
Route::resource('clients', ClientController::class);



use App\Http\Controllers\AppointmentController;
Route::resource('appointments', AppointmentController::class);


use App\Http\Controllers\AppointmentServiceController;
Route::resource('appointment-services', AppointmentServiceController::class);



use App\Http\Controllers\NotificationController;
Route::resource('notifications', NotificationController::class);



use App\Http\Controllers\OfferController;
Route::resource('offers', OfferController::class);



use App\Http\Controllers\ReviewController;
Route::resource('reviews', ReviewController::class);




use App\Http\Controllers\ServiceInventoryController;
Route::resource('service-inventories', ServiceInventoryController::class);



use App\Http\Controllers\WorkController;
use App\Http\Controllers\WorkImageController;


Route::resource('works', WorkController::class);
Route::get('works-web', [WorkController::class, 'index_web'])->name('web_works');
Route::get('works-web/{work}', [WorkController::class, 'index_web_single'])->name('web_works_single');


Route::post('works/{work}/images', [WorkImageController::class, 'store'])->name('work-images.store');
Route::delete('work-images/{workImage}', [WorkImageController::class, 'destroy'])->name('work-images.destroy');
