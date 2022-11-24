<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function forget()
    {
        return view('Auth.forget_password');
    }
    public function sendMail(Request $req)
    {
        // dd($req->all());
        // try {
            $user = User::where('email', $req->emailRe)->firstOrFail();
            $passwordReset = PasswordReset::updateOrCreate(
                [
                    'email' => $user->email,
                ], 
                [
                    'token' => Str::random(60),
                ]
            );

            if ($passwordReset) {
                $user->notify(new ResetPasswordRequest($passwordReset->token));
            }
    
            return response()->json(
                [
                    'message' => 'We have e-mailed your password reset link!'
                ]
            );
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }

    public function resetPage( $token )
    {
        return view('Auth.reset_password')->with(['token' => $token]);
    }

    public function reset(Request $req, $token)
    {
        // try {
            $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
            if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                $passwordReset->delete();

                return response()->json(
                    [
                        'message' => 'This password reset token is invalid.',
                    ],
                    422
                );
            }
            $user = User::where('email', $passwordReset->email)->firstOrFail();
            $user->update(
                [
                    'password' => Hash::make($req->repass)
                ]
            );
            $passwordReset->delete();

            return response()->json(
                [
                    'message' => 'Thay đổi mật khẩu thành công',
                ]
            );
        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }
}
