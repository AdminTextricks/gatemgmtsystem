<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    //Member form post request
    public function member_post_action(Request $request)
    {
        $userId = 'user';
        $validator = Validator::make($request->all(), [
            'email'   => 'required|unique:users,email,' . $request->edit_id,
            'mobile' => 'required|digits:10',
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
            if(empty($member)){
                 return response()->json([
                "status" => false,
                "message" => "User not found",
            ], 422);
            }
            $role = 'member';
            $firstName = explode(' ', trim($member->name))[0];
            $userId = $firstName . substr($member->mobile, 0, 4);
        } 
       
        //Send OTP on user email id

        $otp = rand(100000, 999999);

        if(!empty($member->email)){
            $otpData=OtpCode::create([
            'user_id'   => $userId,
            'otp'       => $otp,
            'email'       => $member->email,
            'status'       => 'pending',
            'expires_at' => Carbon::now()->addMinutes(5),
        ]);
        }
        // Send email
        if (!empty($otpData)) {
            Mail::raw("Your OTP is: $otp", function ($message) use ($member) {
                $message->to($member->email)
                    ->subject('Email Verification OTP');
            });
        }


        return response()->json([
            'status'  => true,
            'message' => 'Your OTP sent to email.',
        ]);

     
    }


}
