<?php
require_once('includes/db.php');

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_movie($data)
{
    global $koneksi;

    $title = htmlspecialchars($data["judul_movie"]);
    $description = htmlspecialchars($data["deskripsi_movie"]);
    $release_Date = date("Y-m-d");
    $duration = htmlspecialchars($data["durasi"]);
    $age_rating = htmlspecialchars($data["rating"]);
    $price = htmlspecialchars($data["price"]);  // Menambahkan parameter price

    // Proses upload gambar
    $image = upload_image();
    if (!$image) {
        return false; // Jika upload gambar gagal
    }

    // Query untuk menambahkan data ke tabel movies
    $query = "INSERT INTO movies (title, description, release_date, duration, age_rating, image, price) 
              VALUES ('$title', '$description', '$release_Date', '$duration', '$age_rating', '$image', '$price')";

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}


function upload_image()
{
    $targetDir = "img/"; 
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validasi file (hanya menerima jpg, jpeg, png, gif)
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Format file tidak valid. Hanya JPG, JPEG, PNG, atau GIF yang diperbolehkan.');</script>";
        return false;
    }

    // Pindahkan file ke folder target
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        return $targetFilePath; // Mengembalikan path file jika berhasil
    } else {
        echo "<script>alert('Gagal mengupload gambar.');</script>";
        return false;
    }
}

