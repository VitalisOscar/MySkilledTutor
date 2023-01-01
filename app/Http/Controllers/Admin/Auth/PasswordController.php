<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Rules\CorrectPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    function __invoke(){
        return $this->view('admin.auth.password');
    }

    function update(Request $request){
        try{
            $user = $request->user('admin');

            $validator = validator($request->post(), [
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'same:password'],
                'current_password' => ['required', new CorrectPassword($user)],
            ],[
                'password_confirmation.same' => 'Passwords do not match!'
            ]);

            if($validator->fails()){
                return back()
                    ->withInput()
                    ->withErrors($validator->errors());
            }

            // Change password
            $user->password = Hash::make($request->post('password'));

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
