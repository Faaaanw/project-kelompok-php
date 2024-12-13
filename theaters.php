<?php
include('includes/header.php');
require_once('function.php');

// Mendapatkan semua data theater
$theaters = get_all_theaters();
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Daftar Theaters</h4>
        </div>
        <div class="card-body">
            <a href="tambah_theater.php" class="btn btn-primary mb-3">Tambah Theater</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Theater</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($theaters as $theater): ?>
                    <tr>
                        <td><?= $theater['id_theater']; ?></td>
                        <td><?= $theater['name']; ?></td>
                        <td><?= $theater['location']; ?></td>
                        <td><?= $theater['capacity']; ?></td>
                        <td>
                            <a href="edit_theater.php?id=<?= $theater['id_theater']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_theater.php?id=<?= $theater['id_theater']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Include footer
include('includes/footer.php');
?>
