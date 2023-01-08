<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use App\Rules\CorrectPassword;
use App\Traits\CreatesVerificationCodes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAccountController extends Controller
{
    use CreatesVerificationCodes;

    function __invoke(){
        return $this->view('client.account');
    }

    function updatePassword(Request $request){
        try{
            $user = $request->user();

            $validator = validator($request->post(), [
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'same:new_password'],
                'password' => ['required', new CorrectPassword($user)],
            ],[
                'new_password.regex' => 'Password should contain at least 8 characters with at least one letter',
                'confirm_password.same' => 'Passwords do not match!'
            ]);

            if($validator->fails()){
                return back()
                    ->withInput()
                    ->withErrors($validator->errors());
            }

            // Change password
            $user->password = Hash::make($request->post('new_password'));

            if($user->save()){
                return back()
                    ->with(['status' => 'New password has been saved, next time you log in, use it']);
            }

            return back()
                ->withInput()
                ->withErrors(['status' => 'An unexpected error occurred. Password cannot be updated']);

        }catch(Exception $e){
            return back()
                ->withInput()
                ->withErrors(['status' => 'Something went wrong. Password cannot be updated']);
        }

    }

    function verifyEmail(Request $request){
        $user = $request->user('web');

        if($user->hasVerifiedEmail()){
            return redirect()->route('client.dashboard');
        }

        if($request->isMethod('GET')){
            $this->sendCodeToEmail($user);

            return $this->view('auth.verification', [
                'email' => $user->email
            ]);
        }

        // Validate the code
        if(!$request->filled('code')){
            return back()->withInput()
                ->withErrors([
                    'status' => 'Provide the verification code'
                ]);
        }

        // Check correctness
        if($this->checkVerificationCode($request->post('code'), $user, 'verification')){
            // Mark verified
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('client.dashboard')
                ->with([
                    'status' => 'Your email is now verified'
                ]);
        }

        return back()->withInput()
                ->withErrors([
                    'status' => 'The provided code is incorrect or expired'
                ]);
    }

    function resendVerificationCode(Request $request){
        $user = $request->user('web');

        if($user->hasVerifiedEmail()){
            return back()->withInput()
                ->withErrors([
                    'status' => 'Your email is already verified'
                ]);
        }

        $this->sendCodeToEmail($user);

        return back()
            ->with([
                'status' => 'The code has been sent to your email'
            ]);
    }

    function sendCodeToEmail($user){
        $validity = config('auth.verification_code_validity');
        $code = $this->getVerificationCode($user, 'verification', $validity);

        $user->notify(new VerifyEmailNotification($user, $code, $validity));
    }
}
