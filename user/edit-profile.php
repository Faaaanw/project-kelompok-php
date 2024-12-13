<?php
// Include file koneksi database
include_once 'db.php';
include_once('header.php');

// Ambil id_user dari URL
$id_user = isset($_GET['id']) ? $_GET['id'] : 1;

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Jika data pengguna ditemukan
if ($user) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil data yang di-submit dari form
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Update data pengguna di database
        $update_query = "UPDATE users SET username = '$username', email = '$email' WHERE id_user = $id_user";
        if (mysqli_query($koneksi, $update_query)) {
            echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php?id=$id_user';</script>";
        } else {
            echo "Error updating profile: " . mysqli_error($koneksi);
        }
    }
?>

<<div class="container">
    <h3>Edit Profile</h3>
    <form action="edit-profile.php?id=<?= $id_user ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control"
                value="<?= htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                value="<?= htmlspecialchars($user['email']); ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php
} else {
    echo "User not found.";
    include_once('header.php');
}
?>
