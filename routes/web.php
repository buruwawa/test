<?php

use App\Http\Controllers\accountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\companyValueController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\customRegisterController;
use App\Http\Controllers\expensesController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\posController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\purchaseController;
use App\Http\Controllers\rentalController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\reportFinanceController;
use App\Http\Controllers\reportStockController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\stockingController;
use App\Http\Controllers\storeController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\tenantController;
use App\Http\Controllers\testerController;
use App\Http\Controllers\usersPermissionController;
use App\Http\Controllers\warehouseController;
use App\Http\Livewire\Show;
use App\Http\Livewire\Department;
use App\Http\Livewire\Property;
use App\Http\Livewire\PropertyLivewire;
use App\Http\Livewire\IndicatorLivewire;
use App\Http\Livewire\AssignLivewire;
use App\Http\Livewire\AssignRolesLivewire;
use App\Http\Livewire\AssignRolesUserLivewire;

use App\Http\Livewire\ActivityRolesLivewire;
use App\Http\Livewire\Checklist;
use App\Http\Livewire\UserActivityLivewire;

use App\Http\Livewire\Showfinal;
use \Spatie\Multitenancy\Http\Middleware\NeedsTenant;
use App\http\Mail\reportMail;
use App\Mail\OrderEmails;
use App\Http\Controllers\ImportExportController;

//TS wawa
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\rolesController;
use App\Http\Controllers\PropertyController;

use App\Http\Controllers\MetadataController;
use App\Http\Controllers\MetanameController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\UserRegisterController;

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

// Route::resource('render',Department::class)->name('render');
// Route::post('livewirex/{post}',Department::class)->name('livewirex');
Route::get('possale/{post}',Show::class)->name('possale');
Route::get('posfinal/{post}',Showfinal::class)->name('posfinal');
// Authenticated area
Route::get('create-company',[tenantController::class,'index'])->name('create-company');
Route::get('/license', [adminController::class,'license']);
// Route::middleware(['tenant','auth'])->group(function() {
    // routes
  Route::resource('propertyTest', PropertyLivewire::class)->middleware(['role:Admin|Store']);
  Route::resource('setIndicator', IndicatorLivewire::class)->middleware(['role:Admin|Store']);

 Route::get('livewirex/{id}',Department::class)->name('livewirex');
 Route::get('property/{id}',PropertyLivewire::class)->name('property');
 Route::get('indicator/{id}',IndicatorLivewire::class)->name('indicator');


Route::get('assign-indicator/{id}',AssignLivewire::class)->name('assign-indicator');
Route::resource('assign-indicator',AssignLivewire::class)->middleware(['role:Admin|Store']);

Route::get('assign-roles/{id}',AssignRolesLivewire::class)->name('assign-roles');
Route::resource('assign-roles',AssignRolesLivewire::class)->middleware(['role:Admin|Store']);

Route::get('assign-roles-user/{id}',AssignRolesUserLivewire::class)->name('assign-roles-user');
Route::resource('assign-roles-user',AssignRolesUserLivewire::class)->middleware(['role:Admin|Store']);

Route::get('activity-roles/{id}',ActivityRolesLivewire::class)->name('activity-roles');
Route::resource('activity-roles',ActivityRolesLivewire::class)->middleware(['role:Admin|Store']);
//
Route::get('user-activity/{id}',UserActivityLivewire::class)->name('user-activity');
Route::resource('user-activity',UserActivityLivewire::class)->middleware(['role:Admin|Store']);
 //Checklist
  Route::get('checklist/{id}',Checklist::class)->name('checklist');
  Route::resource('checklist', Checklist::class)->middleware(['role:Admin|Store']);
  //End of Checklist

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.index');
       // return redirect()->route('register');
    });
