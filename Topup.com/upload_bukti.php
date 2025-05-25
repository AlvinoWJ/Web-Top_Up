<?php
include 'function.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['transaksi_id'];
    $uploadDir = 'bukti/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir);
    }

    // Ambil bukti lama jika ada
    $transaksi = ambilData("SELECT bukti_bayar FROM transaksi WHERE id = $id");
    $buktiLama = $transaksi[0]['bukti_bayar'] ?? null;

    // Siapkan nama file baru
    $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
    $filename = time() . '_' . uniqid() . '.' . $ext;
    $targetPath = $uploadDir . $filename;

    // Waktu bayar
    date_default_timezone_set("Asia/Jakarta");
    $waktu_bayar = date("Y-m-d H:i:s");

    if (move_uploaded_file($_FILES['bukti']['tmp_name'], $targetPath)) {

        // Hapus file lama jika ada
        if ($buktiLama && file_exists($buktiLama)) {
            unlink($buktiLama);
        }

        // Update database
        $query = "UPDATE transaksi 
                  SET bukti_bayar = '$targetPath', 
                      status = 'proses', 
                      waktu_bayar = '$waktu_bayar' 
                  WHERE id = $id";

        mysqli_query($database, $query);
        $_SESSION['message'] = 'Upload bukti berhasil!';
        header("Location: riwayat_checkout.php");
        exit;
    } else {
        echo "Upload gagal.";
    }
}
?>
