<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:8',
            'role'=>'nullable|in:seeker,company,admin',
        ]);

        $otp= rand(100000,999999);

        $user =User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'email_verification_code'=>$otp,
            'email_verification_expires_at'=>now()->addMinute(15),
            'role' => $request->role ?? 'seeker',


        ]);

        Mail::to($user->email)->send(new VerifyEmailOtpMail($otp));

        return response()->json([
            'message'=>'User created. Verfication code send to mail',
        ],201);

    }

    public function verifyEmail(Request $request){

        $request->validate([
            'email'=>'required|email',
            'code'=>'required|digits`:6'
        ]);

        $user = User::where('email' ,$request->email)->first();

        if(!$user){
            return response()->json(['error'=>'user not found'],404);
        }

        if($user->email_verification_code != $request->code){
            return response()->json(['error'=>'email not verified'],422);
        }

        if(now()->greaterThan($user->email_verification_expires_at)){
            return response()->json(['error'=>'Verfication code expired'],422);
        }

        $user->email_verified_at= now();
        $user->email_verification_code=null;
        $user->email_verification_expires_at= null;
        $user->save();

        return response()->json([
            'message'=>'Email verified successefully'
        ]);

    }
}
