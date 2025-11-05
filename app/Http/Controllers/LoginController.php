<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{   
    public function showLoginForm()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        //if pilih role "karyawan"
        if ($request->input('role') == 'karyawan') {
            $validator = Validator::make($request->all(), [
                'name_or_email' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $loginType = filter_var($request->input('name_or_email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            $credentials = [
                $loginType => $request->input('name_or_email'),
                'password' => $request->input('password'),
            ];

            //Jika autentikasi berhasil
            if (Auth::attempt($credentials)) {
                //Buat sesi dengan nama karyawan
                $request->session()->regenerate();
                $request->session()->put('role', 'karyawan');
                //membuat sesi id,nama user
                $request->session()->put('user_id', Auth::user()->id);
                $request->session()->put('user_name', Auth::user()->name);
                return redirect()->intended('karyawan/dashboard')->with('message', 'Login successful!');
            }else{
                return redirect()->back()->with('message', 'Login failed! Please check your credentials.')->withInput();
            }
        }elseif ($request->input('role') == 'admin') {
            // Hardcoded admin credentials (no database)
            $adminUsername = 'admin';
            $adminPassword = 'admin123';

            $inputUsername = $request->input('name_or_email');
            $inputPassword = $request->input('password');

            if ($inputUsername === $adminUsername && $inputPassword === $adminPassword) {
                // Set session for admin
                $request->session()->regenerate();
                $request->session()->put('role', 'admin');
                return redirect()->intended('admin/dashboard')->with('message', 'Login successful!');
            } else {
                return redirect()->back()->with('message', 'Admin login failed! Invalid credentials.')->withInput();
            }
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'You have been logged out.');
    }
}
