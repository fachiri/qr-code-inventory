<?php

namespace App\Http\Middleware;

use App\Constants\JabatanDosen;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateRoles
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user->admin) {
            $role = 'ADMIN';
        } elseif ($user->lecturer) {
            if ($user->lecturer == JabatanDosen::KEPALA_LAB) {
                $role = 'MANAGER';
            } elseif ($user->lecturer == JabatanDosen::DOSEN) {
                $role = 'LECTURER';
            }
        } elseif ($user->student) {
            $role = 'STUDENT';
        }

        if (Auth::check() && in_array($role, $roles)) {
            return $next($request);
        }

        return redirect()
            ->back()
            ->withErrors(['message' => 'Akses tidak sah.']);
    }
}