//TS wawa
   // Route::resource('user-register', UserRegisterController::class);
   Route::resource('user-register',UserRegisterController::class)->middleware(['role:Admin|Store']);
      Route::get('delete-user/{id}',[UserRegisterController::class,'edit'])->name('delete-user');
  Route::get('update-user/{id}',[UserRegisterController::class,'recoveryUpdate'])->name('update-user');
  Route::get('recovery-user',[UserRegisterController::class,'recovery'])->name('recovery-user');

    //properties
   Route::resource('metaname',MetanameController::class)->middleware(['role:Admin|Store']);
   Route::get('delete-metaname/{id}',[MetanameController::class,'edit'])->name('delete-metaname');
  Route::get('update-metaname/{id}',[MetanameController::class,'recoveryUpdate'])->name('update-metaname');
  Route::get('recovery-metaname',[MetanameController::class,'recovery'])->name('recovery-metaname');
//Metadata
    Route::resource('metadata',MetadataController::class)->middleware(['role:Admin|Store']);
      Route::get('delete-metadata/{id}',[MetadataController::class,'edit'])->name('delete-metadata');
  Route::get('update-metadata/{id}',[MetadataController::class,'recoveryUpdate'])->name('update-metadata');
  Route::get('recovery-metadata',[MetadataController::class,'recovery'])->name('recovery-metadata');

  // Route::resource('render', Department::class,'render')->middleware(['role:Admin|Store']);
Route::resource('department', DepartmentController::class)->middleware(['role:Admin|Store']);
  Route::get('delete-department/{id}',[DepartmentController::class,'edit'])->name('delete-department');
  Route::get('update-department/{id}',[DepartmentController::class,'recoveryUpdate'])->name('update-department');
  Route::get('recovery-department',[DepartmentController::class,'recovery'])->name('recovery-department');

// Roles ontroller
Route::resource('role-register', rolesController::class)->middleware(['role:Admin|Store']);
  Route::get('delete-role/{id}',[rolesController::class,'edit'])->name('delete-role');
  Route::get('update-role/{id}',[rolesController::class,'recoveryUpdate'])->name('update-role');
  Route::get('recovery-role',[rolesController::class,'recovery'])->name('recovery-role');

// Site ontroller
       Route::resource('sites', siteController::class)->middleware(['role:Admin|Store']);
       Route::get('delete-site/{id}',[siteController::class,'edit'])->name('delete-site');
       Route::get('recovery-site',[siteController::class,'recovery'])->name('recovery-site');
       Route::get('update-site/{id}',[siteController::class,'recoveryUpdate'])->name('update-site');
    //Route::resource('sites',siteController::class);
    // End of TS Wawa

Route::resource('companyvalue',companyValueController::class);
Route::resource('admin', adminController::class);
Route::resource('warehouse', warehouseController::class)->middleware(['role:Admin']);
Route::resource('users', usersPermissionController::class)->middleware(['role:Admin']);
Route::resource('suppliers', supplierController::class)->middleware(['role:Admin']);
Route::resource('stocks', stockController::class)->middleware(['role:Admin|Store']);

Route::resource('pos', posController::class)->middleware(['role:Sales']);
Route::get('pos-final', [posController::class,'posFinal'])->middleware(['role:Sales']);

Route::resource('customers', customerController::class);
Route::resource('stocking', stockingController::class);
Route::get('issued-stock', [stockingController::class,'pendingIndex'])->name('pending-stock');
Route::get('returned-stock', [stockingController::class,'returnedIndex'])->name('returned-stock');

Route::post('pending', [stockingController::class,'pendingStock'])->name('pending');
Route::get('pending/destroy/{x}', [stockingController::class,'destroy'])->name('pending.destroy');

Route::get('my-stock', [stockingController::class,'my_stock'])->middleware(['role:Sales']);

Route::resource('sales', salesController::class);
Route::get('outstandings', [salesController::class,'outstanding']);
Route::resource('payment', paymentController::class);
Route::get('invoices/{id}', [paymentController::class,'viewInvoice'])->name('invoices');
Route::get('order', [salesController::class,'order'])->name('order','order');
Route::post('orders',[posController::class,'orders'])->name('orders','orders');

