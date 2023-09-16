<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        dd($request->all());
    }

    public function signIn(Request $request)
    {
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

    public function onUpdateSite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_title' => 'required',
            'site_about' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            DB::beginTransaction();

            Settings::where(['id' => $request->site_id])->update([
                'site_title' => $request->site_title,
                'site_about' => $request->site_about,
            ]);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Site has been updated successfully.'
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }

    }

    public function onUpdateShutdown(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isChecked' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorValidators('Invalid params', $validator->errors());
        }

        try {
            DB::beginTransaction();

            Settings::where(['id' => $request->site_id])->update([
                'shutdown' => $request->isChecked,
            ]);

            DB::commit();
            return response([
                'message' => 'ok',
                'status' => true,
                'description' => 'Shutdown has been updated successfully.'
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response([
                'message' => 'error',
                'status' => false,
                'errorMessage' => $e->getMessage()
            ], 500);
        }

    }
}
