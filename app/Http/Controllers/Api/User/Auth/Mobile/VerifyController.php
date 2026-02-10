<?php

namespace App\Http\Controllers\Api\User\Auth\Mobile;

use App\Events\VerificationRequire;
use app\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class VerifyController extends Controller
{
    public function update(Request $request)
    {
        $user = User::findorfail(Auth::id());
        $token = Str::random(8);
        $user->update(["email_verification_token" => Hash::make($token), "email_verification_token_expires_at" => now()->addMinute((int)config("verification.expire_time"))]); //use env
        event(new VerificationRequire($user, $token, "user"));
        return ApiResponse::SendResponse(200, "we sent a new verify link check your email");
    }
    public function verifyUser(Request $request)
    {
        $user = User::findorfail(Auth::id());
        $expireAt = $user->email_verification_token_expires_at;
        $isNotExpire = now()->lessThanOrEqualTo($expireAt);
        if (Hash::check($request->token, $user->email_verification_token) && $isNotExpire) {
            $user->update(["email_verified_at" => now()]);
            return ApiResponse::SendResponse(200, "your account verified successfully");
        } else {
            return ApiResponse::SendResponse(200, "your code is incorrect or your verified link expired");
        }
    }
}
