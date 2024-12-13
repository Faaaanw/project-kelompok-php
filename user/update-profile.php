<?php
include('db.php'); // Koneksi ke database

// Pastikan data diterima dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Validasi input (opsional, bisa ditambahkan)
    if (empty($username) || empty($email)) {
        echo "Username dan email tidak boleh kosong.";
        exit;
    }

    // Update data di database
    $query = "UPDATE users 
              SET username = '$username', email = '$email' 
              WHERE id_user = $id_user";

    if (mysqli_query($koneksi, $query)) {
        echo "Profil berhasil diperbarui!";
        header("Location: profile.php"); // Redirect ke halaman profil
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
