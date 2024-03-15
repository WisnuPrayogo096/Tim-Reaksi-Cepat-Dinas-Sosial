<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Form Create Article</title>
    <!-- ck-editor:js-->
    <script text="text/javascript" src="../ckeditor/ckeditor.js" ></script>
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
                    <h4 class="card-title">Create Article</h4>
                    <form
                      class="forms-sample"
                      action="submit.php"
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
                      <div class="form-group">
                        <label for="exampleInputName1">Judul Berita</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputName1"
                          name="judul"
                          required
                        />
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input
                          type="file"
                          name="img[]"
                          class="file-upload-default"
                          required
                        />
                        <div class="input-group col-xs-12">
                          <input
                            type="text"
                            class="form-control file-upload-info"
                            disabled
                            placeholder="Upload image hanya untuk format .jpg"
                            required
                          />
                          <span class="input-group-append">
                            <button
                              class="file-upload-browse btn btn-primary"
                              type="button"
                            >
                              Upload
                            </button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Deskripsi Singkat</label>
                        <textarea
                          class="form-control"
                          id="exampleTextarea1"
                          name="deskripsi"
                          rows="4"
                        ></textarea>
                      </div>
                      <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea
                          class="form-control ckeditor"
                          id="isi"
                          name="isi"
                        ></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">
                        Submit
                      </button>
                      <a href="../../index.php" class="btn btn-light">Cancel</a>
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
