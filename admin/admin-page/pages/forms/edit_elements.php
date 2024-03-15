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

// Mendapatkan ID dan jenis_ramah dari parameter GET
$article_id = $_GET["id"];
$jenis_ramah = $_GET["jenis_ramah"];

// Query untuk membaca data dari tabel sesuai dengan ID
$query = "SELECT id, judul, desk, isi FROM $jenis_ramah WHERE id = $article_id";
$result = $conn->query($query);

// Memeriksa apakah data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // Tampilkan pesan jika data tidak ditemukan
    echo "Data tidak ditemukan.";
}

// Menutup koneksi
$conn->close();
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
    <title>Form Update Article</title>
    <!-- ck-editor:js-->
    <script text="text/javascript" src="../ckeditor/ckeditor.js"></script>
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
                    <h4 class="card-title">Form Update Article</h4>
                    <form
                      class="forms-sample"
                      action="edit.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                    <input type="hidden" name="id" value="<?php echo $article_id; ?>" />
                    <input type="hidden" name="jenis_ramah" value="<?php echo $jenis_ramah; ?>" />
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Ramah Tuna Sosial</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="jenis_ramah" disabled>
                            <?php
                            // Menentukan nilai default
                            $selected_lansia = "";
                            $selected_rentan = "";
                            $selected_disab = "";
                            $selected_anakrentan = "";

                            // Mengatur nilai terpilih berdasarkan jenis_ramah
                            switch ($jenis_ramah) {
                                case 'tb_news_lansia':
                                    $selected_lansia = "selected";
                                    break;
                                case 'tb_news_rentan':
                                    $selected_rentan = "selected";
                                    break;
                                case 'tb_news_disab':
                                    $selected_disab = "selected";
                                    break;
                                case 'tb_news_anakrentan':
                                    $selected_anakrentan = "selected";
                                    break;
                            }
                            ?>
                            <option value="tb_news_lansia" <?php echo $selected_lansia; ?>>Ramah Lansia</option>
                            <option value="tb_news_rentan" <?php echo $selected_rentan; ?>>Ramah Kelompok Rentan</option>
                            <option value="tb_news_disab" <?php echo $selected_disab; ?>>Ramah Disabilitas</option>
                            <option value="tb_news_anakrentan" <?php echo $selected_anakrentan; ?>>Ramah Anak Rentan Sosial</option>
                        </select>
                    </div>

                      <div class="form-group">
                          <label for="exampleInputName1">Judul Berita</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="judul" placeholder="Judul Berita" value="<?php echo $row['judul']; ?>" required />
                      </div>
                      <div class="form-group">
                          <label for="exampleTextarea1">Deskripsi Singkat</label>
                          <textarea class="form-control" id="exampleTextarea1" name="deskripsi" rows="4" required><?php echo $row['desk']; ?></textarea>
                      </div>
                      <div class="form-group">
                          <label>Isi Artikel</label>
                          <textarea class="form-control ckeditor" id="isi" name="isi"><?php echo $row['isi']; ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">
                        Submit
                      </button>
                      <a href="read_form.php" class="btn btn-light"
                        >Cancel</a
                      >
                    </form>
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