// Fungsi untuk menghapus movie berdasarkan ID
function delete_movie($id)
{
    global $koneksi;

    // Query untuk menghapus movie berdasarkan ID
    $query = "DELETE FROM movies WHERE id_movie = $id";

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengedit movie
function edit_movie($data, $id)
{
    global $koneksi;

    $title = htmlspecialchars($data["judul_movie"]);
    $description = htmlspecialchars($data["deskripsi_movie"]);
    $duration = htmlspecialchars($data["durasi"]);
    $age_rating = htmlspecialchars($data["rating"]);
    $price = htmlspecialchars($data["price"]);  // Menambahkan parameter price

    // Jika ada gambar baru, upload gambar tersebut
    if ($_FILES["image"]["name"] != "") {
        $image = upload_image(); // Proses upload gambar
        if (!$image) {
            return false;
        }
        // Query untuk mengupdate data movie dengan gambar baru
        $query = "UPDATE movies SET title = '$title', description = '$description', duration = '$duration', 
                  age_rating = '$age_rating', image = '$image', price = '$price' WHERE id_movie = $id";
    } else {
        // Query untuk mengupdate data movie tanpa mengganti gambar
        $query = "UPDATE movies SET title = '$title', description = '$description', duration = '$duration', 
                  age_rating = '$age_rating', price = '$price' WHERE id_movie = $id";
    }

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}


// ------------------------ Fungsi CRUD untuk User ------------------------

// Fungsi untuk menambah user
function tambah_user($data)
{
    global $koneksi;

    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $password = password_hash($data["password"], PASSWORD_DEFAULT); // Hash password
    $role = htmlspecialchars($data["role"]);

    // Query untuk menambahkan data ke tabel users
    $query = "INSERT INTO users (username, email, password, role) 
              VALUES ('$username', '$email', '$password', '$role')";

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengedit user
function edit_user($data, $id)
{
    global $koneksi;

    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $role = htmlspecialchars($data["role"]);

    // Jika password diubah
    if (!empty($data["password"])) {
        $password = password_hash($data["password"], PASSWORD_DEFAULT); // Hash password
        $query = "UPDATE users SET username = '$username', email = '$email', password = '$password', role = '$role' WHERE id_user = $id";
    } else {
        $query = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id_user = $id";
    }

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk menghapus user berdasarkan ID
function delete_user($id)
{
    global $koneksi;

    // Query untuk menghapus user berdasarkan ID
    $query = "DELETE FROM users WHERE id_user = $id";

    mysqli_query($koneksi, $query);

    // Mengecek apakah query berhasil
    if (mysqli_affected_rows($koneksi) > 0) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengambil data user berdasarkan ID
function get_user_by_id($id)
{
    global $koneksi;

    // Query untuk mengambil data user berdasarkan ID
    $query = "SELECT * FROM users WHERE id_user = $id";
    return query($query);
}

// Fungsi untuk mendapatkan seluruh data user
function get_all_users()
{
    global $koneksi;

    // Query untuk mengambil seluruh data user
    $query = "SELECT * FROM users";
    return query($query);
}
// Mengambil semua data theater
// Mengambil semua data theater
function get_all_theaters()
{
    global $koneksi;  // Use $koneksi instead of $conn
    $sql = "SELECT * FROM theaters";
    $result = mysqli_query($koneksi, $sql);  // Use $koneksi here
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Mengambil data theater berdasarkan ID
function get_theater_by_id($id)
{
    global $koneksi;  // Use $koneksi here
    $sql = "SELECT * FROM theaters WHERE id_theater = ?";
    $stmt = mysqli_prepare($koneksi, $sql);  // Use $koneksi here
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Menambahkan theater baru
function tambah_theater($data)
{
    global $koneksi;  // Use $koneksi here
    $name = $data['name'];
    $location = $data['location'];
    $capacity = $data['capacity'];

    $sql = "INSERT INTO theaters (name, location, capacity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);  // Use $koneksi here
    mysqli_stmt_bind_param($stmt, "ssi", $name, $location, $capacity);
    return mysqli_stmt_execute($stmt);
}

// Memperbarui theater
function edit_theater($data, $id)
{
    global $koneksi;  // Use $koneksi here
    $name = $data['name'];
    $location = $data['location'];
    $capacity = $data['capacity'];

    $sql = "UPDATE theaters SET name = ?, location = ?, capacity = ? WHERE id_theater = ?";
    $stmt = mysqli_prepare($koneksi, $sql);  // Use $koneksi here
    mysqli_stmt_bind_param($stmt, "ssii", $name, $location, $capacity, $id);
    return mysqli_stmt_execute($stmt);
}

// Menghapus theater
function hapus_theater($id)
{
    global $koneksi;  // Use $koneksi here
    $sql = "DELETE FROM theaters WHERE id_theater = ?";
    $stmt = mysqli_prepare($koneksi, $sql);  // Use $koneksi here
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

function getMoviePrice($movie_id, $koneksi) {
    $query_movie = "SELECT price FROM movies WHERE id_movie = '$movie_id'";
    $result_movie = mysqli_query($koneksi, $query_movie);
    $movie_data = mysqli_fetch_assoc($result_movie);
    return $movie_data['price'];
}

// Fungsi untuk membuat transaksi
function createTransaction($user_id, $movie_id, $theater_id, $quantity, $payment_status, $price, $koneksi) {
    // Hitung total price berdasarkan quantity
    $total_price = $price * $quantity;

    // Insert transaksi ke database
    $query_insert = "INSERT INTO transactions (user_id, movie_id, theater_id, price, quantity, payment_status) 
                    VALUES ('$user_id', '$movie_id', '$theater_id', '$total_price', '$quantity', '$payment_status')";
    
    if (mysqli_query($koneksi, $query_insert)) {
        return ["success" => "Transaction created successfully!"];
    } else {
        return ["error" => "Error: " . mysqli_error($koneksi)];
    }
}
function deleteTransaction($id)
{
    global $koneksi;  // Use $koneksi here
    $sql = "DELETE FROM transactions WHERE id_transaction = ?";
    $stmt = mysqli_prepare($koneksi, $sql);  // Use $koneksi here
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// function getUserTransactions($user_id, $koneksi) {
//     $query = "SELECT t.*, m.title AS movie_title, th.name AS theater_name 
//               FROM transactions t
//               JOIN movies m ON t.movie_id = m.id_movie
//               JOIN theaters th ON t.theater_id = th.id_theater
//               WHERE t.user_id = '$user_id' ORDER BY t.id_transaction DESC";  // Ganti created_at dengan id_transaction
//     $result = mysqli_query($koneksi, $query);

//     if (!$result) {
//         return ["error" => "Error: " . mysqli_error($koneksi)];
//     }

//     return $result;
// }




?>
