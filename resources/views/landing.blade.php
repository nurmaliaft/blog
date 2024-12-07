<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f9;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 90%;
            overflow: hidden;
            padding: 40px;
        }

        .row {
            align-items: center;
        }

        .text-content {
            padding: 30px;
        }

        .text-content h1 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #000;
            font-weight: bold;
        }

        .text-content p {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #555;
            text-align: justify;
        }

        .btn-custom {
            margin: 5px;
            font-size: 0.9rem;
            padding: 8px 15px;
        }

        .image-content img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Kolom Teks -->
            <div class="col-md-6 text-content">
                <h1>Welcome to Lintas Makna</h1>
                <p>Lintas Makna adalah blog yang menyajikan berbagai artikel menarik dengan beragam perspektif. Gunakan fitur-fitur berikut untuk pengalaman terbaik:</p>
                <ul>
                    <li><strong>Pencarian:</strong> Temukan artikel dengan mudah.</li>
                    <li><strong>Paginasi:</strong> Jelajahi artikel dalam halaman yang terorganisir.</li>
                    <li><strong>Urutkan:</strong> Pilih urutan judul atau tanggal.</li>
                    <li><strong>Kategori:</strong> Eksplorasi artikel berdasarkan kategori.</li>
                    <li><strong>Baca Selengkapnya:</strong> Klik untuk membaca artikel lengkap.</li>
                </ul>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-custom">Register</a>
                </div>
            </div>
            <!-- Kolom Gambar -->
            <div class="col-md-6 image-content">
                <img src="https://i.pinimg.com/736x/9c/4a/db/9c4adb420f4101a9b03207b42b4d9a8e.jpg" alt="Landing Page Image">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>