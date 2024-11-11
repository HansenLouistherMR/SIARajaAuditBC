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
                <a href="<?php echo site_url('admin/Data_perusahaan') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">Tambah Perusahaan dan User</h2>
                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/Data_perusahaan/add') ?>" method="post"
                  enctype="multipart/form-data">

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="fullname">Nama Perusahaan</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('fullname') ? 'is-invalid' : '' ?>" type="text"
                        id="fullname" name="fullname" placeholder="Nama Perusahaan" required />
                    </div>
                  </div>


                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" type="text"
                        id="username" name="username" placeholder="Username" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" type="text"
                        id="password" name="password" placeholder="Password" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Tahun Buku

                      <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/') ?>" style="margin-right: 10px"
                        data-toggle="modal" data-target="#filterModal">
                        <i class="fa fa-plus-square"></i></a>

                    </label>
                    <div class="col-md-6 col-sm-6">


                      <div class="form-group">
                        <label for="tahun_buku">Pilih Tahun Buku</label>
                        <select class="form-control <?php echo form_error('tahun_buku') ? 'is-invalid' : '' ?>"
                          id="tahun_buku" name="tahun_buku">
                          <?php foreach ($data_tahun_buku as $data_tahun_buku_data): ?>
                            <option value="<?php echo $data_tahun_buku_data->tahun ?>">
                              <?php echo $data_tahun_buku_data->tahun ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <?php if (form_error('tahun_buku')): ?>
                          <div class="invalid-feedback">
                            <?php echo form_error('tahun_buku'); ?>
                          </div>
                        <?php endif; ?>
                      </div>


                      <?php if (form_error('username')): ?>
                        <div class="invalid-feedback">
                          <?php echo form_error('username'); ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>


                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="daftar_akun">Akun

                    </label>

                    <div class="col-md-6 col-sm-6">


                      <?php $j = 1; ?>
                      <?php foreach ($data_daftar_akun as $data_daftar_akun_data): ?>

                        <div class="form-check">
                          <input class="form-check-input <?php echo form_error('daftar_akun[]') ? 'is-invalid' : '' ?>"
                            type="checkbox" id="daftar_akun" name="daftar_akun[]"
                            value="<?php echo $data_daftar_akun_data->kode_akun ?>" />
                          <label class="form-check-label" for="daftar_akun">
                            <?php echo $data_daftar_akun_data->nama_akun ?>


                            <!-- <a href="<?php echo site_url('admin/Data_perusahaan/') ?>"
                            style="margin-right: 10px" data-toggle="modal" data-target="#filterModalAkun">
                          <i class="fa fa-info-circle"></i></a>
                          </label> -->

                            <a href="javascript:void(0);" style="margin-right: 10px" data-toggle="modal"
                              data-target="#filterModalAkun"
                              data-id_akun="<?php echo $data_daftar_akun_data->kode_akun ?>">
                              <!-- Pastikan value id_perusahaan yang sesuai -->
                              <i class="fa fa-info-circle"></i>
                            </a>

                        </div>

                        <?php $j++; ?>
                      <?php endforeach; ?>


                      <?php if (form_error('daftar_akun')): ?>
                        <div class="invalid-feedback">
                          <?php echo form_error('daftar_akun'); ?>
                        </div>
                      <?php endif; ?>
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


  <!-- modal -->
  <!-- Filter Modal -->
  <div class="modal fade" id="filterModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> Tambah Tahun Baku </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" action="<?php echo site_url('admin/Data_perusahaan/addTahunBuku') ?>" method="post">
            <div class="form-group col-md-12 col-sm-12">
              <label class="col-form-label col-md-4 col-sm-4 label-align">Tahun Buku : </label>
              <div class="col-md-6 col-sm-6 ">
                <input class="form-control <?php echo form_error('tahun_buku') ? 'is-invalid' : '' ?>" type="text"
                  id="tahun_buku" name="tahun_buku" placeholder="Tahun Buku" required />
              </div>
            </div>
            <br>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Filter Modal -->
  <div class="modal fade" id="filterModalAkun" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Akun</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Data akan diisi di sini melalui AJAX -->
          <p>Memuat data...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Event ketika modal akan dibuka
      $('#filterModalAkun').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Elemen yang men-trigger modal
        var idAkun = button.data('id_akun'); // Ambil nilai id_akun dari data-attribute

        // Tampilkan alert untuk memastikan id perusahaan berhasil ditangkap (Opsional)
        console.log("ID Perusahaan: " + idAkun);

        // Lakukan request AJAX untuk mengambil data berdasarkan ID perusahaan
        $.ajax({
          url: "<?php echo site_url('Admin/Data_perusahaan/getDataRoleAkun'); ?>", // URL controller
          type: "GET",
          data: { id_akun: idAkun }, // Kirim id_akun melalui AJAX
          success: function (response) {
            $('#filterModalAkun .modal-body').html(response); // Isi modal dengan data yang diterima dari server
          },
          error: function (xhr, status, error) {
            console.error("Error: " + error); // Tampilkan error di console jika ada
          }
        });
      });
    });
  </script>





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