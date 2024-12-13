<?php
include('includes/header.php');
require_once('function.php');
?>
<!-- Modal for Adding Movie -->
<div class="modal fade" id="addMovieModal" tabindex="-1" aria-labelledby="addMovieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMovieModalLabel">Add New Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="add_movie.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul_movie" class="form-label">Title</label>
                        <input type="text" name="judul_movie" id="judul_movie" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_movie" class="form-label">Description</label>
                        <textarea name="deskripsi_movie" id="deskripsi_movie" class="form-control" rows="3"
                            required></textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add Movie</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Main Content Area -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Movies</h4>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addMovieModal">Add
                Movie</button>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Search for movies...">
            </div>
            <!-- Table for Movies -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Release Date</th>
                        <th>Duration</th>
                        <th>Age Rating</th>
                        <th>Price</th> <!-- Added Price Column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="moviesTableBody">
                    <?php
                    $no = 1;
                    $movies = query("SELECT * FROM movies");
                    if (!empty($movies)) {
                        foreach ($movies as $item): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($item['title']); ?></td>
                                <td><?= htmlspecialchars($item['description']); ?></td>
                                <td><?= htmlspecialchars($item['release_date']); ?></td>
                                <td><?= htmlspecialchars($item['duration']); ?> mins</td>
                                <td><?= htmlspecialchars($item['age_rating']); ?></td>
                                <td><?= 'Rp ' . number_format($item['price'], 0, ',', '.'); ?> </td>
                                <!-- Format Price to IDR -->
                                <td>
                                    <img src="img/<?= htmlspecialchars($item['image']); ?>" alt="Movie Poster"
                                        style="width: 100px; height: auto;">
                                </td>

                                <td>
                                    <a href="edit_movie.php?id=<?= $item['id_movie']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_movie.php?id=<?= $item['id_movie']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach;
                    } else {
                        echo '<tr><td colspan="8" class="text-center">No movies found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Include footer
include('includes/footer.php');
?>