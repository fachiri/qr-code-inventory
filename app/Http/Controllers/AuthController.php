<?php

namespace App\Http\Controllers;

use App\Constants\StatusUser;
use App\Http\Requests\ProcessLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_index()
    {
        return view('pages.auth.login');
    }

    public function login_process(ProcessLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if ($user && $user->status == StatusUser::INACTIVE) {
            return redirect()
                ->back()
                ->withErrors(['message' => 'Akun Anda tidak aktif. Silakan hubungi administrator.']);
        }

        if (Auth::attempt($credentials)) {
            return redirect()
                ->route('dashboard.index')
                ->withSuccess('Anda berhasil login!');
        }

        return redirect()
            ->back()
            ->withErrors(['message' => 'Ups! Username atau password salah']);
    }

    public function logout_process()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('auth.login.index');
    }
}
