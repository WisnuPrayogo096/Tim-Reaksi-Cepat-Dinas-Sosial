<?php
// Gantilah dengan konfigurasi koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinsos_trc";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $article_id = $_POST["id"];
    $jenis_ramah = $_POST["jenis_ramah"];
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $isi = $_POST["isi"];

    // Query untuk melakukan update data ke tabel sesuai dengan ID
    $query = "UPDATE $jenis_ramah SET judul='$judul', desk='$deskripsi', isi='$isi' WHERE id=$article_id";

    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman read setelah update berhasil
        echo "<script>alert('Data berhasil diupdate.'); window.location.href='read_form.php';</script>";
        exit();
    } else {
        // Tampilkan pesan kesalahan jika terjadi masalah saat update data
        echo "<script>alert('Gagal mengupdate data. Error: " . $conn->error . "'); window.location.href='read_form.php';</script>";
    }
} else {
    // Jika form tidak disubmit, redirect ke halaman read_form.php
    header("Location: read_form.php");
    exit();
}

// Menutup koneksi
$conn->close();
?>
