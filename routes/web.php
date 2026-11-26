
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WMSController;

Route::get('/students/create', [WMSController::class, 'create'])
    ->name('students.create');

Route::post('/students/store', [WMSController::class, 'store'])
    ->name('students.store');
// ==================== PUBLIC PAGES ====================

Route::get('/', [WMSController::class, 'index'])->name('public.home');
Route::view('/about', 'public.about')->name('public.about');
Route::view('/contact', 'public.contact')->name('public.contact');

Route::get('/productview', [WMSController::class, 'productview'])
    ->name('productview');


// ==================== ADMIN LOGIN ====================

Route::view('/admin', 'admin-login.admin')
    ->name('admin-login.admin');

Route::post('/admin', function () {
    return redirect('/ad');
})->name('admin.login.submit');

Route::view('/forgot', 'admin-login.admin-forgot-password')
    ->name('admin-login.admin-forgot-password');


// ==================== STAFF LOGIN ====================

Route::view('/staff-login', 'staff.login')
    ->name('staff.login');

Route::post('/staff-login', function () {
    return redirect('/sd');
})->name('staff.login.submit');

Route::view('/staff-forgot-password', 'staff.forgot-password')
    ->name('staff.forgot-password');


// ==================== ADMIN DASHBOARD ====================

Route::get('/ad', [WMSController::class, 'dashboard'])
    ->name('admindashboard.admindashboard');


// ==================== STAFF MANAGEMENT ====================

Route::get('/staff', [WMSController::class, 'staff'])
    ->name('admin.staff');

Route::get('/staff/create', [WMSController::class, 'addstaff'])
    ->name('admin.staff.create');

Route::post('/staff/store', [WMSController::class, 'storestaff'])
    ->name('admin.staff.store');

Route::get('/staff/{id}/edit', [WMSController::class, 'editstaff'])
    ->whereNumber('id')
    ->name('admin.staff.edit');

Route::put('/staff/{id}', [WMSController::class, 'updatestaff'])
    ->whereNumber('id')
    ->name('admin.staff.update');

Route::delete('/staff/{id}', [WMSController::class, 'deletestaff'])
    ->whereNumber('id')
    ->name('admin.staff.destroy');


// ==================== CATEGORY MANAGEMENT ====================

Route::get('/category', [WMSController::class, 'categories'])
    ->name('admin.categories');

Route::get('/category/{category}/products', [WMSController::class, 'categoryProducts'])
    ->name('admin.categories.products');


// ==================== PRODUCT MANAGEMENT ====================

// Product list
Route::get('/admin-product', [WMSController::class, 'showproduct'])
    ->name('admin.adminproducts');

// Add product page
Route::get('/admin-product/create', function () {
    return view('admindashboard.addproduct');
})->name('admin.products.create');

// Save product
Route::post('/admin-product', [WMSController::class, 'createproduct'])
    ->name('admin.products.store');

// Edit product page
Route::get('/admin-product/{id}/edit', [WMSController::class, 'editproduct'])
    ->whereNumber('id')
    ->name('admin.products.edit');

// Update product
Route::put('/admin-product/{id}', [WMSController::class, 'updateproduct'])
    ->whereNumber('id')
    ->name('admin.products.update');

// Change product status
Route::patch('/admin-product/{id}/status', [WMSController::class, 'updateProductStatus'])
    ->whereNumber('id')
    ->name('admin.products.status');

// Delete product
Route::delete('/admin-product/{id}', [WMSController::class, 'deleteproduct'])
    ->whereNumber('id')
    ->name('admin.products.destroy');


// ==================== SUPPLIER MANAGEMENT ====================

// Supplier list
Route::get('/supplier', [WMSController::class, 'suppliersview'])
    ->name('admin.suppliers');

// Add supplier
Route::post('/supplier', [WMSController::class, 'supplieradd'])
    ->name('admin.suppliers.store');

// Edit supplier
Route::get('/supplier/{id}/edit', [WMSController::class, 'editSupplier'])
    ->whereNumber('id')
    ->name('admin.suppliers.edit');

