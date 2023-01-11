<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
// User Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Cart & Wish
    Route::get('add_to_wishs/{id}', [GeneralController::class, "add_to_wishs"])->name("add_wish");
    Route::get('wishes', [GeneralController::class, "wishes"])->name("wishes");
    Route::get('delete_wish/{id}', [GeneralController::class, "delete_wish"])->name("delete_wish");
    Route::get("cart", [GeneralController::class, "cart"])->name("cart");
    Route::get("add_cart/{id}", [GeneralController::class, "add_cart"])->name("add_cart");
    Route::get("delete_cart/{id}", [GeneralController::class, "delete_cart"])->name("delete_cart");
    Route::get("update_qtn/{id}", [GeneralController::class, "update_qtn"])->name("update_qtn");
    // Checkout
    Route::get("delivary", [GeneralController::class, "delivary"])->name("delivary");
    Route::post("on_delivary", [GeneralController::class, "on_delivary"])->name("on_delivary");
    Route::get('credit_card', [StripeController::class, 'credit_card'])->name("credit_card");
    Route::post('CompletePayment', [StripeController::class, 'CompletePayment'])->name('stripe.post');
    Route::get('like/{id}', function ($id) {
        $product = Product::find($id);
        $product->update([
            "likes" => $product->likes + 1
        ]);
        return redirect()->back();
    })->name("likes");
});

// Admin Routes
Route::middleware("check")->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/read/{type}', function ($type) {
        DB::table("notifications")->where('type', $type)
            ->orWhere('type', 'like', '%' . $type . '%')->delete();
        return back();
    })->name('read');
    // Products
    Route::get("allProd", [ProductController::class, "index"])->name("adProd.index");
    Route::get("create", [ProductController::class, "create"])->name("adProd.create");
    Route::post("store", [ProductController::class, "store"])->name("adProd.store");
    Route::get("show/{id}", [ProductController::class, "show"])->name("adProd.show");
    Route::get("update/{id}", [ProductController::class, "update"])->name("adProd.update");
    Route::get("/delProd/{id}", [ProductController::class, "delProd"])->name("delProd");
    // Order
    Route::get("/orders/{type}", [OrderController::class, "orders"])->name("orders");
    Route::get("/update_order", [OrderController::class, "update_order"])->name("update_order");
    Route::get("/delete_order/{id}", [OrderController::class, "delete_order"])->name("delete_order");
    // Messages
    Route::get("/messages", [MessageController::class, "show"])->name("admin.messages");
    Route::post("/search_admin", [GeneralController::class, "search_admin"])->name("search_admin");
});
// Guest Routes
Route::get('/', function () {
    $products =  DB::table('products')
        ->orderBy('created_at', 'desc')
        ->limit(6)->get();
    return view('home', ["products" => $products]);
})->name("UI");
Route::get('products', function () {
    $products = Product::paginate(6);
    return view('products', ["products" => $products]);
})->name("prods");
Route::post('contact', [MessageController::class, "store"])->name("message.store");
require __DIR__ . '/auth.php';
