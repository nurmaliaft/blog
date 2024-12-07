<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'category_id'];

    /**
     * Relasi ke model Category
     */
    public function index()
    {
        $posts = Post::all(); // Ambil semua posting dari database
        return view('admin.dashboard', compact('posts')); // Kirim ke view
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}