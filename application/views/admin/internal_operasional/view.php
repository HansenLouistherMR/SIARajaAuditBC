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
                <a href="<?php echo site_url('admin/Upload_perusahaan') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">
                  <?php echo $id_perusahaan; ?> 
                  <br>
                  <?php echo $nama_perusahaan; ?> 
                  </h2>
                  <div class="clearfix"></div>

                </div>

                <?php $j = 1; ?>
                          <?php foreach ($view_akun as $v_akun): ?>

                       <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/Upload_Perusahaan/addperushaan') ?>" class="btn btn-info"><i class="fa-solid fa-mouse-pointer"></i> 
                      
                       <?php echo $v_akun->nama_akun ?>
                      </a></ul>


                            <!-- <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $v_akun->nama_akun ?></td>
                              <td align="left"><?php echo $data_role->nama_perusahaan ?></td>
                              <td align="left"><?php echo $data_role->pic ?></td>
                              <td align="left"><?php echo $data_role->tahun_audit ?></td>

                            </tr>
                            <?php $j++; ?> -->
                          <?php endforeach; ?>

                    <!-- <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/Upload_Perusahaan/addperushaan') ?>" class="btn btn-info"><i class="fa-solid fa-mouse-pointer"></i> Tambah</a></ul> -->


                <form action="<?php echo site_url('admin/Menu/add') ?>" method="post" enctype="multipart/form-data">


                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Indeks.</th>
                        <th>No</th>
                        <th>Nama Akun & Keterangan</th>
                        <th>Upload Dokuemn</th>
                        <th>Progres</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                      </tr>
                    </thead>

                    <tbody>
                          <?php $j = 1; ?>
                          <?php foreach ($edit_menu as $data_role): ?>

                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $data_role->kode_perusahaan ?></td>
                              <td align="left"><?php echo $data_role->nama_perusahaan ?></td>
                              <td align="left"><?php echo $data_role->pic ?></td>
                              <td align="left"><?php echo $data_role->tahun_audit ?></td>

                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>


                    <!-- <tbody>

                      <tr>
                        <td align="right" colspan="2">1</td>
                        <td align="left" colspan="5">LAPORAN-LAPORAN</td>
                      </tr>

                      <!-- Mulai -->
                      <tr>
                        <td align="left" colspan="2"></td>
                        <td align="left">Laporan keuangan tahun berjalan yang telah diotorisasi (Direktur)</td>
                        <td align="center">
                          <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>

                        <td align="left">
                          <progress id="file" value="50" max="100"> 100% </progress> 50%
                        </td>
                        <td align="left" bgcolor="#FF3333">
                        </td>
                        <td align="left">
                          31 Desember 2023
                        </td>
                        <!-- Selesai -->

                      <!-- Mulai -->
                      <tr>
                        <td align="left" colspan="2"></td>
                        <td align="left">COA, TB (Format Ms Excel)</td>
                        <td align="center">
                          <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>

                        <td align="left">
                          <progress id="file" value="32" max="100"> 32% </progress>
                        </td>
                        <td align="left" bgcolor="#FF3333">
                        </td>
                        <td align="left">
                          31 Desember 2023
                        </td>
                        
                        <!-- Selesai -->

                      </tr>
                    </tbody> -->


                  </table>



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