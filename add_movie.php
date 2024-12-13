<?php
include('includes/header.php');
require_once('function.php');

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $judul = htmlspecialchars($_POST['judul_movie']);
    $deskripsi = htmlspecialchars($_POST['deskripsi_movie']);
    $durasi = htmlspecialchars($_POST['durasi']);
    $rating = htmlspecialchars($_POST['rating']);
    $price = htmlspecialchars($_POST['price']); // Ambil nilai price
    
    // Proses upload gambar
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = 'img/' . $imageName;

    // Pastikan file gambar berhasil diupload
    if (move_uploaded_file($imageTmp, $imagePath)) {
        // Menyimpan data ke dalam database
        $query = "INSERT INTO movies (title, description, release_date, duration, age_rating, image, price) 
                  VALUES ('$judul', '$deskripsi', NOW(), '$durasi', '$rating', '$imageName', '$price')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Movie added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image');</script>";
    }
}
?>

<div class="container mt-5">
    <h3>Add New Movie</h3>
    <form action="add_movie.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul_movie" class="form-label">Title</label>
            <input type="text" name="judul_movie" id="judul_movie" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_movie" class="form-label">Description</label>
            <textarea name="deskripsi_movie" id="deskripsi_movie" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Duration (minutes)</label>
            <input type="number" name="durasi" id="durasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Age Rating</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="G">G</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="R">R</option>
                <option value="NC-17">NC-17</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Movie Poster</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Movie</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
