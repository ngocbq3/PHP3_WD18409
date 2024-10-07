<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {
        $data = $request->only(['username', 'password']);
        //Đăng nhập
        if (Auth::attempt($data)) {
            return redirect()->route('admin.posts.index');
        } else {
            return redirect()->back()->with('message', 'Username hoặc Password không đúng!');
        }
    }

    public function getRegister()
    {
        return view('register');
    }
    public function postRegister(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['required', 'min:3'],
            'username' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        User::query()->create($data);

        return redirect()->route('login')->with('message', 'Đăng ký thành công');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
