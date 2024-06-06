<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Components\ProductController as ComponentProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Components\CategoryController as ComponentCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/new', [NewsController::class, 'index'])->name('news');
Route::get('/new/{id}', [NewsController::class, 'news_detail'])->name('news_detail');

Route::get('/verify/{token_verify}', [UserController::class, 'verify'])->name('verifyEmail');

Route::prefix('customer')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'post_login']);
    
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'post_register']);
    
    
    
    Route::get('/forgot_pass', [UserController::class, 'forgot'])->name('forgot_pass');
    Route::post('/forgot_pass', [UserController::class, 'post_forgot'])->name('forgot_pass');
    Route::get('/reset_pass/{token}', [UserController::class, 'reset_pass'])->name('reset_pass');
    Route::post('/reset_pass/{token}', [UserController::class, 'post_resetPass']);
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::prefix('product')->group(function(){
    Route::get('/list', [ComponentProductController::class, 'listproduct'])->name('product-list');//danh sách sản phẩm
    Route::get('/{id}', [ComponentProductController::class, 'product_detail'])->name('product');//chi tiết sản phẩm
    Route::post('/search', [ComponentProductController::class, 'searchProduct'])->name('search-product');

    Route::get('/category/{id}', [ComponentCategoryController::class, 'product_cate'])->name('category-product');//Sản phẩm theo danh mục

});

Route::middleware('user')->group(function () {
    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/change_pass', [ProfileController::class, 'change_pass'])->name('profile.change_pass');
    });

    Route::prefix('wishlist')->group(function(){
        Route::get('/', [WishlistController::class, 'index'])->name('wish.index');
        Route::get('/add/{product}', [WishlistController::class, 'add'])->name('wish.add');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/update', [CartController::class, 'update'])->name('cart.update');
        Route::get('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    });
    
    Route::prefix('order')->group(function(){
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('order.checkout');
        Route::post('/checkout', [CheckoutController::class, 'post_checkout']);
        Route::get('/paymentOnline', [CheckOutController::class, 'paymentOnline'])->name('paymentOnline');
        Route::get('/delete/{id}', [CheckoutController::class, 'delete'])->name('order.delete');

        Route::patch('/delete', [OrderController::class, 'deleteOrder'])->name('deleteOrder');
        Route::patch('/success', [OrderController::class, 'successOrder'])->name('successOrder');
        Route::get('/detail/{order_id}', [OrderDetailController::class, 'index'])->name('order.detail');
    });

    Route::post('/comment', [CommentController::class, 'add'])->name('add_comment');
});


Route::get('/admin', [AuthController::class, 'login_admin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'post_login_admin']);
Route::get('/admin/logout', [AuthController::class, 'logout_admin'])->name('admin.logout');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::prefix('products')->group(function(){
        Route::get('/list', [ProductController::class, 'list'])->name('product.list');
        Route::get('/add', [ProductController::class, 'add'])->name('product.add');
        Route::post('/add', [ProductController::class, 'post_add']);
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/edit/{id}', [ProductController::class, 'post_edit']);
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    });

    Route::prefix('category')->group(function(){
        Route::get('/list', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/add', [CategoryController::class, 'post_add']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/edit/{id}', [CategoryController::class, 'post_edit']);
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });

    Route::prefix('account')->group(function(){
        Route::get('/list', [AccountController::class, 'list'])->name('account.list');
        Route::get('/add', [AccountController::class, 'add'])->name('account.add');
        Route::post('/add', [AccountController::class, 'post_add']);
        Route::get('/lock/{id}', [AccountController::class, 'lock'])->name('account.lock');
        Route::get('/unLock/{id}', [AccountController::class, 'unLock'])->name('account.unLock');
    });

    Route::prefix('color')->group(function(){
        Route::get('/list', [ColorController::class, 'list'])->name('color.list');
        Route::get('/add', [ColorController::class, 'add'])->name('color.add');
        Route::post('/add', [ColorController::class, 'post_add']);
        Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
        Route::post('/edit/{id}', [ColorController::class, 'post_edit']);
        Route::get('/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
    });

    Route::prefix('delivery')->group(function(){
        Route::get('/list', [DeliveryController::class, 'list'])->name('delivery.list');
        Route::get('/add', [DeliveryController::class, 'add'])->name('delivery.add');
        Route::post('/add', [DeliveryController::class, 'post_add']);
        Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
        Route::post('/edit/{id}', [DeliveryController::class, 'post_edit']);
        Route::get('/delete/{id}', [DeliveryController::class, 'delete'])->name('delivery.delete');
    });

    Route::prefix('payment')->group(function(){
        Route::get('/list', [PaymentController::class, 'list'])->name('payment.list');
        Route::get('/add', [PaymentController::class, 'add'])->name('payment.add');
        Route::post('/add', [PaymentController::class, 'post_add']);
        Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('/edit/{id}', [PaymentController::class, 'post_edit']);
        Route::get('/delete/{id}', [PaymentController::class, 'delete'])->name('payment.delete');
    });

    Route::prefix('order')->group(function(){
        Route::get('/list', [OrderController::class, 'list'])->name('order.list');
        Route::get('order/detail/{id}', [OrderController::class, 'order_detail'])->name('order_detail');
        Route::patch('order/confim', [OrderController::class, 'confirmOrder'])->name('confirmOrder');
    });

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/export-top-selling', [DashboardController::class, 'exportTopSelling'])->name('export.topSelling');
});