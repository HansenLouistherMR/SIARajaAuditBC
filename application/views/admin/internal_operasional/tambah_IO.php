<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/_partials/head.php") ?>

  <link rel="stylesheet" href="<?php echo base_url() . 'css/jquery-ui.css' ?>">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php $this->load->view("admin/_partials/sidebar.php") ?>

      <!-- top navigation -->
      <?php $this->load->view("admin/_partials/navbar.php") ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">

        <div class="row">
          <div class="col-md-12 col-sm-12 ">

            <!-- form Tambah -->

            <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->flashdata('success'); ?>
              </div>
            <?php } else if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                  <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } else if ($this->session->flashdata('warning')) { ?>
                  <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                  </div>
            <?php } else if ($this->session->flashdata('info')) { ?>
                    <div class="alert alert-info">
                      <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
                    </div>
            <?php } ?>

            <div class="card mb-3">
              <div class="card-header">
                <a href="<?php echo site_url('admin/Internal_operasional') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Data Internal Opersional</h2>
                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/Internal_operasional/addIO') ?>" method="post" enctype="multipart/form-data">

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tipe_modul">Tipe Modul</label>
                    <div class="col-md-6 col-sm-6 ">

                      <select class="form-control" id="tipe_modul" name="tipe_modul" required>
                        <option value="">Pilih Modul</option>
                          <option value="1">
                            Daily Report
                          </option>
                          <option value="2">
                            Finalisasi Report
                          </option>
                      </select>

                    </div>
                  </div>
                  
                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_perusahaan">Nama Perusahaan</label>
                    <div class="col-md-6 col-sm-6 ">

                      <select class="form-control" id="kode_perusahaan" name="kode_perusahaan" required>
                        <option value="">Pilih Perusahaan</option>
                        <?php foreach ($Get_data_perusahaan as $Get_data_perusahaan_View): ?>
                          <option value="<?php echo $Get_data_perusahaan_View->kode_user; ?>">
                            <?php echo $Get_data_perusahaan_View->fullname; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun_buku">Tahun Buku</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="tahun_buku" name="tahun_buku" required>
                        <option value="">Pilih Tahun Buku</option>
                        <?php foreach ($Get_taun_buku as $Get_taun_buku_data): ?>
                          <option value="<?php echo $Get_taun_buku_data->tahun; ?>">
                            <?php echo $Get_taun_buku_data->tahun; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="link">Upload File</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kd_icon">Assign To</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="user_upload" name="user_upload">
                        <option value="">Pilih Auditor</option>
                        <?php foreach ($Get_data_auditor as $Get_data_auditor_data): ?>
                          <option value="<?php echo $Get_data_auditor_data->user_id; ?>">
                            <?php echo $Get_data_auditor_data->divisi; ?>
                            -
                            <?php echo $Get_data_auditor_data->fullname; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <input class="btn btn-success" type="submit" name="btn" value="Save" />
                    </div>
                  </div>

                </form>

              </div>

              <div class="card-footer small text-muted">

              </div>

              <!-- /form Tambah -->

            </div>

          </div>
          <br />

        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <?php $this->load->view("admin/_partials/footer.php") ?>
      <!-- /footer content -->

      <!-- MODAL -->
      <?php $this->load->view("admin/_partials/modal.php") ?>
    </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url('assets/nprogress/nprogress.js') ?>"></script>

  <script type="text/javascript">
    $(document).ready(function () {

      $('#nama_siswa').autocomplete({
        source: "<?php echo site_url('admin/bayar_catering/get_autocomplete'); ?>",
        select: function (event, ui) {
          $('[name="nama_siswa"]').val(ui.item.label);
          $('[name="nis"]').val(ui.item.nomor);
          $('[name="kelas"]').val(ui.item.kelas);

        }
      });

    });
  </script>


  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url('assets/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>

  <script src="<?php echo base_url() . 'js/jquery-ui.js' ?>" type="text/javascript"></script>

  <!-- bootstrap-datetimepicker -->
  <script
    src="<?php echo base_url('assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>

  <!-- Initialize datetimepicker -->
  <script type="text/javascript">


    $('#myDatepicker2').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('#myDatepicker3').datetimepicker({
      format: 'YYYY'
    });

    $('#myDatepicker4').datetimepicker({
      format: 'MM'
    });


  </script>


  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url('js/custom.min.js') ?>"></script>



</body>

</html>