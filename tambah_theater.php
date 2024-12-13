<?php
include('includes/header.php');
require_once('function.php');

if (isset($_POST['submit'])) {
    if (tambah_theater($_POST)) {
        echo "<script>alert('Theater berhasil ditambahkan!'); window.location.href = 'theaters.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan theater.');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-title">Tambah Theater</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Theater</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" id="location" name="location" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="capacity" class="form-label">Kapasitas</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Tambah Theater</button>
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
