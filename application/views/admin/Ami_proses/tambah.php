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
                <a href="<?php echo site_url('admin/Menu') ?>"><i class="fa fa-arrow-left"></i> Back</a>
              </div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <input class="btn btn-success" type="submit" name="btn" value="Save" />
                </div>
              </div>
              <div class="card-body">
                <div class="x_title">
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">IDENTITAS PENJAMINAN MUTU</h2>
                  <h2 class="col-md-12 col-sm-12" style="text-align: center;">UNIVERSITAS MPU TANTULAR JAKARTA</h2>

                  <div class="clearfix"></div>

                </div>

                <form action="<?php echo site_url('admin/Menu/add') ?>" method="post" enctype="multipart/form-data">

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nama_menu">KODE DOKUMEN</label>
                    <div class="col-md-6 col-sm-6 ">
                      <input class="form-control <?php echo form_error('nama_menu') ? 'is-invalid' : '' ?>" type="text"
                        id="nama_menu" name="nama_menu" placeholder="Nama Menu" required />
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="standart_dikti">STANDAR
                      DIKTI</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="kode_role" name="kode_role" required>
                        <option value="">-- Pilih Standar Dikti --</option>
                        <?php foreach ($Data_Standart as $Data_Standart): ?>
                          <option value="<?php echo $Data_Standart->id; ?>"><?php echo $Data_Standart->nama_standart; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="area_audit">AREA AUDIT</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="area_audit" name="area_audit" required
                        onchange="updateTextbox(this.value)">
                        <option value="">-- Pilih Area Audit --</option>
                        <?php foreach ($Area_Audit as $Area_Audit): ?>
                          <option value="<?php echo $Area_Audit->user_id; ?>"
                            data-divisi="<?php echo $Area_Audit->divisi; ?>"><?php echo $Area_Audit->divisi; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="textbox">AUDITEE</label>
                    <div class="col-md-6 col-sm-6">
                      <input type="text" id="textbox" name="textbox" class="form-control" readonly>
                    </div>
                  </div>

                  <script>
                    function updateTextbox(userId) {
                      if (userId === "") {
                        document.getElementById("textbox").value = "";
                        return;
                      }


                      var xhr = new XMLHttpRequest();
                      xhr.open("GET", "Ami/get_divisi?user_id=" + userId, true);
                      xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                          document.getElementById("textbox").value = xhr.responseText;
                        }
                      };


                      xhr.send();
                    }
                  </script>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="kd_icon">TIPE AUDIT</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="kd_icon" name="kd_icon" required>
                        <option value="">-- Tipe Audit --</option>
                        <option value="Reguler">Reguler AMI</option>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="auditor">AUDITOR KETUA</label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="auditor" name="auditor" required">
                        <option value="">-- Pilih Nama Auditor --</option>
                        <?php foreach ($auditor as $auditor): ?>
                          <option value="<?php echo $auditor->user_id; ?>"><?php echo $auditor->fullname; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div id="additional-dropdowns"></div>

                  <div class="form-group">
                    <div class="col-md-3 col-sm-3 offset-md-3">
                      <button type="button" id="addDropdownBtn" class="btn btn-primary">Tambah Auditor</button>
                    </div>
                  </div>





               <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  <script>
                    $(document).ready(function () {
                      var dropdownCounter = 1; // Counter to keep track of the number of dropdowns added
                    

                      $('#addDropdownBtn').click(function () {
                        dropdownCounter++; // Increment the counter

                        var dropdownTemplate = `
                <div class="item form-group" id="dropdown_${dropdownCounter}">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="auditor_${dropdownCounter}">AUDITOR ANGGOTA</label>
                    <div class="col-md-6 col-sm-6">
                        <select class="form-control" id="auditor_${dropdownCounter}" name="auditor[]" required>
                            <option value="">-- Pilih Nama Auditor --</option>
                            <?php foreach ($auditorAnggota as $auditorAnggota): ?>
                                        <option value="<?php echo $auditorAnggota->user_id; ?>"><?php echo $auditorAnggota->fullname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <button type="button" class="btn btn-danger remove-dropdown" data-id="dropdown_${dropdownCounter}">Hapus</button>
                    </div>
                </div>`;
                        $('#additional-dropdowns').append(dropdownTemplate);
                      });

                      // Event delegation to handle dynamically added elements
                      $('#additional-dropdowns').on('click', '.remove-dropdown', function () {
                        var dropdownId = $(this).data('id');
                        $('#' + dropdownId).remove();
                      });
                    });
                  </script>

                  <div id="table-container" style="display:none;">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>pernyataan isi STANDAR  / ASPEK YANG AKAN DIAUDIT (2)</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                        <!-- Data will be appended here -->
                      </tbody>
                    </table>
                  </div>

                  <script>
                    $(document).ready(function () {
                      $('#kode_role').change(function () {
                        var selectedValue = $(this).val();
                        console.log("User is Run");
                        if (selectedValue) {
                          $.ajax({
                            url: '<?php echo base_url('admin/Ami/get_data'); ?>',
                            type: 'POST',
                            data: { id: selectedValue },
                            dataType: 'json',
                            
                            success: function (response) {
                              if (response.status == 'success') {
                                var tableBody = $('#table-body');
                                tableBody.empty(); // Clear the table body

                          


                                $.each(response.data, function (index, item) {
                                  var row = '<tr>' +
                                    '<td>' + (index + 1) + '</td>' + // Nomor urut otomatis
                                    '<td>' + item.nama_pertanyaan_isi + '</td>' +
                                    '</tr>';
                                  tableBody.append(row);
                                });

                                $('#table-container').show(); // Show the table
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