// Update supplier
Route::put('/supplier/{id}', [WMSController::class, 'updateSupplier'])
    ->whereNumber('id')
    ->name('admin.suppliers.update');

// Change supplier status
Route::patch('/supplier/{id}/status', [WMSController::class, 'toggleSupplierStatus'])
    ->whereNumber('id')
    ->name('admin.suppliers.status');

// Delete supplier
Route::delete('/supplier/{id}', [WMSController::class, 'deleteSupplier'])
    ->whereNumber('id')
    ->name('admin.suppliers.destroy');


// ==================== PURCHASE MANAGEMENT ====================

// Purchase list
Route::get('/purchases', [WMSController::class, 'Purchasesview'])
    ->name('admin.purchases');

// Add purchase page
Route::get('/purchases/create', [WMSController::class, 'createPurchase'])
    ->name('admin.purchases.create');

// Save purchase
Route::post('/purchases', [WMSController::class, 'storePurchase'])
    ->name('admin.purchases.store');

// View purchase invoice
Route::get('/purchases/{id}', [WMSController::class, 'showPurchase'])
    ->whereNumber('id')
    ->name('admin.purchases.show');


// ==================== OTHER ADMIN PAGES ====================

// Route::view('/sales', 'admindashboard.sales')
//     ->name('admin.sales');

Route::get('/sales', [WMSController::class, 'adminSales'])
    ->name('admin.sales');
Route::get('/stock', [WMSController::class, 'Stockview'])
    ->name('admin.stock');

// Route::view('/internal-customer', 'admindashboard.internalCustomer')
//     ->name('admin.internalCustomer');


Route::get('/internal-customer', [WMSController::class, 'adminInternalCustomers'])
    ->name('admin.internalCustomer');

// ==================== STAFF DASHBOARD PAGES ====================

// Route::view('/sd', 'staffdashboard.staffdashboard')
//     ->name('staffdashboard.staffdashboard');

Route::get('/sd', [WMSController::class, 'staffDashboard'])
    ->name('staffdashboard.staffdashboard');


Route::get('/staffproduct', [WMSController::class, 'staffProducts'])
    ->name('staffdashboard.product');

Route::get('/staffproduct/{id}/edit', [WMSController::class, 'editStaffProduct'])
    ->whereNumber('id')
    ->name('staffdashboard.product.edit');

Route::put('/staffproduct/{id}', [WMSController::class, 'updateStaffProduct'])
    ->whereNumber('id')
    ->name('staffdashboard.product.update');



Route::get('/staffsupplier', [WMSController::class, 'staffSuppliers'])
    ->name('staffdashboard.supplier');

Route::get('/staffcustomer', [WMSController::class, 'staffCustomers'])
    ->name('staffdashboard.customer');



Route::get('/staffsales', [WMSController::class, 'staffSales'])
    ->name('staffdashboard.sales');

Route::post('/staffsales', [WMSController::class, 'storeSale'])
    ->name('staffdashboard.sales.store');


Route::get('/staffstock', [WMSController::class, 'staffStock'])
    ->name('staffdashboard.stock');

Route::patch('/staffstock/{id}', [WMSController::class, 'updateStaffStock'])
    ->whereNumber('id')
    ->name('staffdashboard.stock.update');

// Route::view('/staffprofile', 'staffdashboard.profile')
//     ->name('staffdashboard.profile');

Route::get('/staffprofile', [WMSController::class, 'staffProfile'])
    ->name('staffdashboard.profile');

Route::get(
    '/staffsales/customer/{customerId}/products',
    [WMSController::class, 'getCustomerEnquiryProducts']
)->name('staffdashboard.sales.customer-products');
Route::post('/customer/interest', [WMSController::class, 'storeCustomerInterest'])
    ->name('customer.interest.store');

// Login page open karva
Route::view('/login', 'login')->name('login');

// Login form submit karva
Route::post('/login', [WMSController::class, 'login'])
    ->name('login.submit');