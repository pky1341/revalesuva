<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use Laravel\Passport\Exceptions\OAuthServerException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "",
            "password" => ""
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LaravelAuthApp')->accessToken;

            return $this->successResponse([
                'token' => $token,
                'user' => $user,
            ], 'Login successful');
        }

        return $this->errorResponse('Unauthorized', 401);
    }

    public function logout(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return $this->errorResponse('Unauthorized: No user found.', 401);
            }

            $token = $request->user()->token();
            $token->revoke();

            return $this->successResponse('Successfully logged out.', 200);
        } catch (OAuthServerException $e) {
            return $this->errorResponse('Unauthorized: Token is invalid or expired.', 401);
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred.', 500);
        }
    }
}
