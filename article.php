<!-- article.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <!-- Tambahkan link CSS atau style sesuai kebutuhan -->
</head>
<body>

<?php
// Mengecek apakah parameter 'id' telah diterima melalui URL
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Melakukan koneksi ke database (sesuaikan dengan konfigurasi database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dinsos_trc";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mendapatkan data artikel berdasarkan id
    $query = "SELECT * FROM tb_news_lansia WHERE id = $articleId";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!-- Menampilkan detail artikel -->
        <div class="container text-center layout_padding2">
            <h2 class="mb-4"><?php echo $row['judul']; ?></h2>
            <img src="admin/admin-page/pages/forms/<?php echo $row['gambar']; ?>" alt="" class="img-fluid rounded-circle" style="object-fit: cover; width: 300px; height: 300px; max-width: 100%; max-height: 100%;"/>
            <p class="mb-3"><?php echo $row['desk']; ?></p>
            <p><?php echo $row['isi']; ?></p>
        </div>
        <?php
    } else {
        echo "Artikel tidak ditemukan.";
    }

    // Menutup koneksi
    $conn->close();
} else {
    echo "ID artikel tidak ditemukan.";
}
?>

</body>
</html>
