<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register(RegisterRequest $request)
    {
        $validateData = $request->validated();

        $user = new User();
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->password = Hash::make($validateData['password']); //パスワードをハッシュ化
        $user->save();

        Auth::login($user); //ユーザーログイン

        return redirect()->route('index'); //ログイン後にリダイレクト
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            //ログイン成功
            return redirect()->intended('index');
        }

        //ログイン失敗
        return back()->withErrors([
            'email' => 'The provided credentials do not our records',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
