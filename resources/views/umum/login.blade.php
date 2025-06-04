<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DeStore</title>
  <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

  <!-- Bulma CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Mate&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #34495E;
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: flex-start;

    }

    .login-container {
      background-color: #ffffff;
      max-width: 1100px;
      width: 100%;
      margin-top: 75px;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 30px 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .login-wrapper {
      align-items: flex-start;
      padding-top: 40px;
    }

    .login-image {
      flex: 1 1 45%;
      min-width: 150px;
      height: 250px;
      background-image: url('/images/login-illustration.png');
      /* Sesuaikan nama file */
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    .login-form {
      flex: 1 1 45%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .login-logo {
      width: 60px;
      height: 65px;
      margin-bottom: 10px;
    }

    .login-title {
      font-family: 'Mate', serif;
      font-size: 12px;
      color: #264653;
      text-align: center;
      margin-bottom: 20px;
    }

    .field input {
      width: 50vh;
      max-width: 442px;
      height: 40px;
      border-radius: 10px;
      border: 1.5px solid #2A9D8F;
      font-size: 12px;
      color: #34495E;
      padding: 10px 18px;
    }

    .field:not(:last-child) {
      margin-bottom: 20px;
    }

    .login-button {
      width: 100%;
      max-width: 400px;
      height: 40px;
      background-color: #F4A261;
      border: none;
      color: #ffffff;
      font-weight: 600;
      font-size: 12px;
      font-family: 'Inter', sans-serif;
      border-radius: 10px;
      margin-top: 30px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-button:hover {
      background-color: #e4893e;
    }

    .copyright {
      font-family: mixed, sans-serif;
      font-size: 12px;
      color: #34495E;
      margin-top: 25px;
      text-align: center;
    }

    /* Responsive layout */
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        padding: 20px;
      }

      .login-image {
        height: 250px;
      }

      .login-form {
        width: 100%;
        margin-top: 20px;
      }
    }
  </style>

</head>

<body>

  <div class="login-container">
    <div class="login-image"></div>

    <div class="login-form">
      <img src="/images/logo-login.png" alt="Logo" class="login-logo">
      <div class="login-title">Aplikasi Penjualan dan Manajemen Produk</div>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
          <div class="control">
            <input class="input" type="text" name="username" placeholder="Masukkan Username" required>
          </div>
        </div>

        <div class="field">
          <div class="control">
            <input class="input" type="password" name="password" placeholder="Masukkan Password" required>
          </div>
        </div>

        <button type="submit" class="login-button">MASUK</button>
      </form>

      <div class="copyright">
        Copyright &copy; 2025 &middot; Kelompok 4
      </div>
    </div>
  </div>

</body>

</html>
