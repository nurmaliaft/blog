@extends('layouts.profile') <!-- Pastikan Anda menggunakan layout profile yang benar -->

@section('content')
    <div class="container mt-4">
        <!-- Menggunakan <h5> untuk ukuran lebih kecil -->
        <h5 class="my-4">Edit Profile</h5>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-light" style="border-radius: 5px;">
                    <div class="card-body">
                        <form action="{{ route('profile.update', auth()->user()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            <!-- Profile Image Input -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if (auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Image" class="mt-3" style="width: 100px; height: 100px; object-fit: cover;">
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>

                        <!-- Tombol Back -->
                        <div class="mt-3">
                            <button class="btn btn-secondary" onclick="history.back()">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection