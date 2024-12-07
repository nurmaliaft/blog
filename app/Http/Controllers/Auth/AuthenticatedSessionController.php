<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
{
    // Redirect ke halaman posts setelah login berhasil
    return redirect()->route('posts.index'); // Pastikan Anda memiliki rute 'posts.index' di routes/web.php
}
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    // Proses logout
    Auth::guard('web')->logout();

    // Menonaktifkan session dan token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Arahkan pengguna kembali ke halaman login
    return redirect()->route('landing'); // Mengarahkan ke halaman login
}
}
