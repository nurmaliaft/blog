@extends('layouts.app')

@section('header')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <p class="lead mb-0">Edit Category</p>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Edit Category</h2>

        <!-- Form untuk mengedit kategori yang sudah ada -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Menyebutkan bahwa ini adalah request PUT untuk update data -->
            
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $category->name) }}" 
                    placeholder="Enter category name" 
                    required
                />
            </div>

            <button type="submit" class="btn btn-success">Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        </form>
    </div>
@endsection