<?php

namespace App\Http\Controllers\Api\User\Auth\Web;

use app\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $validator = Validator::make(
            [
                'email' => $request->email,
                'password' => $request->password,
            ],
            [
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
            ]
        );

        if ($validator->fails()) {
            return ApiResponse::SendResponse(422, "validation error", $validator->errors());
        }


        $user = User::where('email', $request->email)->first();

        if (Auth::guard("user")->attempt(["email" => $request->email, "password" => $request->password], (bool)$request->remember)) {
            $request->session()->regenerate();
            $data = [
                "name" => $user->name,
                "email" => $user->email,
            ];
            return ApiResponse::SendResponse(200, "user logged in successfully", $data);
        } else {
            return ApiResponse::SendResponse(401, "email or password is not correct");
        }
    }
}
