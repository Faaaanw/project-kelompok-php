<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entertain Pro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/global.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        /* CSS untuk mengubah warna teks saat aktif */
        .nav-item.active .nav-link {
            color: black !important; /* Ganti warna teks menjadi hitam saat aktif */
        }

        /* Sembunyikan search bar hanya pada halaman profile.php */
        .hide-search-bar .navbar-nav .form-select,
        .hide-search-bar .navbar-nav .input-group {
            display: none;
        }
    </style>
</head>

<body>
    <section id="header">
        <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">SIGN UP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="ps-3 pe-3" action="#">
                            <div class="mb-3">
                                <label for="username" class="form-label">Name</label>
                                <input class="form-control" type="email" id="username" required="" placeholder="Eget Nulla">
                            </div>

                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="info@gmail.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <h6><a class="button_1 d-block" href="#">LOG IN</a></h6>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <nav class="navbar navbar-expand-md navbar-light" id="navbar_sticky" style="background-color: #ff4444;">
            <div class="container-fluid" style="background-color: #ff4444;">
                <a class="navbar-brand fs-4 p-0 fw-bold text-white text-uppercase" href="index.html"> zienema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="history.php">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-0 ms-auto">
                        <li class="nav-item">
                            <select name="categories" class="form-select bg-light" required="">
                                <option value="">All Categories</option>
                                <option>Movie</option>
                                <option>Video</option>
                                <option>Tv-Show</option>
                                <option>Music</option>
                            </select>

                            <div class="input-group">
                                <input type="text" class="form-control border-start-0" placeholder="Search Movie">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary bg_yell" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah halaman adalah profile.php
            if (window.location.pathname.includes("profile.php")) {
                // Tambahkan class untuk menyembunyikan search bar
                document.querySelector("nav").classList.add("hide-search-bar");

                // Ubah link profile menjadi aktif (warna teks hitam)
                let navItems = document.querySelectorAll(".nav-item");
                navItems.forEach(item => {
                    item.classList.remove("active");
                });
                let profileLink = document.querySelector("a[href='profile.php']").parentElement;
                profileLink.classList.add("active");
            }
			else if(window.location.pathname.includes("index.php")) {
                // Tambahkan class untuk menyembunyikan search bar
                let homeLink = document.querySelector("a[href='index.php']").parentElement;
                homeLink.classList.add("active");
            }
			else if(window.location.pathname.includes("history.php")) {
                // Tambahkan class untuk menyembunyikan search bar
                let historyLink = document.querySelector("a[href='history.php']").parentElement;
                historyLink.classList.add("active");
            }
        });
    </script>
</body>

</html>
