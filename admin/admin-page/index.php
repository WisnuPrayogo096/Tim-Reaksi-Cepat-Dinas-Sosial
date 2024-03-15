<?php
// Sesuaikan dengan nama session yang digunakan di proses_login.php
session_start();

// Periksa apakah session 'username' ada
if (isset($_SESSION['username'])) {
    $welcomeMessage = "Welcome " . $_SESSION['username'];
} else {
    $welcomeMessage = "Welcome"; // Pesan default jika session tidak ada
}

// Pengecekan session
if (!isset($_SESSION['username'])) {
  // Session tidak ada, arahkan kembali ke halaman login
  echo '<script>alert("Tidak diizinkan masuk tanpa login!"); window.location.href = "../index.php";</script>';
  exit();
}

$link = @mysqli_connect("localhost", "root", "", "dinsos_trc");

// Memeriksa koneksi
if (!$link) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_select_db($link, "dinsos_trc");

// tb_news_disab
$result = mysqli_query($link, "SELECT * FROM tb_news_disab");
$news_disab = mysqli_num_rows($result);
// Query untuk mendapatkan tanggal paling terakhir dari tb_news_disab
$result_disab = mysqli_query($link, "SELECT COALESCE(DATE_FORMAT(MAX(tanggal), '%d-%m-%Y'), '-') AS last_published_disab FROM tb_news_disab");
$row_disab = mysqli_fetch_assoc($result_disab);
$last_published_disab = $row_disab['last_published_disab'];

// tb_news_disab
$result2 = mysqli_query($link, "SELECT * FROM tb_news_lansia");
$news_lansia = mysqli_num_rows($result2);
// Query untuk mendapatkan tanggal paling terakhir dari tb_news_lansia
$result_lansia = mysqli_query($link, "SELECT COALESCE(DATE_FORMAT(MAX(tanggal), '%d-%m-%Y'), '-') AS last_published_lansia FROM tb_news_lansia");
$row_lansia = mysqli_fetch_assoc($result_lansia);
$last_published_lansia = $row_lansia['last_published_lansia'];

// tb_news_rentan
$result3 = mysqli_query($link, "SELECT * FROM tb_news_rentan");
$news_rentan = mysqli_num_rows($result3);
// Query untuk mendapatkan tanggal paling terakhir dari tb_news_rentan
$result_rentan = mysqli_query($link, "SELECT COALESCE(DATE_FORMAT(MAX(tanggal), '%d-%m-%Y'), '-') AS last_published_rentan FROM tb_news_rentan");
$row_rentan = mysqli_fetch_assoc($result_rentan);
$last_published_rentan = $row_rentan['last_published_rentan'];

// tb_news_anakrentan
$result3 = mysqli_query($link, "SELECT * FROM tb_news_anakrentan");
$news_anakrentan = mysqli_num_rows($result3);
// Query untuk mendapatkan tanggal paling terakhir dari tb_news_anakrentan
$result_anakrentan = mysqli_query($link, "SELECT COALESCE(DATE_FORMAT(MAX(tanggal), '%d-%m-%Y'), '-') AS last_published_anakrentan FROM tb_news_anakrentan");
$row_anakrentan = mysqli_fetch_assoc($result_anakrentan);
$last_published_anakrentan = $row_anakrentan['last_published_anakrentan'];

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
    <title>Dashboard Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css" />
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link
      rel="stylesheet"
      href="vendors/datatables.net-bs4/dataTables.bootstrap4.css"
    />
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="js/select.dataTables.min.css"
    />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>
    <!-- Javascript -->
    <script>
      function fetchTemperature() {
        // Ganti dengan URL XML sesuai kebutuhan
        const xmlUrl =
          "https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml";

        fetch(xmlUrl)
          .then((response) => response.text())
          .then((xmlData) => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlData, "application/xml");

            // Ganti dengan deskripsi area yang diinginkan
            const areaDescription = "Batu";

            // Dapatkan waktu saat ini
            const currentTime = new Date();

            // Set waktu menjadi waktu yang sesuai dengan interval update (misalnya: 00:00, 06:00, 12:00, 18:00)
            const updateTimes = [0, 6, 12, 18];
            const updateHour = updateTimes.find(
              (hour) => currentTime.getHours() < hour
            );

            // Hitung waktu terakhir update
            const lastUpdateTime = new Date(currentTime);
            lastUpdateTime.setHours(updateHour, 0, 0, 0);

            // Dapatkan timestamp untuk pencarian data
            const currentTimestamp = `${lastUpdateTime.getFullYear()}${(
              lastUpdateTime.getMonth() + 1
            )
              .toString()
              .padStart(2, "0")}${lastUpdateTime
              .getDate()
              .toString()
              .padStart(2, "0")}${lastUpdateTime
              .getHours()
              .toString()
              .padStart(2, "0")}00`;

            const areaElement = xmlDoc.querySelector(
              `area[description="${areaDescription}"]`
            );
            const temperatureElement = areaElement.querySelector(
              `parameter[id="t"] timerange[type="hourly"][datetime="${currentTimestamp}"] value[unit="C"]`
            );

            const temperatureValue = temperatureElement.textContent;

            document.getElementById(
              "temperature-container"
            ).innerHTML = `<i class="icon-sun mr-2"></i>${temperatureValue}°C`;
          })
          .catch((error) => {
            console.error("Error fetching data:", error);
            document.getElementById("temperature-container").innerHTML =
              "<i class='icon-sun mr-2'></i>Error fetching data";
          });
      }

      // Panggil fetchTemperature setiap detik (1000 ms)
      setInterval(fetchTemperature, 1000);
    </script>
    <!-- End Javascript -->
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include 'partials/_navbar.html'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <?php include 'partials/_settings-panel.html'; ?>
        <?php include 'partials/_sidebar.html'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"><?php echo $welcomeMessage; ?></h3>
                    <h6 class="font-weight-normal mb-0">
                      All systems are
                      <span class="text-primary">running smoothly!</span>
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="images/dashboard/people.svg" alt="people" />
                    <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h2
                            id="temperature-container"
                            class="mb-0 font-weight-normal"
                          >
                            <i class="icon-sun mr-2"></i>Loading...
                          </h2>
                        </div>
                        <div class="ml-2">
                          <h4 class="location font-weight-normal">Batu</h4>
                          <h6 class="font-weight-normal">Indonesia</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">News Ramah Lansia</p>
                        <p class="fs-30 mb-2"><?php echo $news_lansia; ?></p>
                        <p>Last Published : <?php echo $last_published_lansia; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">News Ramah Kelompok Rentan</p>
                        <p class="fs-30 mb-2"><?php echo $news_rentan; ?></p>
                        <p>Last Published : <?php echo $last_published_rentan; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">News Ramah Disabilitas</p>
                        <p class="fs-30 mb-2"><?php echo $news_disab; ?></p>
                        <p>Last Published : <?php echo $last_published_disab; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                      <p class="mb-4">News Ramah Anak Rentan Sosial</p>
                        <p class="fs-30 mb-2"><?php echo $news_anakrentan; ?></p>
                        <p>Last Published : <?php echo $last_published_anakrentan; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include 'partials/_footer.html'; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
  </body>
</html>
