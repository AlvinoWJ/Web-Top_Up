<?php
session_start();
include 'function.php'; // pastikan kamu sudah punya file koneksi.php untuk koneksi DB

// Tangkap data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cegah SQL injection
$username = mysqli_real_escape_string($database, $username);
$password = mysqli_real_escape_string($database, $password);

// Cari user dengan username yang dimasukkan
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($database, $query);

// Periksa apakah username ditemukan
if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        // Password benar, set session
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role_id']; // opsional, kalau kamu simpan role
        
        if($_SESSION['role'] == 1){
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
        
    } else {
        // Password salah
        echo "<script>alert('Kata sandi salah!'); window.location.href='login.php';</script>";
    }
} else {
    // Username tidak ditemukan
    echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
}
?>
