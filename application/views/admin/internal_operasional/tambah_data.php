<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->load->view("admin/_partials/head.php") ?>

  <link rel="stylesheet" href="<?php echo base_url() . 'css/jquery-ui.css' ?>">
</head>

<style>
  .table-container {
    overflow-x: auto;
    /* Mengaktifkan scroll bar horizontal jika konten terlalu lebar */
    width: 100%;
    /* Mengatur lebar kontainer sesuai kebutuhan */
  }

  table {
    min-width: 1000px;
    /* Atur lebar minimum tabel agar memaksa scroll bar muncul */
    border-collapse: collapse;
    /* Menghilangkan spasi antar border */
  }

  th,
  td {
    padding: 8px;
    /* Menambahkan padding ke dalam sel */
    border: 1px solid #ddd;
    /* Menambahkan border ke sel */
    text-align: left;
    /* Teks rata kiri */
  }
</style>


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
            <?php } else if ($this->session->flashdata('upload')) { ?>
                      <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
                      </div>
            <?php } ?>


            <!-- mulai -->
            <div class="card mb-3">
              <div class="card-header">
                <!-- <a href="<?php echo site_url('admin/Upload_perusahaan') ?>"><i class="fa fa-arrow-left"></i> Back</a> -->
              </div>

              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">
                    <br>
                    <b>

                      <h3>
                        INTERNAL OFFICE
                      </h3>
                    </b>

                    <div class="clearfix"></div>

                </div>

              </div>
            </div>
            <!-- Selesai -->

            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox"><a href="#" data-toggle="modal" data-target="#filterModal"
                    class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul>
                    <ul class="nav navbar-right panel_toolbox"><a href="<?php echo site_url('admin/Internal_operasional/addIO') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a></ul>
                <div class="clearfix"></div>
              </div>

            <!-- Save -->

            <!-- <div class="item form-group">
                  <div class="col-md-12 col-sm-12 offset-md-3">
                    <input class="btn btn-success" type="submit" id="save-button" name="btn" value="Kirim" />
                  </div>
                </div> -->


            <!-- Tambah Modal -->
            <div class="modal fade" id="tambahModal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> Masukkan Kometar </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12 col-sm-12">

                      <input type="hidden" class="form-control" size="20" name="id_perusahaan"
                        placeholder="Masukkan Komentar">
                      <br>
                      <a href="#" data-toggle="modal" data-target="#tambahExcelModal" class="btn btn-success"><i
                          class="fa fa-plus"></i> Simpan</a>

                      <!-- <div class="col-md-6 col-sm-6" align="center">
                      <a href="#"  data-toggle="modal" data-target="#tambahExcelModal" class="btn btn-success"><i class="fa fa-plus"></i> Upload Excel</a>
                      
                    </div> -->
                      <!-- <div class="col-md-6 col-sm-6" align="center">
                      <a href="#"  data-toggle="modal" data-target="#tambahManualModal" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Manual</a>
                      
                    </div> -->
                    </div>

                  </div>
                  <div class="modal-footer">
                    <div class="col-md-12 col-sm-12">
                      <div class="col-md-12">

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <!-- Start Body -->

            <div class="card mb-3">
              <div class="x_panel">
                <!-- <div class="x_title">
                  <h2> Data Siswa Catering Bulan <?php $this->load->helper('bulan_helper');
                  echo bulan($bulan) ?>
                    <?php echo $tahun ?></h2>
                  <div class="clearfix"></div>
                </div> -->
                <div class="x_content">

                  <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="hrd-tab" data-toggle="tab" href="#hrd-legal" role="tab"
                        aria-controls="hrd-legal" aria-selected="true" style="color: red;"
                        onclick="showDiv('hrd-legal')">AKTIVITAS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                        aria-controls="finance-dept" aria-selected="false" style="color: red;"
                        onclick="showDiv('finance-dept')">AUDIT FINAL</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                        aria-controls="finance-dept" aria-selected="false" style="color: red;"
                        onclick="showDiv('finance-dept')">REKONFIRM</a>
                    </li>
                  </ul>

                  <!-- HRD & LEGAL  -->
                  <!-- Mulai Content -->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="hrd-legal" role="tabpanel" aria-labelledby="hrd-tab">
                      <div class="card-box table-responsive width">

                       <!-- top navigation -->
                     <?php $this->load->view("admin/internal_operasional/daily_report.php") ?>


                        <!-- Selesai -->
                      </div>
                    </div>


                  </div>

                  <!-- Selesai Content -->


                  <!-- SPM  -->
                  <!-- Mulai Content -->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="spm-dept" role="tabpanel" aria-labelledby="spm-tab">
                      <div class="card-box table-responsive width">

                        <!-- SPM  -->
                        <!-- mulai -->
                      

                        <!-- Selesai -->
                      </div>
                    </div>

                  </div>

                  <!-- Selesai Content -->

                  <div class="tab-pane fade" id="finance-dept" role="tabpanel" aria-labelledby="finance-tab">
                    <div class="card-box table-responsive width">
                          <!-- top navigation -->
                     <?php $this->load->view("admin/internal_operasional/audit_final.php") ?>


                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div><!-- /card Body-->


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

          <script>
            $(document).ready(function () {


              // alert($('#daftar_akun').length);
              // Mulai
              $('#daftar_akun').change(function () {
                var selectedValue = $(this).val();
                console.log("User is Run");

                if (selectedValue) {
                  $.ajax({
                    url: '<?php echo base_url('admin/Upload_Perusahaan/get_data'); ?>',
                    type: 'POST',
                    data: { id: selectedValue },
                    dataType: 'json',
                    success: function (response) {

                      // alert("test");
                      // alert(selectedValue);

                      if (response.status == 'success') {
                        var tableBody = $('#table-body');
                        tableBody.empty(); // Bersihkan isi tabel

                        var tableBody = $('#table-body');
                        tableBody.empty(); // Bersihkan isi tabel

                        $.each(response.data, function (index, item) {
                          var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' + // Nomor urut otomatis
                            // '<td>' + item.nama_akun + '</td>' +
                            '<td>' + item.list + '</td>';


                          // Cek jika item.no_list tidak kosong atau tidak null
                          if (item.file_path !== undefined && item.file_path !== null && item.file_path.trim() !== '') {
                            row += '<td style="background-color: #f4ea94;">' +
                              // '<a href="' + item.file_path + '" target="_blank">' + item.file_path + '</a>' +
                              '<a href="' + item.file_path + '" target="_blank">' + item.file_path.substr(0, 10) + '</a>'
                            '</td>';
                          } else {
                            row += '<td>' + item.file_path + '</td>';
                          }

                          //  $value = "Hello, World!";  
                          // echo substr($value, 0, 5); // Outputs: Hello 

                          row += '<td>' +
                            '<form action="aksi_upload" method="post" enctype="multipart/form-data">' +
                            '<input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">' +
                            '<input type="hidden" name="dept" value="' + item.nama_akun + '">' +
                            '<input type="hidden" name="akun" value="' + item.list + '">' +
                            '<input type="hidden" name="no_list" value="' + (item.no_list || '') + '">' +
                            '<input type="hidden" name="no_akun" value="' + item.no_akun + '">' +
                            '<input type="file" size="20" name="fileToUpload" id="fileToUpload' + index + '">' +
                            '<input type="submit" name="submit" value="UPLOAD">' +
                            '</form>' +
                            '</td>' +
                            '</tr>';

                          tableBody.append(row);
                          document.getElementById("nama_akun_header").value = item.nama_akun;
                        });


                        $('#table-container').show(); // Tampilkan tabel


                      } else {
                        alert('No data found');
                        $('#table-container').hide(); // Hide the table
                      }
                    }
                  });
                } else {
                  $('#table-container').hide(); // Hide the table if no value is selected
                }
              });
            });
          </script>




          <!-- <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kode_role">No</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="kode_role" name="kode_role" required>
                        <option value="">Pilih Role</option>
                        <?php foreach ($Data_role as $role): ?>
                          <option value="<?php echo $role->kode_role; ?>"><?php echo $role->nama_role; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->

          <!-- <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="link"> Nama Akun &
                      Keterangan</label>
                    <div class="col-md-6 col-sm-6 ">
                      <select class="form-control" id="nama_akun" name="nama_akun" required>
                        <option value="">Pilih List</option>
                        <?php foreach ($Data_role as $role): ?>
                          <option value="<?php echo $role->kode_role; ?>"><?php echo $role->nama_role; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div> -->




        </div>

        <div class="card-footer small text-muted">

        </div>



        <!-- Mulai -->

        <!-- <h3>Pilih gambar dari komputer Anda dan klik UPLOAD</h3>
              <?php echo @$error; ?>
              <?php echo form_open_multipart('admin/Upload_Perusahaan/aksi_upload'); ?>
              <?php echo "<input type='file' name='fileToUpload' size='20' />"; ?>
              <br>
              <br>
              <?php echo "<input type='submit' name='submit' value='UPLOAD' /> "; ?>
              <?php echo "</form>" ?> -->

        <!-- Selesai -->

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
  <script type="text/javascript">
    $(document).ready(function () {
      $('table.display').DataTable();
    });


  </script>

  <script>
    function showDiv(divId) {


      // Sembunyikan semua div dengan id 'hrd-legal' dan 'finance-dept'
      document.getElementById('hrd-legal').style.display = 'none';
      document.getElementById('finance-dept').style.display = 'none';
      document.getElementById('spm-dept').style.display = 'none';


      // Tampilkan div yang dipilih
      document.getElementById(divId).style.display = 'block';

    }

    // Tampilkan div pertama secara default
    document.getElementById('hrd-legal').style.display = 'block';
    document.getElementById('finance-dept').style.display = 'none';
    document.getElementById('spm-dept').style.display = 'none';

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