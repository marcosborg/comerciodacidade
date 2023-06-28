<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function clientLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return Auth::attempt($credentials);
    }
}