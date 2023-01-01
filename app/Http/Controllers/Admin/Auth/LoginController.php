<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return $this->view('admin.auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput()
        ->withErrors([
            'status' => 'The provided credentials do not match our records.',
        ]);
    }
}
