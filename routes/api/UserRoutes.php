<?php

use app\Helpers\ApiResponse;
use App\Http\Controllers\Api\User\Auth\Mobile\LoginController;
use App\Http\Controllers\Api\User\Auth\Mobile\LogoutController;
use App\Http\Controllers\Api\User\Auth\Mobile\PasswordController;
use App\Http\Controllers\api\User\Auth\Mobile\RegisterController;
use App\Http\Controllers\Api\User\Auth\Mobile\VerifyController;
use App\Http\Resources\User\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//guest routes
Route::prefix("user/")->as("user.")->group(function () {
    Route::post("register", RegisterController::class)->name("register");
    Route::post("login", LoginController::class)->name("login");
    Route::post("reset-password", [PasswordController::class, "sendResetLink"])->name("password.sendResetLink")->middleware("throttle:user-password-reset-links");
    Route::put("reset-password/{token}", [PasswordController::class, "update"])->name("password.update");
    Route::get("reset-password/{token}", [PasswordController::class, "getToken"])->name("password.getToken");
});

//auth but not verified routes
Route::middleware(["auth:user-api", "NotVerify:user-api"])->prefix("user/verify/")->as("user.verify.")->group(function () {
    Route::post("", [VerifyController::class, "verifyUser"])->name("verifyUser"); //from gmail
    Route::put("", [VerifyController::class, "update"])->name("update")->middleware("throttle:user-api-verification-links");
});

//auth routes
Route::middleware(["auth:user-api"])->prefix("user/")->as("user.")->group(function () {
    Route::post("logout", LogoutController::class)->name("logout");
});

//auth and verified routes
Route::middleware(["auth:user-api", "Verify:user-api"])->prefix("user/")->as("user.")->group(function () {
    Route::get("home", function () {
        $user = Auth::user();
        return ApiResponse::SendResponse(200, "welcome home", new UserResource($user));
    });
});
