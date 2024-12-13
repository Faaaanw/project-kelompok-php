<?php
include('includes/header.php');
require_once('function.php'); // Menghubungkan ke fungsi CRUD
$users = get_all_users(); // Mengambil semua data user
?>
<div class="container-fluid mt-4">
    <h1 class="mb-4">Daftar User</h1>
    <a href="tambah_user.php" class="btn btn-success mb-3">Tambah User</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id_user']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['role']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $user['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_user.php?id=<?= $user['id_user']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Include footer
include('includes/footer.php');
?>
