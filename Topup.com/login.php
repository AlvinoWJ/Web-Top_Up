<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card-custom shadow">
            <div class="login-card-body">
            <h4 class="login-card-title text-center mb-4">Login</h4>
            <form action="login_proses.php" method="POST">
                <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control login-input" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control login-input" id="password" name="password" placeholder="Kata sandi" required>
                    <span class="input-group-text login-icon-wrapper" id="togglePassword">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                    </span>
                </div>
                </div>
                <div class="d-grid">
                <button type="submit" class="btn text-white" style="background-color: #d4af37;">Masuk</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
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
    </script>
</body>
</html>