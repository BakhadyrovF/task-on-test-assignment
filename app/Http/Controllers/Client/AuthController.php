<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function logIn(LoginFormRequest $request)
    {
        $user = User::whereLogin($request->validated('login'))->first();

        if (!Hash::check($request->validated('password'), $user->password)) {
            return redirect()->route('auth.login')->withErrors(['password' => __('auth.invalid-password')]);
        }

        auth('web')->login($user);

        return 'success';
    }

    public function logOut()
    {
        auth('web')->logout();

        return redirect()->route('auth.login');
    }
}
