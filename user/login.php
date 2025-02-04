<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css"/> <!-- Hubungkan dengan file CSS eksternal -->
</head>
<body>
    <div class="image-box">
        <div class="container">

            <div class="form-container">
                <div class="flex items-center mb-4">
                    <img alt="Logo" class="mr-2" height="40" src="assets/logo-login.png" width="40"/>
                    <span class="text-2xl font-bold text-green-700">MOZIE</span>
                </div>
                <h1>Get started</h1>
                <input placeholder="Email address" type="email"/>
                <input placeholder="Password" type="password"/>
                <a href="index.php"><button>login</button></a>
                <div class="text-center my-4 text-gray-500">or sign up with</div>
                <div class="social-buttons">
                    <button><i class="fab fa-google"></i> </button>
                    <button><i class="fab fa-microsoft"></i> </button>
                    <button><i class="fab fa-apple"></i> </button>
                </div>
                <div class="terms">
                    By creating an account you agree to Messimo's
                    <a href="#">Terms of Services</a> and <a href="#">Privacy Policy</a>.
                </div>
                <div class="login-link">
                    Dont have an account? <a href="#">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
