<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Menangani pengalihan setelah login
    protected function authenticated(Request $request, $user)
    {
        // Jika role adalah admin, arahkan ke admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika bukan admin, arahkan ke halaman posts
        return redirect()->route('posts.index');
    }
}