<?php
session_start();
include('includes/header.php'); // Include header
require_once('function.php'); // Include functions

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Mengambil user_id dari session  
?>

<div class="container mt-5">
    <h2>Your Transactions</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Movie Title</th>
                <th>Theater</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = query("SELECT t.*, m.title AS movie_title, th.name AS theater_name 
                    FROM transactions t
                    JOIN movies m ON t.movie_id = m.id_movie
                    JOIN theaters th ON t.theater_id = th.id_theater
                    WHERE t.user_id = '$user_id' ORDER BY t.id_transaction DESC");

            foreach ($query as $transaksi):
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($transaksi['movie_title']) ?></td>
                    <td><?= htmlspecialchars($transaksi['theater_name']) ?></td>
                    <td><?= htmlspecialchars($transaksi['quantity']) ?></td>
                    <td><?= htmlspecialchars($transaksi['price']) ?></td>
                    <td><?= htmlspecialchars($transaksi['payment_status']) ?></td>
                    <td><?= htmlspecialchars($transaksi['transaction_date']) ?></td>
                    <td><a href="hapus_transaksi.php?id=<?= $transaksi['id_transaction']; ?>"
                            class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</div>