<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Livewire\DepartmentCrud;
use App\Livewire\General\Department;
use App\Livewire\General\Designation;
use App\Livewire\General\DoctorSpeciality;
use App\Livewire\General\Employee;
use App\Livewire\General\EmployeeDocument;
use App\Livewire\General\EmployeeSchedule;
use App\Livewire\Reception\Patient;
use App\Livewire\Laboratory\Test;
use App\Livewire\Laboratory\TestReferral;
use App\Livewire\Pharmacy\Company;
use App\Livewire\Pharmacy\Invoice;
use App\Livewire\Pharmacy\InvoiceDetail;
use App\Livewire\Pharmacy\Packing;
use App\Livewire\Pharmacy\Product;
use App\Livewire\Pharmacy\Purchase;
use App\Livewire\Pharmacy\PurchaseDetail;
use App\Livewire\Pharmacy\ReturnInvoice;
use App\Livewire\Pharmacy\ReturnInvoiceDetail;
use App\Livewire\Pharmacy\Stock;
use App\Livewire\Pharmacy\Supplier;
use App\Livewire\General\Discount;
use App\Livewire\General\DiscountType;
use App\Livewire\Laboratory\LabResult;
use App\Livewire\Reception\Fee;
use App\Livewire\Reception\FeeReceipt;
use App\Livewire\Reception\InvoiceReceipt;
use App\Livewire\Reception\ReturnInvoiceReceipt;
use App\Livewire\Reception\Service;
use App\Livewire\Reception\ServiceReceipt;
use App\Livewire\Reception\ServiceType;
use NunoMaduro\Collision\Adapters\Phpunit\TestResult;

use App\Http\Controllers\Routes\GeneralController;
use App\Http\Controllers\Routes\PharmacyController;
use App\Http\Controllers\Routes\ReceptionController;
use App\Http\Controllers\Routes\LaboratoryController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Admin Login Route
Route::get('/', [AdminController::class, 'AdminLogin'])->name('admin.login');

/**
 * General
 */
Route::middleware(['auth'])->prefix('general')->group(function () {
    //Department routes
    Route::get('/department', [GeneralController::class, 'department'])->name('general.department');
    //Designation routes
    Route::get('/designation', [GeneralController::class, 'designation'])->name('general.designation');
    //employee routes
    Route::get('/employee',[GeneralController::class, 'employee'])->name('general.employee');
    //employee document routes
    Route::get('/employee/document', [GeneralController::class, 'employee_document'])->name('general.employee.document');
    //employee schedule routes
    Route::get('/employee/schedule', [GeneralController::class, 'employee_schedule'])->name('general.employee.schedule');
    //doctor speciality routes
    Route::get('/employee/doctor/speciality', [GeneralController::class, 'employee_doctor_speciality'])->name('general.employee.doctor.speciality');
    //discount type routes
    Route::get('/discount/type', [GeneralController::class, 'discount_type'])->name('general.discount.type');
    //discount route
    Route::get('/discount', [GeneralController::class, 'discount'])->name('general.discount');
});

/**
 * Reception
 */
Route::middleware(['auth'])->prefix('reception')->group(function () {

    //Patient routes
    Route::get('/patient',[ReceptionController::class, 'patient'])->name('reception.patient');
    //Fees routes
    Route::get('/fees', [ReceptionController::class, 'fee'])->name('reception.fee');
    //Service Type routes
    Route::get('/service/type', [ReceptionController::class, 'service_type'])->name('reception.service-type');
    //Service routes
    Route::get('/services', [ReceptionController::class, 'service'])->name('reception.service');
    //Fee receipt routes
    Route::get('/fee/receipt', [ReceptionController::class, 'fee_receipt'])->name('reception.fee.receipt');
    //service receipt routes
    Route::get('/service/receipt', [ReceptionController::class, 'service_receipt'])->name('reception.service.receipt');
    //invoice receipt routes
    Route::get('/invoice/receipt', [ReceptionController::class, 'invoice_receipt'])->name('reception.invoice.receipt');
    //return invoice receipt routes
    Route::get('/return/invoice/receipt', [ReceptionController::class, 'return_invoice_receipt'])->name('reception.return.invoice.receipt');

});

/**
 * Pharmacy
 */
Route::middleware(['auth'])->prefix('pharmacy')->group(function () {
    //GENERAL
    //Company routes
    Route::get('/company', [pharmacycontroller::class, 'company'])->name('pharmacy.company');

    //Supplier routes
    Route::get('/supplier',  [pharmacycontroller::class, 'supplier'])->name('pharmacy.supplier');
    //Packing routes
    Route::get('/packing', [pharmacycontroller::class, 'packing'])->name('pharmacy.packing');
    //Product routes
    Route::get('/product', [pharmacycontroller::class, 'product'])->name('pharmacy.product');
    //Stock routes
    Route::get('/stock', [pharmacycontroller::class, 'stock'])->name('pharmacy.stock');

    //Invventory
    //Stock routes
    //Purchase routes
    Route::get('/purchase', [pharmacycontroller::class, 'purchase'])->name('pharmacy.purchase');
    //PurchaseDetails routes
    Route::get('/purchase/detail', [pharmacycontroller::class, 'purchase_detail'])->name('pharmacy.purchase.detail');

    //Billings
    //invoice routes
    Route::get('/invoice', [pharmacycontroller::class, 'invoice'])->name('pharmacy.invoice');
    //invoiceDetails routes
    Route::get('/invoice/detail', [pharmacycontroller::class, 'invoice_detail'])->name('pharmacy.invoice.detail');
    //return invoice routes
    Route::get('/return/invoice', [pharmacycontroller::class, 'return_invoice'])->name('pharmacy.return.invoice');
    //return invoiceDetails routes
    Route::get('/return/invoice/detail', [pharmacycontroller::class, 'return_invoice_detail'])->name('pharmacy.return.invoice.detail');

});

/**
 * Laboratory (LAB)
 */
Route::middleware(['auth'])->prefix('lab')->group(function () {

    //Test routes
    Route::get('/test', [LaboratoryController::class, 'test'])->name('lab.test');
    //Test Referral routes
    Route::get('/test/referral',[LaboratoryController::class, 'test_referral'])->name('lab.test.referral');
    //Test Result routes
    Route::get('/test/result', [LaboratoryController::class, 'test_result'])->name('lab.test.result');

});

// admin related routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

}); // end admin middleware routes

// agent related routes
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

}); // end agent middleware routes




// Department CRUD routes
Route::middleware(['auth'])->prefix('departments')->group(function () {
    Route::get('/Crud', DepartmentCrud::class)->name('department-crud');
});

// Remove or comment out the old single route
// Route::get('/department-crud', DepartmentCrud::class)->name('depsssartment-crud');
