<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OtpCodeController extends Controller
{
    public function verifyMobileByOTP(Request $request)
    {
        $userId = 'user';
        $role = '';
        $data = [];
        $member = [];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|exists:members',
            'otp' => 'required|numeric|digits:6',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|string|min:6|confirmed',
            // 'user_id'  => 'nullable|exists:users,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!empty($request->mobile) && !empty($request->header('Device-Id'))) {
            $member = Member::where('mobile', $request->mobile)->first();
            $role = 'member';
            $firstName = explode(' ', trim($member->name))[0];
            $userId = $firstName . substr($member->mobile, 0, 4);
            $otpData = OtpCode::where('otp', $request->otp)
                ->where('email', $request->email)->where('status', 'pending')->first();
        }


        if (!$otpData) {
            return $this->output(false, 'You entered wrong OTP.', [], 409);

        } elseif (Carbon::now()->greaterThan($otpData->expires_at)) {
            return response()->json([
                'status' => false,
                'message' => 'Your OTP has been Expired!'
            ], 410);
            $otpRecord->update([
                'status' => 'used',
            ]);
            
        } else {

            $data = [
                'user_id' => $userId,
                'email' => $member->email,
                'email_verified_at' => now(),
                'role' => $role,
                'name' => $member->name,
            ];


            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }

            User::updateOrCreate(['id' => $request->edit_id], $data);

            $member->device_id = $request->header('Device-Id');
            $member->save();

            if (!empty($request->mobile)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Member Created Successfully',
                ], 201);
            }
        }


        // return $this->output(true, 'Mobile has been verified.', [], 202);
    }
}
