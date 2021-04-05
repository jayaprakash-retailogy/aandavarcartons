<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobCardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\PurchaseOrdersController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReportController;

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

Route::get('registration', [UserController::class, 'registerCreate'])->name('registration');
Route::post('registration', [UserController::class, 'registerSubmit'])->name('registration');

Route::get('verifyemail', [UserController::class, 'verifyEmail'])->name('verifyemail');

Route::get('/', [UserController::class, 'loginCreate'])->name('/');
Route::post('/', [UserController::class, 'loginSubmit'])->name('/');

Route::get('forgot-password', [UserController::class, 'forgotCreate'])->name('forgot');
Route::post('forgot-password', [UserController::class, 'forgotSubmit'])->name('forgot');

Route::get('reset-password/{token}', [UserController::class, 'resetPasswordCreate'])->name('resetPassword');
Route::post('reset-password/{token}', [UserController::class, 'resetPasswordSubmit'])->name('resetPassword');

Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('jobcard', [TemplateController::class, 'jobcardtemplate'])->name('jobcardtemplate');

// Logged-in users - with "auth" middleware
Route::middleware(['sessionMid'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'create'])->name('dashboard');

    /**
     * Job Card
    */
    Route::get('jobcard/new', [JobCardController::class, 'create'])->name('jobcardNew');
    Route::post('postjobcard', [JobCardController::class, 'postjobcard'])->name('postjobcard');

    Route::get('jobcard/edit', [JobCardController::class, 'editCreate'])->name('jobcardEdit');
    //Route::post('jobcard/edit/{id}', [JobCardController::class, 'editSubmit'])->name('jobcardEdit');

    Route::get('jobcard/all', [JobCardController::class, 'allCreate'])->name('jobcardAll');

    Route::get('jobcard/status', [JobCardController::class, 'jobcardStatus'])->name('jobcardStatus');
    Route::get('jobcard/progress/status/{id}/{status}', [JobCardController::class, 'jobcardProgressStatus'])->name('jobcardProgressStatus');

    Route::post('getpoitemlist/{id}', [JobCardController::class, 'getpoitems']);
    Route::post('getstock/{id}', [JobCardController::class, 'getstock']);


    Route::get('report/productionsummary', [ProductionController::class, 'productionsummary'])->name('productionsummary');
    Route::get('report/stocksummary', [ProductionController::class, 'stocksummary'])->name('stocksummary');

    /**
     * Stock
    */
    // Route::get('stock/new', [StockController::class, 'create'])->name('stockNew');
    // Route::post('stock/new', [StockController::class, 'submit'])->name('poststock');

    // Route::get('stock/edit/{id}', [StockController::class, 'editCreate'])->name('stockEdit');
    // Route::post('stock/edit/{id}', [StockController::class, 'editSubmit'])->name('stockEdit');

    // Route::get('stock/all', [StockController::class, 'allCreate'])->name('stockAll');

    // Route::get('stock/status/{id}/{status}', [StockController::class, 'stockStatus'])->name('stockStatus');

    /**
     * Stock
     */

    Route::get('/stock/list', [StockController::class, 'list'])->name('stocklist');
    Route::get('/stock/create', [StockController::class, 'create'])->name('stockcreate');
    Route::post('/poststock', [StockController::class, 'poststock'])->name('poststock');
    Route::get('/stock/edit', [StockController::class, 'edit'])->name('stockedit');
    Route::get('stock/status/{id}/{status}', [StockController::class, 'stockstatus'])->name('stockstatus');

    /**
     * Customer
    */

    Route::get('customer', [CustomerController::class, 'create'])->name('customer');
    Route::post('customer', [CustomerController::class, 'submit'])->name('customer');
    Route::post('customer/edit/{id}', [CustomerController::class, 'editCreate'])->name('customerEditCreate');
    Route::post('customer/edit', [CustomerController::class, 'editSubmit'])->name('customerEdit');

    Route::get('customer/status/{id}/{status}', [CustomerController::class, 'customerStatus'])->name('customerStatus');

    /**
     * Supplier
    */

    Route::get('supplier', [SupplierController::class, 'create'])->name('supplier');
    Route::post('supplier', [SupplierController::class, 'submit'])->name('supplier');

    Route::post('supplier/edit/{id}', [SupplierController::class, 'editCreate'])->name('supplierEditCreate');
    Route::post('supplier/edit', [SupplierController::class, 'editSubmit'])->name('supplierEdit');

    Route::get('supplier/status/{id}/{status}', [SupplierController::class, 'supplierStatus'])->name('supplierStatus');

    /**
     * Employee
     */
    Route::get('employee', [EmployeeController::class, 'create'])->name('employee');
    Route::post('employee', [EmployeeController::class, 'submit'])->name('employee');

    Route::post('employee/edit/{id}', [EmployeeController::class, 'editCreate'])->name('employeeEditCreate');
    Route::post('employee/edit', [EmployeeController::class, 'editSubmit'])->name('employeeEdit');

    Route::get('employee/status/{id}/{status}', [EmployeeController::class, 'employeeStatus'])->name('employeeStatus');


    /**
     * ACCOUNTS
     */
    Route::get('accounts', [AccountsController::class, 'create'])->name('account');
    Route::get('accounts/create', [AccountsController::class, 'formcreate'])->name('accountscreate');
    Route::post('postaccounts', [AccountsController::class, 'submit'])->name('postaccounts');
    Route::get('accounts/edit', [AccountsController::class, 'editCreate'])->name('accountedit');
    Route::get('accounts/status/{id}/{status}', [AccountsController::class, 'accountStatus'])->name('accountStatus');

    /**
     * REPORT
     */
    Route::get('report/purchase', [ReportController::class, 'purchasereport'])->name('purchasereport');
    Route::get('report/accounts', [ReportController::class, 'accountsReport'])->name('accountsreport');
    Route::get('report/salary', [ReportController::class, 'salaryReport'])->name('salaryReport');
    
    /**
     * Purchase Orders
     */

    Route::get('/purchaseorders/list', [PurchaseOrdersController::class, 'list'])->name('polist');
    Route::get('/purchaseorders/create', [PurchaseOrdersController::class, 'create'])->name('pocreate');
    Route::post('/postpurchaseorders', [PurchaseOrdersController::class, 'postpurchaseorders'])->name('postpurchaseorders');

    Route::get('/purchaseorders/edit', [PurchaseOrdersController::class, 'edit'])->name('purchaseorderedit');

    Route::get('purchaseorder/status/{id}/{status}', [PurchaseOrdersController::class, 'purchaseorderstatus'])->name('purchaseorderstatus');
    Route::get('purchaseorder/progress/status/{id}/{status}', [PurchaseOrdersController::class, 'purchaseorderProgressStatus'])->name('purchaseorderProgressStatus');

    Route::get('potoinvoice', [PurchaseOrdersController::class, 'potoinvoice'])->name('potoinvoice');

    /**
     * settings
     */
    Route::get('settings', [SettingsController::class, 'create'])->name('settings');
    Route::post('settings', [SettingsController::class, 'submit'])->name('settings');
    Route::get('settings/edit', [SettingsController::class, 'editcreate'])->name('settingsedit');

    /**
     * Invoice
     */

    Route::get('/invoice/list', [InvoiceController::class, 'list'])->name('invoicelist');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoicecreate');
    Route::post('/postinvoice', [InvoiceController::class, 'postinvoice'])->name('postinvoice');
    Route::get('/invoice/edit', [InvoiceController::class, 'edit'])->name('invoiceedit');
    Route::get('invoice/status', [InvoiceController::class, 'invoicestatus'])->name('invoicestatus');
    Route::get('invoice/payment', [InvoiceController::class, 'invoicepaymentstatus'])->name('invoicepaymentstatus');
    Route::get('invoice/view', [InvoiceController::class, 'getinvoice'])->name('getinvoice');

    /**
     * Quotations
     */

    Route::get('/quotation/list', [QuotationController::class, 'list'])->name('quotationlist');
    Route::get('/quotation/create', [QuotationController::class, 'create'])->name('quotationcreate');
    Route::post('/postquotation', [QuotationController::class, 'postquotation'])->name('postquotation');
    Route::get('/quotation/edit', [QuotationController::class, 'edit'])->name('quotationedit');
    Route::get('quotation/status', [QuotationController::class, 'quotationstatus'])->name('quotationstatus');
    Route::get('quotation/view', [QuotationController::class, 'getquotation'])->name('getquotation');
});