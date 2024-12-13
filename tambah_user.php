<?php
include('includes/header.php');
require_once('function.php');

if (isset($_POST['submit'])) {
    if (tambah_user($_POST)) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location.href = 'users.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan user.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Tambah User</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Tambah User</button>
            </form>
            <br>
            <a href="user.php" class="btn btn-secondary">Kembali ke Daftar User</a>
        </div>
    </div>
</div>

<?php
// Include footer
include('includes/footer.php');
?>
