@extends('layouts.app')

@section('header')
    <!-- Header Section -->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <p class="lead mb-0">Discover the latest posts and updates</p>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container mt-4">
        <!-- Tombol Create Post dan Add Category di samping -->
        @if(auth()->user() && auth()->user()->role == 'admin')
            <div class="mb-4 d-flex gap-3">
                <!-- Tombol Create New Post -->
                <a href="{{ route('posts.create') }}" class="btn btn-success">
                    Create New Post
                </a>
                <!-- Tombol Add Category -->
                <a href="{{ route('categories.create') }}" class="btn btn-success">
                    Add Category
                </a>
            </div>
        @endif

        <!-- Form Pencarian -->
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <!-- Input pencarian berdasarkan judul atau konten -->
                <div class="col-md-4">
                    <input 
                        type="text" 
                        class="form-control" 
                        name="query" 
                        placeholder="Search by title or content" 
                        value="{{ request('query') }}"/>
                </div>
                <!-- Pilihan kategori -->
                <div class="col-md-3">
                    <select class="form-control" name="category">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option 
                                value="{{ $category->id }}" 
                                {{ request('category') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Dropdown Sort By -->
                <div class="col-md-3">
                    <select class="form-control" name="sort_by">
                        <option value="">Sort By</option>
                        <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
                    </select>
                </div>
                <!-- Tombol pencarian -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

        <!-- Daftar Postingan -->
        <div class="row justify-content-center">
            @forelse ($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card shadow border-light" style="border-radius: 5px; display: flex; flex-direction: column; height: 100%;">
                        <!-- Gambar postingan -->
                        @if ($post->image)
                            <img 
                                class="card-img-top" 
                                src="{{ asset('storage/' . $post->image) }}" 
                                alt="Post image" 
                                style="width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 5px; border-top-right-radius: 5px;"
                            />
                        @endif
                        <!-- Konten postingan -->
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold; margin-bottom: 15px;">
                                {{ $post->title }}
                            </h5>
                            <p class="card-text text-truncate" style="font-size: 1rem; color: #6c757d; margin-bottom: 20px;">
                                {{ Str::limit($post->content, 150) }}
                            </p>
                            <a 
                                href="{{ route('posts.show', $post) }}" 
                                class="btn btn-primary" 
                                style="margin-bottom: 15px;">
                                Read More →
                            </a>
                        </div>
                        <!-- Aksi untuk Admin -->
                        @if(auth()->user() && auth()->user()->role == 'admin')
                            <div class="d-flex justify-content-between mt-3 px-3" style="margin-bottom: 15px;">
                                <a 
                                    href="{{ route('posts.edit', $post) }}" 
                                    class="btn btn-warning" 
                                    style="margin-right: 10px;">
                                    Edit
                                </a>
                                <form 
                                    action="{{ route('posts.destroy', $post) }}" 
                                    method="POST" 
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this post?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Jika tidak ada postingan -->
                <div class="col-12 text-center">
                    <h5>No posts found. Try different keywords or categories.</h5>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection