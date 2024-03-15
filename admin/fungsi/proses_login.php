<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

// Mendapatkan username dan password dari form
$username = $_POST['login'];
$today_date = date('d');  // Mendapatkan tanggal hari ini

// Membuat password sesuai dengan aturan yang dijelaskan
$name = "Admin Utama";
$password = "admin" . $today_date;

// Memeriksa apakah username dan password sesuai
if ($username == "admin" && $_POST['password'] == $password) {
    // Jika sesuai, redirect ke halaman admin
    $_SESSION['username'] = $name;
    header("Location: ../admin-page/index.php"); // Gantilah "admin_page.php" dengan halaman admin yang sesuai
    exit();
} else {
    // Jika tidak sesuai, kembalikan ke halaman login dengan pesan error
    echo '<script>alert("Username atau Password Tidak Sesuai."); window.location.href = "../index.php";</script>';
    exit();
}

