<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function register(Request $request) {
        dd($request->all());
    }

    public function signIn(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::guard('admin')->user();
            // $accessToken = $user->createToken('MemberAuthToken')->accessToken;
            return response([
                'message' => 'success',
                'status' => true,
                'description' => 'Sign-In Successfully!',
                'user_name' => $user,
            ], 200);
        } else {
            return response([
                'message' => 'error',
                'status' => false,
                'description' => 'Authorization failed!'
            ], 401);
        }
    }

    public function onLogout(Request $request)
    {
        try {
            Auth::guard('admin')->logout();
            return response([
                'message' => 'ok',
                'description' => 'You have successfully logged out.',
                'status' => true,
            ], 200);
        } catch (Exception $e) {
            return response([
                'message' => 'error',
                'description' => 'Logging out failed!',
                'errorMessage' => $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }
}
