<?php
session_start();
include 'function.php';



// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $paket_id = htmlspecialchars($_POST['paket_id']);
    $player_id = htmlspecialchars($_POST['player_id']);
    $server_id = htmlspecialchars($_POST['server_id']);
    $metode_pembayaran = htmlspecialchars($_POST['metode_pembayaran']);
    $status = 'belum_dibayar'; // default status saat baru checkout
    $query = "INSERT INTO transaksi 
                ( user_id, paket_id, player_id, server_id, metode_pembayaran, status) 
              VALUES 
                ('$user_id', '$paket_id', '$player_id', '$server_id', '$metode_pembayaran', '$status')";

    if (mysqli_query($database, $query)) {
        echo "<script>
            alert('Checkout berhasil!');
            window.location.href = 'riwayat_checkout.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menyimpan data.');
            window.history.back();
        </script>";
    }
} else {
    header("Location: index.php");
    exit;
}
