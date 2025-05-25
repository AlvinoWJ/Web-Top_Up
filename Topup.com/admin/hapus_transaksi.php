<?php
session_start();
include '../function.php';

// Cek apakah parameter ID tersedia dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data transaksi untuk cek apakah ada bukti bayar
    $transaksi = ambilData("SELECT * FROM transaksi WHERE id = $id")[0];

    if ($transaksi) {
        // Hapus file bukti bayar jika ada
        if (!empty($transaksi['bukti_bayar']) && file_exists('../' . $transaksi['bukti_bayar'])) {
            unlink('../' . $transaksi['bukti_bayar']);
        }

        // Hapus transaksi dari database
        $query = "DELETE FROM transaksi WHERE id = $id";
        mysqli_query($database, $query);

        // Redirect kembali ke halaman admin
        header("Location: transaksi.php?hapus=berhasil");
        exit;
    } else {
        echo "Transaksi tidak ditemukan.";
    }
} else {
    echo "ID tidak valid.";
}
?>
