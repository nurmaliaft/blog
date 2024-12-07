<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Konstruktor untuk middleware
    public function __construct()
    {
        // Hanya admin yang bisa mengelola postingan, kecuali untuk 'index' dan 'show'
        $this->middleware('is_admin')->except(['index', 'show']); 
    }

    // Menampilkan daftar semua postingan
    public function index(Request $request)
    {
        $query = $request->input('query');
        $categoryFilter = $request->input('category');

        // Ambil semua postingan dengan relasi kategori dan menerapkan pencarian dan filter
        $posts = Post::with('category') // Menggunakan eager loading untuk kategori
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                                     ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->when($categoryFilter, function ($queryBuilder) use ($categoryFilter) {
                return $queryBuilder->where('category_id', $categoryFilter);
            })
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at secara descending
            ->paginate(3);

        // Ambil semua kategori untuk dropdown
        $categories = Category::all(); 

        return view('posts.index', compact('posts', 'categories')); // Kirim kategori dan postingan ke view
    }

    // Menampilkan form untuk membuat postingan (hanya admin)
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('admin.posts.create', compact('categories'));
    }

    // Menampilkan detail postingan
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Menyimpan postingan baru (hanya admin)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan gambar
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Simpan postingan ke database
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id, // Menyimpan kategori
        ]);

        // Redirect ke halaman dashboard admin setelah postingan disimpan
        return redirect()->route('admin.dashboard')->with('status', 'Post created successfully');
    }

    // Menampilkan form untuk mengedit postingan (hanya admin)
    public function edit(Post $post)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('admin.posts.edit', compact('post', 'categories')); // Kirim kategori dan postingan ke view
    }

    // Memperbarui postingan (hanya admin)
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        // Cek apakah ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            // Jika tidak ada gambar baru, tetap gunakan gambar lama
            $imagePath = $post->image;
        }

        // Update postingan dengan data yang baru
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id, // Update kategori
        ]);

        // Redirect ke halaman dashboard admin setelah update
        return redirect()->route('admin.dashboard')->with('status', 'Post updated successfully');
    }

    // Menghapus postingan (hanya admin)
    public function destroy(Post $post)
    {
        // Menghapus gambar terkait jika ada
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        // Hapus postingan dari database
        $post->delete();

        // Redirect ke halaman dashboard admin setelah postingan dihapus
        return redirect()->route('admin.dashboard')->with('status', 'Post deleted successfully');
    }
}