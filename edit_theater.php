<?php
include('includes/header.php');
require_once('function.php');

// Mengecek jika ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $theater = get_theater_by_id($id); // Mengambil data theater berdasarkan ID

    if (isset($_POST['submit'])) {
        if (edit_theater($_POST, $id)) {
            echo "<script>alert('Theater berhasil diperbarui!'); window.location.href = 'theaters.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui theater.');</script>";
        }
    }
} else {
    echo "Theater tidak ditemukan.";
    exit;
}
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Edit Theater</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Theater</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= $theater['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" id="location" name="location" class="form-control" value="<?= $theater['location']; ?>">
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Kapasitas</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" value="<?= $theater['capacity']; ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Perbarui Theater</button>
            </form>
            <br>
            <a href="theaters.php" class="btn btn-secondary">Kembali ke Daftar Theater</a>
        </div>
    </div>
</div>

<?php
// Include footer
include('includes/footer.php');
?>
