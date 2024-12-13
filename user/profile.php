<?php
session_start();
include_once('header.php'); // Memulai sesi

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika user belum login, redirect ke halaman login atau tampilkan pesan
    header("Location: login.php"); 
    exit();
}

// Ambil informasi pengguna dari session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Pastikan koneksi sudah benar
include_once 'db.php';

// Query untuk mengambil data user berdasarkan id_user dari session
$query = "SELECT * FROM users WHERE id_user = $user_id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Account not found.";
    exit();
}
?>

 
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: 'Lato', sans-serif;
        }
        .header{}
        .navbar-brand {
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        .navbar-nav .nav-link {
            color: white;
            font-size: 1rem;
        }
        .navbar-nav .nav-link.active {
            color: #fbd6d6;
        }
        .profile-container {
            background-color: #ffffff;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-left: 50px;
            object-fit: cover;
            background-color: #ddd;
        }
        .profile-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .profile-info h1 {
            font-size: 1.8rem;
            margin: 0;
            color: #333;
        }
        .profile-info p {
            margin: 5px 0;
            color: #555;
        }
        .bio {
            font-size: 0.95rem;
            margin: 15px 0;
            color: #666;
            border-left: 4px solid #ff4444;
            padding-left: 10px;
        }
        .profile-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .profile-buttons a {
            display: block;
            text-align: center;
            padding: 10px;
            font-size: 1rem;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .edit-btn {
            background-color: #4caf50;
        }
        .edit-btn:hover {
            background-color: #43a047;
        }
        .logout-btn {
            background-color: #ff4747;
        }
        .logout-btn:hover {
            background-color: #e04040;
        }
        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .profile-info {
                align-items: center;
            }
            .profile-buttons {
                width: 100%;
            }
        }
    </style>
</head>
 

    <!-- Profile Page Content -->
    <div class="profile-container">
        <img src="homer.png" alt="Profile Picture">
        <div class="profile-info">
            <h1><?php echo $user['username']; ?></h1>
            <p><?php echo $user['email']; ?></p>
            <p>Joined: December 2023</p>
            <div class="bio">Bio: A passionate movie enthusiast who loves exploring diverse genres and discussing cinema.</div>
        </div>
        <div class="profile-buttons">
            <a href="logout.php" class="logout-btn">Logout</a>
            <a href="edit-profile.php?id=<?php echo $user['id_user']; ?>" class="edit-btn">Edit Profile</a>
        </div>
    </div>
</body>
</html>
