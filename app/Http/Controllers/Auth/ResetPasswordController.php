<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showResetForm($token)
    {
        Auth::logout();
        return view('auth.reset-password', ['token' => $token]);
    }

    // Handle reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );

        // return $status === Password::PASSWORD_RESET
        //     ? redirect('/')->with('status', __($status))
        //     : back()->withErrors(['email' => __($status)]);

        if ($status === Password::PASSWORD_RESET) {
            return  redirect('/')->with('success', 'Password reset successfully!');
        } elseif ($status === Password::INVALID_TOKEN) {
            return  redirect('/')->with('error', 'This reset link has already been used or is invalid. Please request a new one.');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
