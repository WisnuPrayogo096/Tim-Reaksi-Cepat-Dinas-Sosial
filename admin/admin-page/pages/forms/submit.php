<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_ramah = $_POST["jenis_ramah"];
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $isi = $_POST["isi"];

    // Set the time zone to WIB (Western Indonesian Time)
    date_default_timezone_set('Asia/Jakarta');

    // Menggunakan datetime saat ini sebagai tanggal
    $tanggal = date("Y-m-d_H-i-s");

    // Mendapatkan ekstensi file yang diupload
    $file_extension = pathinfo($_FILES["img"]["name"][0], PATHINFO_EXTENSION);

    // Menyaring file hanya jika ekstensinya jpg
    if ($file_extension != "jpg") {
        echo '<script>alert("File harus berformat JPG"); window.location.href = "basic_elements.php";</script>';
        exit;
    }

    // Nama file yang disimpan di server, diambil dari jenis_ramah, tanggal, dan waktu upload
    $file_name = $jenis_ramah . "-" . $tanggal;

    // Menyimpan file di server
    $upload_folder = "upload/";
    $format = ".jpg";
    $file_path = $upload_folder . $file_name . $format;
    move_uploaded_file($_FILES["img"]["tmp_name"][0], $file_path);

    // Melakukan koneksi ke database (sesuaikan dengan konfigurasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dinsos_trc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Menyimpan data ke dalam tabel yang sesuai
    $sql = "INSERT INTO $jenis_ramah (tanggal, gambar, judul, desk, isi) VALUES ('$tanggal', '$file_path', '$judul', '$deskripsi', '$isi')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Data berhasil disimpan"); window.location.href = "basic_elements.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
