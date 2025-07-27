<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login', [AdminController::class, 'index'])->name('login');

Route::prefix('menu')->middleware(['is_staff'])->group(function () {

    Route::get('/order', [AdminController::class , 'orderPage'])->name('orderPage');
    Route::get('/add', [AdminController::class , 'addPage'])->name('addPage');
    Route::get('/edit', [AdminController::class , 'editPage'])->name('editPage');
    Route::get('/seeAll', [AdminController::class , 'allOrderPage'])->name('allOrderPage');
    Route::get('/edit/{id}', [AdminController::class, 'editForm'])->name('editForm');
    Route::get('/summary', [AdminController::class , 'summaryPage'])->name('summaryPage');
    Route::get('/payment', [AdminController::class , 'paymentPage'])->name('paymentPage');
    Route::post('/createOrder', [OrderController::class , 'createOrder'])->name('createOrder');
    Route::get('/order/{id}', [OrderController::class , 'detailOrderPage'])->name('detailOrderPage');
});

Route::post('/addMenu', [AdminController::class, 'addMenu'])->name('addMenu');
Route::post('/add-to-cart', [OrderController::class, 'addToCart'])->name('addToCart');
Route::post('/clear-cart', [OrderController::class, 'clearCart'])->name('clearCart');


Route::get('/dashboard', [OrderController::class , 'dashboardPage'])->name("dashboardPage");


Route::prefix('member')->middleware(['is_staff'])->group(function(): void{

    Route::get('/' , [UserController::class , 'memberPage'])->name('memberPage');
    Route::get('/create' , [UserController::class , 'addMemberPage'])->name('addMember');
    Route::post('/addMember' , [UserController::class , 'addMember'])->name('addMemForm');
    Route::get('/edit/{id}' , [UserController::class , 'editMemberForm'])->name('editMemberForm');
    Route::post('/delete/{id}' , [UserController::class , 'deleteMember'])->name('deleteMember');

});


Route::post('/filter/dashboard' , [OrderController::class , 'filterDashboard'])->name('filterDashboard');




Route::get('/cart/remove/{index}', function (\Illuminate\Http\Request $request , $index) {
    $cart = session('cart', []);
    
 
    if (isset($cart[$index])) {
        if($cart[$index]->quantity == 1){
            unset($cart[$index]);
        }else{
            $cart[$index]->quantity --;
        }
        session(['cart' => array_values($cart)]);
    }
    
    response()->json(['status' => 'success']);
    return redirect()->back();
})->name('removeCart');


