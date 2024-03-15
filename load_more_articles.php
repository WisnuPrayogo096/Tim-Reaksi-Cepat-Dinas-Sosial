<?php
// ... (kode koneksi database yang sudah ada)
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

// Dapatkan offset dan limit dari permintaan
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;

// Query untuk mengambil lebih banyak artikel dari tb_news_lansia
$query = "SELECT * FROM tb_news_lansia LIMIT $offset, $limit";
$result = $conn->query($query);

// Periksa apakah query berhasil
if ($result) {
    // Loop untuk menghasilkan kode HTML dari hasil query
    while ($row = $result->fetch_assoc()) {
        // ... (kode pembuatan HTML yang sudah ada)
        ?>
        <div class="col-lg-4 col-md-6 d-flex mb-4">
          <div class="box flex-fill">
            <a href="" class="box-link">
              <img src="admin/admin-page/pages/forms/<?php echo $row['gambar']; ?>" alt="" class="img-fluid rounded-circle" style="object-fit: cover; width: 10vw; height: 10vw; max-width: 200px; max-height: 200px;"/>
              <div class="card-body">
                <h5 class="judul-artikel font-weight-bold"><?php echo $row['judul']; ?></h5>
                <p class="sinopsis"><?php echo $row['desk']; ?></p>
              </div>
            </a>
          </div>
        </div>
        <?php
    }

    // Bebaskan hasil query
    $result->free_result();
} else {
    // Tangani jika query gagal
    echo "Error: " . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>
