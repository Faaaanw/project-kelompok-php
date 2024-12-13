<?php
ob_start();
include('includes/header.php');
require_once('function.php');

// Cek apakah ada parameter id dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data movie yang akan diedit
    $movie = query("SELECT * FROM movies WHERE id_movie = $id");
    if (empty($movie)) {
        echo "Movie not found!";
        exit;
    }
    $movie = $movie[0]; // Ambil data movie pertama (karena id harus unik)
}

// Proses form update jika tombol submit ditekan
if (isset($_POST['submit'])) {
    // Panggil fungsi edit_movie dari file function.php
    $result = edit_movie($_POST, $id);

    if ($result) {
        header("Location: movies.php");
    } else {
        echo "Failed to update movie.";
    }
}
?>

<div class="container">
    <h3>Edit Movie</h3>
    <form action="edit_movie.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul_movie" class="form-label">Title</label>
            <input type="text" name="judul_movie" id="judul_movie" class="form-control"
                value="<?= htmlspecialchars($movie['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_movie" class="form-label">Description</label>
            <textarea name="deskripsi_movie" id="deskripsi_movie" class="form-control" rows="3"
                required><?= htmlspecialchars($movie['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Duration (minutes)</label>
            <input type="number" name="durasi" id="durasi" class="form-control"
                value="<?= htmlspecialchars($movie['duration']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Age Rating</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="G" <?= ($movie['age_rating'] == 'G') ? 'selected' : ''; ?>>G</option>
                <option value="PG" <?= ($movie['age_rating'] == 'PG') ? 'selected' : ''; ?>>PG</option>
                <option value="PG-13" <?= ($movie['age_rating'] == 'PG-13') ? 'selected' : ''; ?>>PG-13</option>
                <option value="R" <?= ($movie['age_rating'] == 'R') ? 'selected' : ''; ?>>R</option>
                <option value="NC-17" <?= ($movie['age_rating'] == 'NC-17') ? 'selected' : ''; ?>>NC-17</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" 
                value="<?= htmlspecialchars($movie['price']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Movie Poster (Leave blank to keep current image)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php
// Include footer
include('includes/footer.php');
ob_end_flush();
?>
