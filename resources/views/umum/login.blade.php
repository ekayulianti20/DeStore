<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DeStore</title>
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Mate&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #34495E;
            font-family: 'Mate', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #2A9D8F;
            font-size: 12px;
        }

        .btn-primary {
            background-color: #F4A261;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e4893e;
        }

        .login-title {
            font-family: 'Mate', serif;
            font-size: 14px;
            color: #264653;
            text-align: center;
        }

        .login-image {
            background: url('{{ asset('img/notes.png') }}') center center no-repeat;
            background-size: contain;
            height: 300px;
        }

        .copyright {
            font-size: 12px;
            color: #34495E;
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .login-image {
                height: 200px;
            }
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <!-- Gambar Samping -->
                        <div class="col-md-6">
                            <div class="login-image"></div>
                        </div>

                        <!-- Form Login -->
                        <div class="col-md-6">
                            <div class="text-center mb-4">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo"
                                    style="width: 60px; height: 65px;">
                                <div class="login-title mt-2">Aplikasi Penjualan dan Manajemen Produk</div>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Masukkan Username" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan Password" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">MASUK</button>

                                @if (session('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </form>


                            <div class="copyright">
                                Copyright &copy; 2025 · Kelompok 4
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