route::resource('/roles',roleController::class)->middleware(['role:Admin']);
route::resource('/expenses',expensesController::class)->middleware(['role:Admin|Account']);
route::resource('/stores',storeController::class)->middleware(['role:Admin|Store']);
route::resource('/account',accountController::class)->middleware(['role:Admin|Account']);
route::resource('/stock-purchase',purchaseController::class)->middleware(['role:Admin|Store|Account']);
Route::get('customers-list', [customerController::class,'customer_list']);

// Sales Report Controllers
Route::get('report-sales',[reportController::class,'index'])->name('report-sales');
Route::get('expenses-report',[reportController::class,'expensesReport'])->name('expenses-report');
Route::get('expenses-filter',[reportController::class,'expensesFilter'])->name('expenses_filter');

Route::get('report-purchase',[reportController::class,'purchaseReport'])->name('report-purchase');
Route::get('report-item',[reportController::class,'itemSold'])->name('report-item');
Route::get('filter-item',[reportController::class,'soldFilter'])->name('filter-item');
Route::get('show-order/{id}',[reportController::class,'showOrder'])->name('show-order');
Route::get('show-purchase/{id}',[reportController::class,'showPurchase'])->name('show-purchase');
Route::get('filter-sales',[reportController::class,'filtersales'])->name('filter-sales');

Route::get('purchases',[reportController::class,'filterPurchase'])->name('purchases');
Route::get('customersales/{id}',[reportController::class,'customersale'])->name('customersales');

Route::resource('report-action', reportController::class);

// Stock Report Controllers
Route::resource('stock-reports', reportStockController::class);
Route::get('stock-alert',[reportStockController::class,'stock_alert'])->name('stock-reports');
Route::resource('finance', reportFinanceController::class);
Route::get('filter-finance', [reportFinanceController::class,'filterfinance'])->name('filter-finance');
Route::get('customershow/{id}',[customerController::class,'customershow'])->name('customershow');
Route::get('/substore/{id}/{item}',[storeController::class, 'show'])->name('substore')->middleware(['role:Admin|Store']);
Route::get('/purchase-report',[reportFinanceController::class, 'purchaseReport'])->name('purchase-report');
Route::get('/filter-purchase',[reportFinanceController::class, 'purchaseFilter'])->name('filter-purchase');

Route::get('sold/{id}',[reportFinanceController::class, 'sold'])->name('sold');
Route::get('instock/{id}',[reportFinanceController::class, 'instock'])->name('instock');

Route::get('transaction-report',[reportController::class,'transaction_report'])->name('transaction-report');
Route::get('transactions/{id}',[reportController::class,'transactions'])->name('transactions');
Route::get('transaction-filter',[reportController::class,'transaction_filter'])->name('transaction-filter');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('admin.index');
})->name('dashboard');

// Rental

Route::resource('stock-rent', rentalController::class);
Route::get('rent-items', [rentalController::class,'rental_items']);
Route::post('addrentItem', [rentalController::class,'addRentItem'])->name('addrentItem');
Route::post('createOrder', [rentalController::class,'createOrder'])->name('createOrder');
Route::get('shops',[warehouseController::class,'shops']);
Route::resource('profile',profileController::class);

Route::resource('custom-users', customRegisterController::class);


// test
Route::get('tester',[testerController::class,'test']);

// Route::get('possale/{post}',Show::class)->name('possale');
// Route::get('posfinal/{post}',Showfinal::class)->name('posfinal');

Route::get('export-sales', [ImportExportController::class,'order_export'])->name('export-sales');
Route::get('export-outstanding', [ImportExportController::class,'outstandings_export'])->name('export-outstanding');

});



Route::get('ordermail',function(){
    return new App\Mail\OrderEmails;
});
Route::resource('mail_now',mailController::class);

Route::get('send-mail', function () {

    $details = [
        'title' => 'Moxa Info',
        'body' => 'This is for testing email using smtp'
    ];

    // \Mail::to('olekiroya@gmail.com')->send(new \App\Mail\reportMail($details));

    dd("Email is Sent.");
});
