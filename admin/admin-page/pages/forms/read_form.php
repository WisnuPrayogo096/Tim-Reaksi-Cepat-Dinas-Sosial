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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil jenis ramah dari form
    $jenis_ramah = $_POST["jenis_ramah"];

    // Query untuk mengambil data dari tabel sesuai dengan jenis ramah yang dipilih
    $query = "SELECT id, tanggal, gambar, judul, desk, isi FROM $jenis_ramah";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Form Read Article</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../vendors/feather/feather.css" />
    <link
      rel="stylesheet"
      href="../../vendors/ti-icons/css/themify-icons.css"
    />
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../vendors/select2/select2.min.css" />
    <link
      rel="stylesheet"
      href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css"
    />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <!-- CSS Manual -->
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <?php include '../partials/_navbar-page.html'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <?php include '../../partials/_settings-panel.html'; ?>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <?php include '../partials/_sidebar-page.html'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Read, Update, and Delete Article</h4>
                    <form
                      class="forms-sample"
                      action="read_form.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="form-group">
                        <label for="exampleFormControlSelect1"
                          >Jenis Ramah Tuna Sosial</label
                        >
                        <select
                          class="form-control"
                          id="exampleFormControlSelect1"
                          name="jenis_ramah"
                          required
                        >
                          <option value="tb_news_lansia">Ramah Lansia</option>
                          <option value="tb_news_rentan">
                            Ramah Kelompok Rentan
                          </option>
                          <option value="tb_news_disab">
                            Ramah Disabilitas
                          </option>
                          <option value="tb_news_anakrentan">
                            Ramah Anak Rentan Sosial
                          </option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">
                        Submit
                      </button>
                      <a href="../../index.php" class="btn btn-light">Cancel</a>
                    </form>
                    <!-- Tabel di bawah tombol Submit -->
                    <?php
                    // Jika hasil query ada, tampilkan data dalam tabel
                    if (isset($result) && $result->num_rows > 0) {
                      // Array untuk mengaitkan kode jenis ramah dengan nama lengkap
                      $jenis_ramah_list = array(
                        'tb_news_lansia' => 'Ramah Lansia',
                        'tb_news_rentan' => 'Ramah Kelompok Rentan',
                        'tb_news_disab' => 'Ramah Disabilitas',
                        'tb_news_anakrentan' => 'Ramah Anak Rentan Sosial'
                    );

                    // Menentukan jenis ramah yang dipilih
                    $jenis_ramah_terpilih = isset($jenis_ramah_list[$_POST['jenis_ramah']]) ? $jenis_ramah_list[$_POST['jenis_ramah']] : '';

                    // Menampilkan jenis ramah yang dipilih
                    echo "<h4 class='card-title' style='margin-top: 30px; text-align: center;'>Data Artikel $jenis_ramah_terpilih</h4>
                    <table class='table' style='margin-top: 20px;'>
                        <thead>
                            <tr>
                                <th scope='col'>No.</th>
                                <th scope='col'>Judul Artikel</th>
                                <th scope='col' style='text-align: center;'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>";
                    
                    // Output data dari setiap baris hasil query
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td class='ellipsis'>{$row['judul']}</td>
                                <td style='padding-left: 0px; padding-right: 0px; text-align: center;'>
                                    <a href='edit_elements.php?id={$row['id']}&jenis_ramah={$jenis_ramah}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='hapus.php?id={$row['id']}&jenis_ramah={$jenis_ramah}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus artikel ini?\")'>Hapus</a>

                                </td>
                            </tr>";
                        $no++;
                    }
                    echo '</tbody>
                            </table>';
                    } else {
                        echo "<h4 class='card-title' style='margin-top: 80px; text-align: center;'>Data masih kosong.</h4>";
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <?php include '../../partials/_footer.html'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="../../vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../../js/file-upload.js"></script>
    <script src="../../js/typeahead.js"></script>
    <script src="../../js/select2.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
