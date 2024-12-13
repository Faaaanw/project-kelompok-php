<?php
require_once('includes/db.php');
require_once('function.php');

// Cek apakah ada parameter ID dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil fungsi delete_movie
    $result = delete_movie($id);

    // Redirect kembali ke halaman movies dengan status
    if ($result) {
        header("Location: movies.php");
    } else {
        header("Location: movies.php");
    }
} else {
    header("Location: movies.php");
}
?>
