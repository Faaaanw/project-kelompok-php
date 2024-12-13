<?php
include('includes/header.php');
require_once('function.php');

// Mengecek jika ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = get_user_by_id($id)[0]; // Mengambil data user berdasarkan ID

    if (isset($_POST['submit'])) {
        if (edit_user($_POST, $id)) {
            echo "<script>alert('User berhasil diperbarui!'); window.location.href = 'users.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui user.');</script>";
        }
    }
} else {
    echo "User tidak ditemukan.";
    exit;
}
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control"
                        value="<?= $user['username']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= $user['email']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Perbarui User</button>
            </form>
            <br>
            <a href="users.php" class="btn btn-secondary">Kembali ke Daftar User</a>
        </div>
    </div>
</div>

<?php
// Include footer
include('includes/footer.php');
?>