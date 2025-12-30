<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\IVRController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->group(function () {

    /**
     * =============================
     * 🔐 AUTH MODULE
     * =============================
     */
    Route::prefix('ivr')->group(function () {
        Route::post('entry', [IVRController::class, 'entry']);
        Route::post('menu', [IVRController::class, 'menu']);
        Route::post('support', [IVRController::class, 'support']);
        Route::post('sales', [IVRController::class, 'sales']);
        Route::post('support-action', [IVRController::class, 'supportAction']);
        Route::post('helpdesk', [IVRController::class, 'helpdesk']);
        Route::post('agent-connect', [IVRController::class, 'connectAgent']);
    });


    /**
     * =============================
     * 🔐 AUTH MODULE
     * =============================
     */

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('password/forgot', [AuthController::class, 'forgotPassword']);
        Route::post('password/reset', [AuthController::class, 'resetPassword']);
        Route::post('password/change', [AuthController::class, 'changePassword']);

        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refreshToken']);
            Route::get('me', [AuthController::class, 'getCurrentUserDetails']);
        });
    });


    /**
     * =============================
     * 👤 USERS MODULE
     * =============================
     */
    // Route::prefix('users')->middleware('auth:api')->group(function () {
    //     Route::get('/', [UserController::class, 'index']);
    //     Route::post('/', [UserController::class, 'store']);
    //     Route::get('{id}', [UserController::class, 'show']);
    //     Route::put('{id}', [UserController::class, 'update']);
    //     Route::delete('{id}', [UserController::class, 'destroy']);
    //     Route::post('{id}/status', [UserController::class, 'changeStatus']);
    //     Route::post('{id}/upload-picture', [UserController::class, 'updateProfilePicture']);
    //     Route::delete('{id}/remove-picture', [UserController::class, 'removeProfilePicture']);
    // });

    
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::get('{id}', [UserController::class, 'show']);
        Route::delete('{id}', [UserController::class, 'destroy']);
    });

    /**
     * =============================
     * 🧭 ROLES MODULE
     * =============================
     */
    Route::prefix('roles')->middleware('auth:api')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('{id}', [RoleController::class, 'show']);
        Route::put('{id}', [RoleController::class, 'update']);
        Route::delete('{id}', [RoleController::class, 'destroy']);
        Route::post('{id}/assign', [RoleController::class, 'assignToUser']);
    });

    /**
     * =============================
     * 🔔 NOTIFICATIONS MODULE
     * =============================
     */
    Route::prefix('notifications')->middleware('auth:api')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::get('{id}', [NotificationController::class, 'show']);
        Route::post('/', [NotificationController::class, 'store']);
        Route::post('{id}/mark-read', [NotificationController::class, 'markAsRead']);
        Route::post('mark-all-read', [NotificationController::class, 'markAllAsRead']);
        Route::delete('{id}', [NotificationController::class, 'destroy']);
    });


    /**
     * =============================
     * 📰 POSTS MODULE
     * =============================
     */
    Route::prefix('posts')->middleware('auth:api')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::get('{id}', [PostController::class, 'show']);
        Route::put('{id}', [PostController::class, 'update']);
        Route::delete('{id}', [PostController::class, 'destroy']);
        Route::post('{id}/like', [PostController::class, 'like']);
        Route::post('{id}/dislike', [PostController::class, 'dislike']);
        Route::get('{id}/comments', [PostController::class, 'comments']);
    });


    /**
     * =============================
     * 💬 COMMENTS MODULE
     * =============================
     */
    Route::prefix('comments')->middleware('auth:api')->group(function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::post('/', [CommentController::class, 'store']);
        Route::get('{id}', [CommentController::class, 'show']);
        Route::put('{id}', [CommentController::class, 'update']);
        Route::delete('{id}', [CommentController::class, 'destroy']);
    });

    /**
     * =============================
     * 🛍️ PRODUCTS MODULE
     * =============================
     */
    Route::prefix('products')->middleware('auth:api')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('{id}', [ProductController::class, 'show']);
        Route::put('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
        Route::post('{id}/upload-image', [ProductController::class, 'uploadImage']);
        Route::delete('{id}/remove-image', [ProductController::class, 'removeImage']);
    });

    /**
     * =============================
     * 🏷️ PRODUCT CATEGORIES MODULE
     * =============================
     */
    Route::prefix('product-categories')->middleware('auth:api')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index']);
        Route::post('/', [ProductCategoryController::class, 'store']);
        Route::get('{id}', [ProductCategoryController::class, 'show']);
        Route::put('{id}', [ProductCategoryController::class, 'update']);
        Route::delete('{id}', [ProductCategoryController::class, 'destroy']);
    });

    /**
     * =============================
     * 📦 ORDERS MODULE
     * =============================
     */
    Route::prefix('orders')->middleware('auth:api')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('{id}', [OrderController::class, 'show']);
        Route::put('{id}', [OrderController::class, 'update']);
        Route::delete('{id}', [OrderController::class, 'destroy']);
        Route::get('{id}/items', [OrderController::class, 'orderItems']);
    });

    /**
     * =============================
     * 🧾 ORDER ITEMS MODULE
     * =============================
     */
    Route::prefix('order-items')->middleware('auth:api')->group(function () {
        Route::get('/', [OrderItemController::class, 'index']);
        Route::post('/', [OrderItemController::class, 'store']);
        Route::get('{id}', [OrderItemController::class, 'show']);
        Route::put('{id}', [OrderItemController::class, 'update']);
        Route::delete('{id}', [OrderItemController::class, 'destroy']);
    });

    /**
     * =============================
     * 🛒 CART & CART ITEMS MODULE
     * =============================
     */
    Route::prefix('carts')->middleware('auth:api')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
        Route::get('{id}', [CartController::class, 'show']);
        Route::delete('{id}', [CartController::class, 'destroy']);
    });

    Route::prefix('cart-items')->middleware('auth:api')->group(function () {
        Route::get('/', [CartItemController::class, 'index']);
        Route::post('/', [CartItemController::class, 'store']);
        Route::put('{id}', [CartItemController::class, 'update']);
        Route::delete('{id}', [CartItemController::class, 'destroy']);
    });

    /**
     * =============================
     * 💳 PAYMENTS MODULE
     * =============================
     */
    Route::prefix('payments')->middleware('auth:api')->group(function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::get('{id}', [PaymentController::class, 'show']);
        Route::put('{id}', [PaymentController::class, 'update']);
        Route::delete('{id}', [PaymentController::class, 'destroy']);
    });

    /**
     * =============================
     * 🧾 PAYMENT HISTORY MODULE
     * =============================
     */
    Route::prefix('payment-history')->middleware('auth:api')->group(function () {
        Route::get('/', [PaymentHistoryController::class, 'index']);
        Route::get('{id}', [PaymentHistoryController::class, 'show']);
    });

    /**
     * =============================
     * 📁 FILES MODULE
     * =============================
     */
    Route::prefix('files')->middleware('auth:api')->group(function () {
        Route::get('/', [FileController::class, 'index']);
        Route::post('/', [FileController::class, 'store']);
        Route::get('{id}', [FileController::class, 'show']);
        Route::delete('{id}', [FileController::class, 'destroy']);
    });

    /**
     * =============================
     * 📷 ALBUMS & PHOTOS MODULE
     * =============================
     */
    Route::prefix('albums')->middleware('auth:api')->group(function () {
        Route::get('/', [AlbumController::class, 'index']);
        Route::post('/', [AlbumController::class, 'store']);
        Route::get('{id}', [AlbumController::class, 'show']);
        Route::delete('{id}', [AlbumController::class, 'destroy']);
    });

    Route::prefix('photos')->middleware('auth:api')->group(function () {
        Route::get('/', [PhotoController::class, 'index']);
        Route::post('/', [PhotoController::class, 'store']);
        Route::delete('{id}', [PhotoController::class, 'destroy']);
    });

    /**
     * =============================
     * 🧠 QUOTES, TODOS, RECIPES, LIKES, DISLIKES
     * =============================
     */
    Route::prefix('quotes')->middleware('auth:api')->group(function () {
        Route::get('/', [QuoteController::class, 'index']);
        Route::post('/', [QuoteController::class, 'store']);
    });

    Route::prefix('todos')->middleware('auth:api')->group(function () {
        Route::get('/', [TodoController::class, 'index']);
        Route::post('/', [TodoController::class, 'store']);
        Route::put('{id}', [TodoController::class, 'update']);
        Route::delete('{id}', [TodoController::class, 'destroy']);
    });

    Route::prefix('recipes')->middleware('auth:api')->group(function () {
        Route::get('/', [RecipeController::class, 'index']);
        Route::post('/', [RecipeController::class, 'store']);
    });

    Route::prefix('likes')->middleware('auth:api')->group(function () {
        Route::get('/', [LikeController::class, 'index']);
        Route::post('/', [LikeController::class, 'store']);
        Route::delete('{id}', [LikeController::class, 'destroy']);
    });

    Route::prefix('dislikes')->middleware('auth:api')->group(function () {
        Route::get('/', [DislikeController::class, 'index']);
        Route::post('/', [DislikeController::class, 'store']);
        Route::delete('{id}', [DislikeController::class, 'destroy']);
    });

    /**
     * =============================
     * 👤 PROFILE MODULE
     * =============================
     */

    Route::prefix('profile')->middleware('auth:api')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('/upload-picture', [ProfileController::class, 'uploadPicture']);
    });

    /**
     * =============================
     * 👤 SETTINGS MODULE
     * =============================
     */

    Route::prefix('settings')->middleware('auth:api')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::put('/', [SettingController::class, 'update']);
    });

});



Route::prefix('v2')->group(function () {

    Route::get('/', function (Request $request) {
        return "Welcome To Learn Apis";
    });

    // Route::prefix('module-name')->middleware('auth:api')->group(function () {
    //     Route::get('/', 'index');
    //     Route::post('/', 'store');
    //     Route::get('{id}', 'show');
    //     Route::put('{id}', 'update');
    //     Route::delete('{id}', 'destroy');
    //     // custom endpoints here
    // });


    // Media Types    All Image  Audio Video 
    // Media Assets Collection   Collection 1, Collection 2, Collection 3,Collection 4 
    
    




});