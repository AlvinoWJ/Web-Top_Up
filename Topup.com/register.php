<?php 
session_start();

if (isset($_SESSION['username'])) {
    $previousPage = $_SERVER['HTTP_REFERER'] ?? '/Web-top_up/topup.com/index.php';
    header("Location: $previousPage");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card-custom shadow">
            <div class="login-card-body">
                <h4 class="login-card-title text-center mb-4">Daftar Akun</h4>
                <form action="register_proses.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control login-input" placeholder="Nama lengkap" required />
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control login-input" placeholder="Username" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat email</label>
                        <input type="email" id="email" name="email" class="form-control login-input" placeholder="Alamat email" required />
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">Nomor whatsapp</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <img src="https://flagcdn.com/w40/id.png" alt="ID" width="20" />
                            </span>
                            <input type="text" id="whatsapp" name="no_telp" class="form-control login-input" placeholder="+62" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Kata sandi</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control login-input" placeholder="Kata sandi" required />
                                <span class="input-group-text login-icon-wrapper" id="togglePassword" style="cursor:pointer;">
                                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="konfirmasi" class="form-label">Konfirmasi kata sandi</label>
                            <div class="input-group">
                                <input type="password" id="konfirmasi" name="password2" class="form-control login-input" placeholder="Konfirmasi kata sandi" required />
                                <span class="input-group-text login-icon-wrapper" id="toggleConfirmPassword" style="cursor:pointer;">
                                    <i class="bi bi-eye-slash" id="eyeIconConfirm"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="registrasi" class="btn text-white" style="background-color: #d4af37;">Daftar</button>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="index.php" class="btn btn-outline-secondary">Kembali ke Beranda</a>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <small>Sudah punya akun? <a href="login.php">Masuk di sini</a></small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('konfirmasi');
        const eyeIconConfirm = document.getElementById('eyeIconConfirm');

        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            eyeIconConfirm.classList.toggle('bi-eye');
            eyeIconConfirm.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
