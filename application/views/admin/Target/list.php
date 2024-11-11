<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/_partials/head.php") ?>
</head>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

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
              <!-- <div class="card-header">
                <a href="<?php echo site_url('admin/Menu') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div> -->
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">Target</h2>
                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/Target/add') ?>" method="post" enctype="multipart/form-data">

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_perusahaan">Nama
                      Perusahaan</label>
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
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_file">Nama File yang
                      diuplod</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('nama_file') ? 'is-invalid' : '' ?>" type="text"
                        id="nama_file" name="nama_file" placeholder="Nama File yang diuplod" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="mulai">Mulai Jam menit sampai
                      dengan</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('mulai') ? 'is-invalid' : '' ?>"
                        type="datetime-local" id="mulai" name="mulai" placeholder="Pilih tanggal dan waktu" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="keterangan">Keteranagan
                      Pencapaian</label>
                    <div class="col-md-6 col-sm-6 ">
                      <!-- <input class="form-control <?php echo form_error('keterangan') ? 'is-invalid' : '' ?>" type="text"
                        id="nama_menu" name="nama_menu" placeholder="Keteranagan Pencapaian" required /> -->
                      <textarea id="editor" name="keterangan" rows="10" cols="80">

                       </textarea>
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

            <div class="x_panel">
              <div class="x_title">
                <h2>View Target</h2>
                <!-- <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul> -->
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">

                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama File yang diuplod</th>
                            <th>Waktu Mulai, Sampai dengan</th>
                            <th>Keteranagan Pencapaian</th>
                            <!-- <th>Edit</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php $j = 1; ?>
                          <?php foreach ($data_target as $data_role): ?>

                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $data_role->fullname ?></td>
                              <td align="left"><?php echo $data_role->nama_file ?></td>
                              <td align="left">
                                <?php
                                $tanggal = new DateTime($data_role->mulai);
                                echo $tanggal->format('d F Y H:i:s');
                                ?>
                              </td>
                              <td align="left"><?php echo $data_role->keterangan ?></td>
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /DataTables -->


        </div>
      </div>
      <!-- /page content -->

      <!-- Logout Delete Confirmation-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                Apakah anda yakin?
              </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
              <a id="btn-delete" class="btn btn-danger" href="#">Hapus</a>
            </div>
          </div>
        </div>
      </div>




      <!-- footer content -->
      <?php $this->load->view("admin/_partials/footer.php") ?>
      <!-- /footer content -->
    </div>
  </div>
  <!-- MODAL -->
  <?php $this->load->view("admin/_partials/modal.php") ?>

  <!-- js -->
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
  <!-- NProgress -->
  <script src="<?php echo base_url('assets/nprogress/nprogress.js') ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url('assets/iCheck/icheck.min.js') ?>"></script>

  <!-- Datatables -->
  <script src="<?php echo base_url('assets/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables.net-scroller/js/dataTables.scroller.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/jszip/dist/jszip.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/pdfmake/build/pdfmake.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/pdfmake/build/vfs_fonts.js') ?>"></script>

  <!-- Datatable DSC -->
  <script type="text/javascript">
    $(document).ready(function () {
      $('#list_catering').DataTable({
        "order": [[0, "desc"]]
      });
    });

  </script>

  <script>
    CKEDITOR.replace('editor', {
      removePlugins: 'notification'  // Menyembunyikan notifikasi
    });
  </script>


  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url('js/custom.min.js') ?>"></script>

  <!-- uang -->
  <script
    src="<?php echo base_url('https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js') ?>"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // Format mata uang.
      $('.uang').mask('0.000.000.000', { reverse: true });
    })
  </script>

  <script>
    function deleteConfirm(url) {
      $('#btn-delete').attr('href', url);
      $('#deleteModal').modal();
    }

    // function bayarsppConfirm(url){
    //   $('#btn-bayar').attr('href', url);
    //   $('#bayarModal').modal();
    // }
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


    $('.myDatepicker2').datetimepicker({
      format: 'DD/MM/YYYY'
    });

    $('#myDatepicker3').datetimepicker({
      format: 'YYYY'
    });


  </script>

</body>

</html>