<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah data di model Category, Post, dan User
        $totalPosts = Post::count();
        $totalCategories = Category::count();  // Memastikan model Category diimpor dengan benar
        $totalUsers = User::count();

        // Mengambil postingan terbaru (5)
        $recentPosts = Post::latest()->limit(5)->get();
        
        // Mengambil semua postingan, diurutkan berdasarkan created_at secara descending
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('totalPosts', 'totalCategories', 'totalUsers', 'recentPosts', 'posts'));
    }
}