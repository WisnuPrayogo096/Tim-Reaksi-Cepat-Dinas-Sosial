<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server MySQL Anda
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$dbname = "dinsos_trc"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ambil ID dari parameter GET
    $article_id = $_GET["id"];

    // Ambil jenis ramah dari parameter GET
    $jenis_ramah = $_GET["jenis_ramah"];

    // Query untuk menghapus data dari tabel sesuai dengan ID
    $query = "DELETE FROM $jenis_ramah WHERE id = $article_id";

    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman read setelah penghapusan berhasil
        echo "<script>alert('Data berhasil dihapus.');window.location.href='read_form.php';</script>";
        exit();
    } else {
        // Tampilkan pesan kesalahan jika terjadi masalah saat menghapus data
        echo "<script>alert('Gagal menghapus data. Silakan coba lagi. Error : ' . $conn->error;);window.location.href='read_form.php';</script>";
    }
} else {
    echo "<script>alert('ID atau jenis_ramah tidak valid.');window.location.href='read_form.php';</script>";
}

// Tutup koneksi
$conn->close();
?>
