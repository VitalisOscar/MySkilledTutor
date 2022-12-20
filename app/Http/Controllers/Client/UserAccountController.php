<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Shared\Rules\CorrectPassword;

class UserAccountController extends Controller
{
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
}
