<?php

use App\Http\Controllers\API\Client\AuthController;
use App\Http\Controllers\API\Client\BookController;
use App\Http\Controllers\API\Client\CategoryController;
use App\Http\Controllers\API\Client\FileUploadController;
use App\Http\Controllers\API\Client\PushNotificationController;
use App\Http\Controllers\API\Client\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum', 'validate.user']], function () {
    Route::post('categories', [CategoryController::class, 'store'])
        ->name('category.store')
        ->middleware(['permission:create_category']);
    Route::get('categories', [CategoryController::class, 'index'])
        ->name('categories.index')
        ->middleware(['permission:read_category']);
    Route::get('categories/{category}', [CategoryController::class, 'show'])
        ->name('category.show')
        ->middleware(['permission:read_category']);
    Route::put('categories/{category}', [CategoryController::class, 'update'])
        ->name('category.update')
        ->middleware(['permission:update_category']);
    Route::delete('categories/{category}', [CategoryController::class, 'delete'])
        ->name('category.delete')
        ->middleware(['permission:delete_category']);
    Route::post('categories/bulk-create', [CategoryController::class, 'bulkStore'])
        ->name('category.store.bulk')
        ->middleware(['permission:create_category']);
    Route::post('categories/bulk-update', [CategoryController::class, 'bulkUpdate'])
        ->name('category.update.bulk')
        ->middleware(['permission:update_category']);

    Route::post('books', [BookController::class, 'store'])
        ->name('book.store')
        ->middleware(['permission:create_book']);
    Route::get('books', [BookController::class, 'index'])
        ->name('books.index')
        ->middleware(['permission:read_book']);
    Route::get('books/{book}', [BookController::class, 'show'])
        ->name('book.show')
        ->middleware(['permission:read_book']);
    Route::put('books/{book}', [BookController::class, 'update'])
        ->name('book.update')
        ->middleware(['permission:update_book']);
    Route::delete('books/{book}', [BookController::class, 'delete'])
        ->name('book.delete')
        ->middleware(['permission:delete_book']);
    Route::post('books/bulk-create', [BookController::class, 'bulkStore'])
        ->name('book.store.bulk')
        ->middleware(['permission:create_book']);
    Route::post('books/bulk-update', [BookController::class, 'bulkUpdate'])
        ->name('book.update.bulk')
        ->middleware(['permission:update_book']);

    Route::post('users', [UserController::class, 'store'])
        ->name('user.store')
        ->middleware(['permission:create_user']);
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware(['permission:read_user']);
    Route::get('users/{user}', [UserController::class, 'show'])
        ->name('user.show')
        ->middleware(['permission:read_user']);
    Route::put('users/{user}', [UserController::class, 'update'])
        ->name('user.update')
        ->middleware(['permission:update_user']);
    Route::delete('users/{user}', [UserController::class, 'delete'])
        ->name('user.delete')
        ->middleware(['permission:delete_user']);
    Route::post('users/bulk-create', [UserController::class, 'bulkStore'])
        ->name('user.store.bulk')
        ->middleware(['permission:create_user']);
    Route::post('users/bulk-update', [UserController::class, 'bulkUpdate'])
        ->name('user.update.bulk')
        ->middleware(['permission:update_user']);

    Route::get('activity-logs', [ActivityLogController::class, 'index'])
        ->name('activity-logs.index');
});

Route::post('file-upload', [FileUploadController::class, 'upload'])
    ->name('file.upload');

Route::post('push-notifications/add-device-id', [PushNotificationController::class, 'store'])
    ->name('pushNotification.add-device');
Route::post('push-notifications/remove-device-id', [PushNotificationController::class, 'removeDeviceId'])
    ->name('pushNotification.remove-device');

Route::post('register', [AuthController::class, 'register'])
    ->name('register');
Route::post('login', [AuthController::class, 'login'])
    ->name('login');
Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:sanctum');
Route::put('change-password', [AuthController::class, 'changePassword'])
    ->name('change.password')
    ->middleware(['auth:sanctum', 'validate.user']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password');
Route::post('validate-otp', [AuthController::class, 'validateResetPasswordOtp'])
    ->name('reset.password.validate.otp');
Route::put('reset-password', [AuthController::class, 'resetPassword'])
    ->name('reset.password');
