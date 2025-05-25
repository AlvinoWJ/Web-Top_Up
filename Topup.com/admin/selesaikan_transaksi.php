<?php
include '../function.php';
session_start();

// if (!isset($_SESSION['username']) || $_SESSION['role_id'] != 1) {
//     header("Location: /Web-top_up/topup.com/login.php");
//     exit;
// }


if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    $query = "UPDATE transaksi SET status = 'selesai' WHERE id = $id";
    mysqli_query($database, $query);

    header("Location: transaksi.php?berhasil=selesai");
    exit;
} else {
    header("Location: transaksi.php?gagal=1");
    exit;
}
?>
