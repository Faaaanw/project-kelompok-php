<?php
include('includes/header.php');
require_once('function.php');

// Mengecek jika ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deleteTransaction($id)) {
        echo "<script>alert('transaksi berhasil dihapus!'); window.location.href = 'user/history.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus transaksi.');</script>";
    }
} else {                      
    echo "transaksi tidak ditemukan.";
    exit;
}

include('includes/footer.php');
?>
