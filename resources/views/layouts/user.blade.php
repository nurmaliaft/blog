<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Include other required resources -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Lintas Makna</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hanya tampilkan header jika rute bukan 'posts.show' -->
    @unless(request()->routeIs('posts.show'))
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder display-6">Welcome to Lintas Makna!</h1>
                    <p class="lead fs-5 mb-0">Exploring meaning, delving into stories. A minimalist blog for meaningful experiences.</p>
                </div>
            </div>
        </header>
    @endunless

    <main class="py-4">
        @yield('content') <!-- Tempat untuk konten utama -->
    </main>

    <!-- Hanya tampilkan footer jika rute bukan 'posts.show' -->
    @unless(request()->routeIs('posts.show'))
        <footer class="py-4 bg-dark text-white text-center">
            <p>&copy; 2024 Lintas Makna</p>
        </footer>
    @endunless

</body>
</html>