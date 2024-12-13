<?php
require_once('includes/function.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus user
    if (delete_user($id)) {
        echo "<script>alert('User berhasil dihapus!'); window.location.href = 'users.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user.'); window.location.href = 'users.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location.href = 'user.php';</script>";
}
?>
