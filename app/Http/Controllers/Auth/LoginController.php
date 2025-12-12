<?php

namespace App\Http\Controllers\Auth;

use Hash;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesMobileUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    // use AuthenticatesMobileUsers;

    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => "Validation errors",
                'errors'  => $validator->errors()
            ], 422);
        }

        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_id';

        $deviceId = $request->header('Device-Id');
        if (!$deviceId) {
            return response()->json([
                'status'  => false,
                'message' => "Device Id not found!"
            ], 401);
        }



        $deviceExists  = Member::where('device_id', $deviceId)->exists();

        if (!$deviceExists) {
            return response()->json([
                'status'  => false,
                'message' => "Device Id Not Matched!"
            ], 401);
        }

        $user = User::where($field, $request->login)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => "Invalid login credentials"
            ], 401);
        }

        $token = $user->createToken("mobile-app-token")->plainTextToken;

        return response()->json([
            'status'  => true,
            'message' => "Login successful",
            'token'   => $token,
            'user'    => $user,
        ], 200);
    }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
