<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended(Auth::user()->role . '/dashboard'); // atau sesuai role
        }
        $data = [];
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect(route('admin.dashboard'));
            }

            // if ($user->role == 'user') {
            //     return redirect(route('user.dashboard'));
            // }
        }

        return back()->with([
            'failed' => 'Email dan Password anda salah !'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
