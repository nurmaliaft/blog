<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        // Mengambil semua kategori dengan urutan descending berdasarkan 'id'
        $categories = Category::orderBy('id', 'desc')->get();  
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('admin.categories.create');  // Memastikan path view sesuai
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',  // Validasi agar nama kategori wajib diisi dan maksimal 255 karakter
        ]);

        // Menyimpan kategori baru menggunakan mass assignment
        Category::create([
            'name' => $request->name,  // Menyimpan nama kategori
        ]);

        // Redirect kembali ke daftar kategori dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit kategori berdasarkan ID
    public function edit($id)
    {
        // Menemukan kategori berdasarkan ID
        $category = Category::findOrFail($id);  
        return view('admin.categories.edit', compact('category'));  // Memastikan path view sesuai
    }

    // Memperbarui kategori
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',  // Validasi agar nama kategori wajib diisi dan maksimal 255 karakter
        ]);

        // Menemukan kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Memperbarui nama kategori
        $category->update([
            'name' => $request->name
        ]);  

        // Redirect kembali ke daftar kategori dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Menghapus kategori berdasarkan ID
    public function destroy($id)
    {
        // Menemukan kategori berdasarkan ID
        $category = Category::findOrFail($id);
        
        // Menghapus kategori
        $category->delete();  

        // Redirect kembali ke daftar kategori dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}