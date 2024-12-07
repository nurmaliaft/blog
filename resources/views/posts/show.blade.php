@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-3">{{ $post->title }}</h4>
                <p class="text-muted">
                    <!-- Menampilkan kategori jika ada -->
                    <strong>Category:</strong> 
                    {{ $post->category ? $post->category->name : 'Uncategorized' }}
                </p>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <!-- Menampilkan gambar jika ada -->
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mb-3 w-25 me-3"> 
                @endif
                <!-- Teks konten di sebelah gambar dengan justify -->
                <div class="flex-grow-1">
                    <p class="mb-4" style="text-align: justify;">{{ $post->content }}</p>
                </div>
            </div>
        </div>

        <!-- Tombol Back -->
        <div class="mt-3 text-end">
            <button class="btn btn-secondary" onclick="history.back()">Back</button>
        </div>
    </div>
@endsection