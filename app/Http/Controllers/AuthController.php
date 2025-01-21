<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pegawais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->jabatan === 'admin') {
                return redirect()->route("dashboard");
            } elseif ($user->jabatan === 'pegawai') {
                return redirect()->route("penjadwalan");
            }
        }
        return redirect(route("login"))
            ->with("error", "Login failed");
    }


    public function register()
    {
        return view("auth.register");
    }

    function registerPost(Request $request)
    {
        $request->validate([
            "fullname" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = new Pegawais();
        $user->nama = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->jabatan = $request->jabatan;
        if ($user->save()) {
            return redirect(route("login"))
                ->with("success", "User created successfully");
        }
        return redirect(route("register"))
            ->with("error", "Failed to create account");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // menghapus semua sesi pengguna
        $request->session()->regenerateToken(); // membuat ulang CSRF token

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
