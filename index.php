<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: user/index.php");
        exit();
    }
}
