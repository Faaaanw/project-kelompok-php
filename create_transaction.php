<?php
session_start();
require_once('includes/db.php');
include_once('includes/header.php');
require_once('function.php'); // Include transaction functions

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Mengambil user_id dari session

// Query untuk mendapatkan data movies
$query_movies = "SELECT * FROM movies";
$result_movies = mysqli_query($koneksi, $query_movies);

// Query untuk mendapatkan data theaters
$query_theaters = "SELECT * FROM theaters";
$result_theaters = mysqli_query($koneksi, $query_theaters);

// Inisialisasi harga default
$price = 0;

// Cek apakah movie dipilih dan mendapatkan harga film
if (isset($_POST['movie_id'])) {
    $movie_id = $_POST['movie_id'];
    $price = getMoviePrice($movie_id, $koneksi);
}

// Proses form submission
if (isset($_POST['submit'])) {
    $movie_id = $_POST['movie_id'];
    $theater_id = $_POST['theater_id'];
    $quantity = $_POST['quantity'];
    $payment_status = $_POST['payment_status'];

    // Panggil fungsi untuk membuat transaksi
    $response = createTransaction($user_id, $movie_id, $theater_id, $quantity, $payment_status, $price, $koneksi);

    if (isset($response['success'])) {
        $success = $response['success'];
    } else {
        $error = $response['error'];
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Create Transaction</h2>
            <!-- Success or error message -->
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <script type="text/javascript">
        // Menunggu beberapa detik untuk menampilkan pesan sukses
        setTimeout(function() {
            // Ganti 'your-url-here' dengan URL tujuan Anda
            window.location.href = 'http://localhost/movie/user/history.php';
        }, 2000); // 2000ms = 2 detik, Anda bisa mengubahnya sesuai keinginan
    </script>
<?php endif; ?>


            <!-- Transaction Form -->
            <form action="create_transaction.php" method="POST">
                <div class="mb-3">
                    <label for="movie_id" class="form-label">Select Movie</label>
                    <select id="movie_id" name="movie_id" class="form-select" required>
                        <option value="" disabled selected>Select Movie</option>
                        <?php while ($movie = mysqli_fetch_assoc($result_movies)): ?>
                            <option value="<?php echo $movie['id_movie']; ?>" data-price="<?php echo $movie['price']; ?>">
                                <?php echo $movie['title']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="theater_id" class="form-label">Select Theater</label>
                    <select id="theater_id" name="theater_id" class="form-select" required>
                        <option value="" disabled selected>Select Theater</option>
                        <?php while ($theater = mysqli_fetch_assoc($result_theaters)): ?>
                            <option value="<?php echo $theater['id_theater']; ?>"><?php echo $theater['name']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select id="payment_status" name="payment_status" class="form-select" required>
                        <option value="pending" selected>Pending</option>
                        <option value="paid">Paid</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Create Transaction</button>
                    <a href="user/history.php">
                        <button type="submit" name="submit" class="btn btn-primary">Back</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pzjw8f+ua7Kw1TIq0x2F6SYxt5ihX6L4vZZyF5qY2joK2x2zxgbS0ZXQAx44f7xd"
    crossorigin="anonymous"></script>
</body>

</html>