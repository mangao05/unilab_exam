<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Http\Requests\Auth\LoginUserRequest;

use Auth;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request) {
        if(!Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            return response()->json('Oops! These credentials do not match our records.');
        }

        $user = Auth::user();
        $token = $user->createToken('unilab')->accessToken;

        return response()->json(['token' => $token, 'userinfo' => $user]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response()->json('User successfully logout!');
    }

}
