<?php
session_start();
require_once('includes/db.php');

// Check if already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to dashboard
    exit;
}

if (isset($_POST['login'])) {
    $login_field = htmlspecialchars($_POST['login_field']); // Can be username or email
    $password = $_POST['password'];

    // Query to check for the username or email
    $query = "SELECT * FROM users WHERE username = '$login_field' OR email = '$login_field'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // If credentials are correct, store user ID and role in session
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect to dashboard
        header("Location: index.php");
        exit;
    } else {
        $error = "Username/Email or password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style.css"/> <!-- Hubungkan dengan file CSS eksternal -->
</head>
<body>
    <div class="image-box">
        <div class="form-container">
            <div class="flex items-center mb-4">
                <img alt="Logo" class="mr-2" height="40" src="user/assets/logo-login.png" width="40"/>
                <span class="text-2xl font-bold text-green-700">MOZIE</span>
            </div>
            <h1>Login</h1>
            <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
            <form action="login.php" method="POST">
                <input type="text" name="login_field" placeholder="Username or Email" required class="input-field"/>
                <input type="password" name="password" placeholder="Password" required class="input-field"/>
                <button type="submit" name="login" class="submit-btn">Login</button>
            </form>
            <div class="text-center my-4 text-gray-500">or sign up with</div>
            <div class="social-buttons">
                <button><i class="fab fa-google"></i> </button>
                <button><i class="fab fa-microsoft"></i> </button>
                <button><i class="fab fa-apple"></i> </button>
            </div>
            <div class="terms">
                By logging in you agree to Messimo's
                <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>.
            </div>
            <div class="login-link">
                Don't have an account? <a href="register.php">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
