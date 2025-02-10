<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfrmCreateOrdersController;
use App\Http\Controllers\PackagingOrderController;
use App\Http\Controllers\SearchForms;
use Illuminate\Support\Facades\Route;



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


// Route::get('test', function () {
//     return view('test');
// });



Route::match(['get', 'post'], '/', [Controller::class, 'login'])->name('login');


Route::middleware(['auth', 'auth.session'])->group(function () {

    Route::get('/logout', [Controller::class, 'logout'])->name('logout');
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');

    // reset password
    Route::match(['get', 'post'], '/reset/password', [Controller::class, 'resetPassword'])->name('reset.password');

    Route::prefix('user')->group(function () {
        //Register new user route
        Route::match(['get', 'post'], '/register', [Controller::class, 'registerNewUser'])->name('register.user')->middleware('can:User-create');
        //fetch all users
        Route::get('/list', [Controller::class, 'userList'])->name('list.user')->middleware('can:User-read');
    });


    //profile
    Route::match(['get', 'post'], '/profile', [Controller::class, 'profile'])->name('profile');



    // Spatie roles Permissions routes
    Route::name('admin.')->group(function () {

        Route::resource('/roles', RoleController::class);
        Route::post('/roles/{role}/permissions/updateAll', [RoleController::class, 'updateAllPermissions'])
            ->name('roles.permissions.updateAll');

        Route::resource('/permissions', PermissionController::class);
        Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

        Route::get('/users', [UserRoleController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserRoleController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [UserRoleController::class, 'destroy'])->name('users.destroy')->middleware('can:User-delete');

        Route::post('/role/{user}/assign/all', [UserRoleController::class, 'UserRoleUpdatedAll'])->name('user.role.updateAll');
        Route::post('/permissions/{user}/assign/all', [UserRoleController::class, 'UserPermissionUpdateAll'])->name('user.permissions.updateAll');
    });




    Route::prefix('packaging/order')->group(function () {

        // Packaging Orders Routes
        Route::get('/new', [PackagingOrderController::class, 'create'])->name('newPackagingOrderForm')->middleware('can:PackagingOrder-create');
        Route::post('/store', [PackagingOrderController::class, 'store'])->name('packagingOrderSubmit')->middleware('can:PackagingOrder-create');
        //master batch record view
        Route::get('/master/view', [PackagingOrderController::class, 'index'])->name('viewPackaginingOrders')->middleware('can:PackagingOrder-read');
        // duplicate batch record view
        Route::get('/duplicate/view', [PackagingOrderController::class, 'viewDuplicatePackagingOrder'])->name('viewDuplicatePackagingOrder')->middleware('can:DuplicatePackagingOrder-read');

        // upload oder record form excel
        Route::get('/upload/form', [PackagingOrderController::class, 'uploadOrderRecordForm'])->name('uploadOrderRecordForm')->middleware('can:PackagingOrder-create');
        Route::post('/upload', [PackagingOrderController::class, 'uploadOrderRecord'])->name('uploadOrderRecord')->middleware('can:PackagingOrder-create');
        // search packaging order for update order
        Route::get('/search', [PackagingOrderController::class, 'searchPackagingOrder'])->name('searchPackagingOrder');
        //edit packaging order
        Route::get('/editr', [PackagingOrderController::class, 'edit'])->name('EditPackagingOrder');
        //Updatepackaging order
        Route::post('/{packagingOrder}/update', [PackagingOrderController::class, 'update'])->name('updatePackagingOrder')->middleware('can:PackagingOrder-update');
        //Print order form
        Route::get('/print', [PackagingOrderController::class, 'printOrder'])->name('printOrder')->middleware('can:PackagingOrder-read');
        // search pritn order from order id
        Route::get('/print/search', [PackagingOrderController::class, 'searchPrintOrder'])->name('searchPrintOrder');
    });


    Route::prefix('customer')->group(function () {

        Route::get('/form', [CustomerController::class, 'create'])->name('newCustomerForm')->middleware('can:Customer-create');
        Route::post('/store', [CustomerController::class, 'store'])->name('storeCustomer')->middleware('can:Customer-create');
        Route::get('/index', [CustomerController::class, 'index'])->name('customer.index')->middleware('can:Customer-read');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('can:Customer-update');
        Route::post('/{customer}/update', [CustomerController::class, 'update'])->name('customer.update')->middleware('can:Customer-update');;
        Route::delete('/{customer}/delete', [CustomerController::class, 'destroy'])->name('customer.delete')->middleware('can:Customer-delete');
        // upload customer form excel sheet
        Route::get('/upload/excel', [CustomerController::class, 'uploadCustomerExcelForm'])->name('upload.customer.excel')->middleware('can:Customer-create');
        Route::post('/upload/excel', [CustomerController::class, 'uploadCustomerExcel'])->name('uploadCustomerExcel')->middleware('can:Customer-create');

        // fetch customer record when select customer id uisng ajax
        Route::get('/{id}', [CustomerController::class, 'getCustomerById'])->name('customer.get');
    });



    Route::prefix('audit')->group(function () {

        Route::get('/changeControlForm', [AuditController::class, 'changeControlForm'])->name('changeControlForm')->middleware('can:Search-change_Control_Form');
        Route::post('/PackagingOrder', [AuditController::class, 'chnageControlePackagingOrder'])->name('chnageControlePackagingOrder')->middleware('can:Search-change_Control_Form');

        // auidt logs of all projects
        Route::get('/log/report', [AuditController::class, 'AuditLogReport'])->name('AuditLogReport')->middleware('can:Default-audit');
        Route::get('/report/generate', [AuditController::class, 'generateAuditReport'])->name('generateAuditReport')->middleware('can:Default-audit');
    });


    Route::prefix('Search/Form/')->middleware('can:Default-SearchForms')->group(function () {
        Route::get('/Inspection2-3-5', [SearchForms::class, 'inspection235'])->name('inspection2-3-5');

        Route::get('/materialTransfer4', [SearchForms::class, 'materialTransfer4'])->name('materialTransfer4'); // open page
        Route::get('/materialTranfer4Print', [SearchForms::class, 'materialTranfer4Print'])->name('materialTranfer4Print'); // select order and getch data
        Route::get('/materialTransfer4.1', [SearchForms::class, 'materialTransfer4_1'])->name('materialTransfer4.1');

        Route::get('/inspection6-8-10', [SearchForms::class, 'inspection6_8_10'])->name('inspection6-8-10');
        Route::post('/inspection_6_8_10_Print', [SearchForms::class, 'inspection_6_8_10_Print'])->name('inspection_6_8_10_Print');

        Route::get('/inspection11-12', [SearchForms::class, 'inspection11_12'])->name('inspection11-12');
        Route::post('/inspection11_12_Print', [SearchForms::class, 'inspection11_12_Print'])->name('inspection11_12_Print');

        Route::get('/inspection_scale_weight_printed', [SearchForms::class, 'inspection_scale_weight_printed'])->name('inspection_scale_weight_printed');

        Route::get('/inspection_7_13', [SearchForms::class, 'inspection_7_13'])->name('inspection_7_13');
        Route::post('/inspection_7_13_print', [SearchForms::class, 'inspection_7_13_print'])->name('inspection_7_13_print');

        Route::get('/a_Inspection', [SearchForms::class, 'a_Inspection'])->name('a_Inspection');

        Route::get('/b_material_warehouse', [SearchForms::class, 'b_material_warehouse'])->name('b_material_warehouse');
        Route::post('/b_material_warehouse_print', [SearchForms::class, 'b_material_warehouse_print'])->name('b_material_warehouse_print');

        Route::get('/visionSetupChallenge', [SearchForms::class, 'visionSetupChallenge'])->name('visionSetupChallenge');
        Route::get('/warehouseMaterial', [SearchForms::class, 'warehouseMaterial'])->name('warehouseMaterial');
        Route::get('/productSpecification', [SearchForms::class, 'productSpecification'])->name('productSpecification');

        Route::get('Search/order', [SearchForms::class, 'searchDuplicatePackagingOrder'])->name('searchDuplicatePackagingOrder');
        Route::get('/Edit/order', [SearchForms::class, 'EditDuplicatePackagingOrder'])->name('EditDuplicatePackagingOrder');
        Route::post('/{DuplicatePackagingOrder}/update', [SearchForms::class, 'updateDuplicatePackagingOrder'])->name('updateDuplicatePackagingOrder');


        // print all forms on single click....
        Route::get('print/AllForms', [SearchForms::class, 'printAllForms'])->name('printAllForms');
        Route::get('Print/AllForms/Fetch', [SearchForms::class, 'PrintAllFormsFetch'])->name('PrintAllFormsFetch');

        //ajax
        Route::post('/fetch-packaging-order-details', [SearchForms::class, 'fetchPackagingOrderDetails'])->name('fetchPackagingOrderDetails');
        // fetch Duplicate Packaging OrderDetails using ajax
        Route::post('/fetch-duplicate-packaging-order-details', [SearchForms::class, 'fetchDuplicatePackagingOrderDetails'])->name('fetchDuplicatePackagingOrderDetails');
    });

    Route::prefix('SelectOrderTemplate')->middleware('can:Default-ofrmCreateOrders')->group(function () {

        Route::get('/order', [OfrmCreateOrdersController::class, 'OfrmCreateOrders'])->name('OfrmCreateOrders');
        Route::get('/TemplateSub', [OfrmCreateOrdersController::class, 'TemplateSubmit'])->name('TemplateSubmit');
        Route::post('/saveNewTemplateRecord', [OfrmCreateOrdersController::class, 'saveNewTemplateRecord'])->name('saveNewTemplateRecord');
    });
});
