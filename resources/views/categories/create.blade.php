@extends('layouts.app')

@section('header')
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <p class="lead mb-0">Create a New Category</p>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Create New Category</h2>

        <!-- Form untuk membuat kategori baru -->
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Enter category name" 
                    required
                />
            </div>

            <button type="submit" class="btn btn-success">Create Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Edit Categories</a>
        </form>
    </div>
@endsection