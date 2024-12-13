<?php
include('includes/header.php');
require_once('function.php');

// Mengecek jika ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (hapus_theater($id)) {
        echo "<script>alert('Theater berhasil dihapus!'); window.location.href = 'theaters.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus theater.');</script>";
    }
} else {
    echo "Theater tidak ditemukan.";
    exit;
}

include('includes/footer.php');
?>
