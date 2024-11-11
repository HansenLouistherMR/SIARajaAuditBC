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
                <a href="<?php echo site_url('admin/Akun_auditor') ?>"><i class="fa fa-arrow-left"></i>
                  Back</a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">
                    <b>Edit Akun Auditor</b>
                  </h2>
                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/Akun_auditor/edit/' . $edit_akun->no) ?>" method="post"
                  enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $edit_akun->no; ?>">

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="list">List</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('list') ? 'is-invalid' : '' ?>" type="text"
                        id="list" name="list" value="<?php echo $edit_akun->list ?>"
                        placeholder="Nama Menu" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_role">Daftar Akun</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="no_akun" name="no_akun" required>
                        <?php foreach ($Data_akun as $akun): ?>
                          <option value="<?php echo $akun->kode_akun; ?>" <?php echo ($edit_akun->Kode_akun == $akun->kode_akun) ? 'selected' : ''; ?>>
                          <?php echo $akun->kode_akun; ?> -  <?php echo $akun->nama_akun; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>  
                  </div>

                  <!-- <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="link">Nama Link</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('link') ? 'is-invalid' : '' ?>" type="text"
                        id="link" name="link" value="<?php echo $Data_akun->link ?>"
                        placeholder="Nama Menu" readonly />
                    </div>
                  </div> -->

                  <!-- <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kd_icon">Icon</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="kd_icon" name="kd_icon" required>
                        <?php foreach ($Data_icon as $Data_icon): ?>
                          <option value="<?php echo $Data_icon->id; ?>" <?php echo ($Data_akun->kd_icon == $Data_icon->id) ? 'selected' : ''; ?>>
                            <?php echo $Data_icon->nama_icon; ?> (<?php echo $Data_icon->icon_desc; ?>)
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

                  <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                      <input class="btn btn-success" type="submit" name="btn" value="Edit" />
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
        <!-- /page content -->
      </div>
      <!-- footer content -->
      <?php $this->load->view("admin/_partials/footer.php") ?>
      <!-- /footer content -->
    </div>
  </div>
  <!-- MODAL -->
  <?php $this->load->view("admin/_partials/modal.php") ?>

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
          $('[name="biaya_catering"]').val(ui.item.biaya);
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


  </script>


  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url('js/custom.min.js') ?>"></script>



</body>

</html>