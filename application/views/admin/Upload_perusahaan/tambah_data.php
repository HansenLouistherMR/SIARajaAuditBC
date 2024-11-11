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
                        DATA LAPORAN KEUANGAN
                      </h3>
                    </b>

                    <div class="clearfix"></div>

                </div>

              </div>
            </div>
            <!-- Selesai -->


            <!-- Mulai -->

            <form action="<?php echo site_url('admin/Upload_Perusahaan/addAkunPerusahaan') ?>" method="post"
              enctype="multipart/form-data">

              <input class="form-control" type="hidden" id="kode_perusahaan" name="kode_perusahaan"
                value="<?= $kode_perusahaan; ?>" readonly />

              <input class="form-control" type="hidden" id="user_id" name="user_id"
                value="<?= $this->session->userdata('id') ?>" readonly />

              <input class="form-control" type="hidden" id="status_pages" name="status_pages"
                value="<?= $status_pages ?>" readonly />



              <div class="item form-group">
                <div class="col-sm-6 col-md-6" align="center">
                  <!-- <div class="card-box table-responsive"> -->
                  <table class="table table-bordered">
                    <thead>
                      <!-- Masukkan Header -->
                    </thead>
                    <tbody id="table-body" class="col-sm-8 col-md-8">
                      <!-- Data will be appended here -->
                      <!-- Mulai -->
                      <tr>
                        <td>
                          <h2>
                            Nama Perusahaan
                          </h2>

                        </td>
                        <td>
                          <?php if ($this->session->userdata('role') == 3): ?>


                            <input class="form-control <?php echo form_error('nama_perusahaan') ? 'is-invalid' : '' ?>"
                              type="text" id="nama_perusahaan" name="nama_perusahaan"
                              value="<?= $this->session->userdata('fullname'); ?>" placeholder="Nama Perusahaan"
                              readonly />

                          <?php else: ?>

                            <script>
                              function sendDataToController() {
                                var userId = $('#nama_perusahaan').val();

                                alert();
                                $.ajax({
                                  url: "<?= base_url('Admin/Upload_Perusahaan/addperushaanaudit/'); ?>" + userId, // Tambahkan koma untuk memisahkan key-value di objek
                                  type: "POST",
                                  data: { user_id: userId },
                                  success: function (response) {
                                    // Arahkan ke fungsi addperushaanaudit di controller dengan user_id sebagai parameter
                                    window.location.href = "<?= base_url('Admin/Upload_Perusahaan/addperushaanaudit/'); ?>" + userId;
                                  },
                                  error: function (xhr, status, error) {
                                    console.error("AJAX Error: ", status, error);
                                  }
                                });

                                // alert("User ID: " + userId); // Menampilkan User ID sebagai alert (opsional)
                              }
                            </script>

                            <select class="form-control" id="nama_perusahaan" name="nama_perusahaan" required
                              onchange="sendDataToController()">
                              <option value="">Pilih Perusahaan</option>
                              <?php foreach ($Get_data_perusahaan as $Get_data_perusahaan_View): ?>
                                <option value="<?php echo $Get_data_perusahaan_View->kode_perusahaan; ?>" <?php if ($Get_data_perusahaan_View->kode_user == $user_perusahaan)
                                     echo 'selected'; ?>>
                                  <?php echo $user_perusahaan ?> -
                                  <?php echo $Get_data_perusahaan_View->fullname; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>

                            <div id="result">

                            </div>

                          <?php endif; ?>
                        </td>
                      </tr>
                      <!-- Selesai -->

                      <!-- Mulai -->
                      <tr>
                        <td>
                          <h2>
                            Tahun Audit
                          </h2>

                        </td>
                        <td>
                          <select class="form-control" id="tahun_audit" name="tahun_audit" required>
                            <option value="">Pilih Tahun Buku</option>
                            <?php foreach ($Get_taun_buku as $Get_taun_buku_data): ?>
                              <option value="<?php echo $Get_taun_buku_data->tahun; ?>" <?php if ($Get_taun_buku_data->tahun == $user_perusahaan)
                                   echo 'selected'; ?>>
                                <?php echo $Get_taun_buku_data->tahun; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </td>
                      </tr>
                      <!-- Selesai -->

                      <!-- Mulai -->
                      <?php if ($this->session->userdata('role') == 3): ?>
                        <tr>
                          <td colspan="2" align="center">
                            <input class="btn btn-success" type="submit" id="save-button" name="btn" value="Kirim Data" />

                          </td>
                        </tr>
                      <?php endif; ?>
                      <!-- Selesai -->

                    </tbody>
                  </table>

                </div>
              </div>
              <!-- </div> -->
            </form>
            <!-- Selesai -->

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
                        onclick="showDiv('hrd-legal')">HRD & LEGAL</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                        aria-controls="finance-dept" aria-selected="false" style="color: red;"
                        onclick="showDiv('finance-dept')">DEPT. ACC, FINANCE, TAX & Etc.</a>
                    </li>
                    <!-- khusus auditor -->
                    <?php if ($this->session->userdata('role') == 2): ?>

                      <li class="nav-item">
                        <a class="nav-link" id="spm-tab" data-toggle="tab" href="#spm-dept" role="tab"
                          aria-controls="spm-dept" aria-selected="false" style="color: red;"
                          onclick="showDiv('spm-dept')">SPM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                          aria-controls="finance-dept" aria-selected="false" style="color: red;"
                          onclick="showDiv('finance-dept')">SPD REFLET</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                          aria-controls="finance-dept" aria-selected="false" style="color: red;"
                          onclick="showDiv('finance-dept')">PMPJ</a>
                      </li>
                    <?php endif; ?>

                    <!-- muncul ketika auditor memposting laporan keuangan final yang disetujui maka muncul PMPJ 
                        Berbarengan muncul dengan  LAP KEU UNTUK DIFINALKAN
                        -->
                    <li class="nav-item">
                      <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                        aria-controls="finance-dept" aria-selected="false" style="color: red;"
                        onclick="showDiv('finance-dept')">LAP UNTUK DIFINALKAN</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance-dept" role="tab"
                        aria-controls="finance-dept" aria-selected="false" style="color: red;"
                        onclick="showDiv('finance-dept')">LAP DISETUJI FINAL</a>
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
                        <?php $this->load->view("admin/Upload_perusahaan/hrd_legal.php") ?>


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
                        <table border="1" id="" class="display table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th bgcolor="#1471cf" colspan="2" style="color: white;">
                                DOKUMEN SPM
                              </th>
                            </tr>
                            <tr>
                              <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Nama Dokumen</th>
                              <th style="width: 100px;" bgcolor="#9fb7b7">Link File</th>
                              <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Upload File</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Review File</th>

                              <!-- <th style="width: 150px;" bgcolor="#9fb7b7">Sub dokumen</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Sub dokumen</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Checklist</th> -->

                            </tr>
                          </thead>
                          <tbody>


                            <!-- Data will be appended here -->
                            <?php $j = 1; ?>
                            <?php foreach ($get_SPM as $get_SPM_data): ?>
                              <tr>
                                <td align="center"><?php echo $j ?></td>
                                <td align="left"><?php echo $get_SPM_data->nama_dokumen ?></td>
                                <td align="left">
                                  <a href=" <?= base_url('SPM/' . $get_SPM_data->nama_file); ?>" target="_blank">
                                    <?php
                                    echo substr($get_SPM_data->nama_file, 0, 15) . '.....';
                                    ?>
                                  </a>
                                </td>

                                <td align="left">
                                  <?php
                                  // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                  $tanggal_upload = $get_SPM_data->tanggal_upload;

                                  if (isset($tanggal_upload)):
                                    $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                    echo $formatted_date;
                                  else:
                                  endif;
                                  ?>

                                </td>

                                <td align="left">

                                  <!-- Cek data Validasi -->
                                  <!-- Mulai -->

                                  <!-- <form action="aksi_upload_SPM" method="post" enctype="multipart/form-data"> -->
                                  <form action="<?= base_url('Admin/Upload_Perusahaan/aksi_upload_SPM'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="id_spm" value="<?= $get_SPM_data->id; ?>">
                                    <input class="form-control" type="hidden" id="segement3" name="segement3"
                                      value="<?= $segement3; ?>" readonly />
                                    <input type="hidden" name="tahun_audit" id="tahun_audit_hidden" value="">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>

                                  <script>

                                    document.getElementById('uploadForm').addEventListener('submit', function (event) {
                                      var tahunAudit = document.getElementById('tahun_audit').value;

                                      if (tahunAudit === "") {
                                        alert("Pilih Tahun Audit terlebih dahulu!");
                                        event.preventDefault(); // Hentikan submit jika tahun audit belum dipilih
                                      } else {
                                        document.getElementById('tahun_audit_hidden').value = tahunAudit; // Set nilai tahun audit di input hidden
                                      }
                                    });

                                  </script>

                                  <!-- selesau -->

                                </td>


                                <td>
                                  <?php if ($get_SPM_data->status_upload == 1): ?>
                                    Test
                                  <?php endif; ?>
                                </td>
                              </tr>
                              <?php $j++; ?>
                            <?php endforeach; ?>


                          </tbody>
                        </table>

                        <!-- Selesai -->
                      </div>
                    </div>


                  </div>

                  <!-- Selesai Content -->



                  <div class="tab-pane fade" id="finance-dept" role="tabpanel" aria-labelledby="finance-tab">
                    <div class="card-box table-responsive width">
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Laporan - Laporan
                            </th>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <!-- Isi dengan data serupa seperti yang ada pada tabel HRD & LEGAL -->
                          <!-- Data will be appended here -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Laporan as $Get_Laporan_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Laporan_data->list ?></td>
                              <?php if (isset($Get_Laporan_data->file_path) && $Get_Laporan_data->file_path !== null && trim($Get_Laporan_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Laporan_data->nama_akun . '/' . $Get_Laporan_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Laporan_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Laporan_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept" value="<?php echo $Get_Laporan_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Laporan_data->list ?>">
                                    <input type="hidden" name="no_list" value="<?php echo $Get_Laporan_data->no_list ?>">
                                    <input type="hidden" name="no_akun" value="<?php echo $Get_Laporan_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Laporan_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>

                      <!-- Kas dan Setara Kas -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Kas dan Setara Kas
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <!-- Isi dengan data serupa seperti yang ada pada tabel HRD & LEGAL -->
                          <!-- Data will be appended here -->
                          <!-- Data will be appended here -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Kas_Setara_Kas as $Get_Kas_Setara_Kas_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Kas_Setara_Kas_data->list ?></td>
                              <?php if (isset($Get_Kas_Setara_Kas_data->file_path) && $Get_Kas_Setara_Kas_data->file_path !== null && trim($Get_Kas_Setara_Kas_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Kas_Setara_Kas_data->nama_akun . '/' . $Get_Kas_Setara_Kas_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Kas_Setara_Kas_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Kas_Setara_Kas_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Kas_Setara_Kas_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Kas_Setara_Kas_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Kas_Setara_Kas_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Kas_Setara_Kas_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Kas_Setara_Kas_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Deposito Berjangka -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Deposito Berjangka
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->

                          <?php $j = 1; ?>
                          <?php foreach ($Get_Deposit_berjangka as $Get_Deposit_berjangka_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Deposit_berjangka_data->list ?></td>
                              <?php if (isset($Get_Deposit_berjangka_data->file_path) && $Get_Deposit_berjangka_data->file_path !== null && trim($Get_Deposit_berjangka_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Deposit_berjangka_data->nama_akun . '/' . $Get_Deposit_berjangka_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Deposit_berjangka_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Deposit_berjangka_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Deposit_berjangka_data->nama_akun ?>">
                                    <input type="hidden" name="akun"
                                      value="<?php echo $Get_Deposit_berjangka_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Deposit_berjangka_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Deposit_berjangka_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Deposit_berjangka_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Investasi Jangka Pendek -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Investasi Jangka Pendek
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Inv_Jangka_Pendek as $Get_Inv_Jangka_Pendek_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Inv_Jangka_Pendek_data->list ?></td>
                              <?php if (isset($Get_Inv_Jangka_Pendek_data->file_path) && $Get_Inv_Jangka_Pendek_data->file_path !== null && trim($Get_Inv_Jangka_Pendek_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Inv_Jangka_Pendek_data->nama_akun . '/' . $Get_Inv_Jangka_Pendek_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Inv_Jangka_Pendek_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Inv_Jangka_Pendek_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Inv_Jangka_Pendek_data->nama_akun ?>">
                                    <input type="hidden" name="akun"
                                      value="<?php echo $Get_Inv_Jangka_Pendek_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Inv_Jangka_Pendek_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Inv_Jangka_Pendek_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Inv_Jangka_Pendek_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Deposito Berjangka -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Deposito Berjangka
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->

                          <?php $j = 1; ?>
                          <?php foreach ($Get_Deposit_berjangka as $Get_Deposit_berjangka_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Deposit_berjangka_data->list ?></td>
                              <?php if (isset($Get_Deposit_berjangka_data->file_path) && $Get_Deposit_berjangka_data->file_path !== null && trim($Get_Deposit_berjangka_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Deposit_berjangka_data->nama_akun . '/' . $Get_Deposit_berjangka_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Deposit_berjangka_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Deposit_berjangka_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept" value="<?php echo $Get_Legal_HRD_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Legal_HRD_data->list ?>">
                                    <input type="hidden" name="no_list" value="<?php echo $Get_Legal_HRD_data->no_list ?>">
                                    <input type="hidden" name="no_akun" value="<?php echo $Get_Legal_HRD_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Legal_HRD_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Piutang Usaha (AR) -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Piutang Usaha (AR)
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Piutang_Usaha_AR as $Get_Piutang_Usaha_AR_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Piutang_Usaha_AR_data->list ?></td>
                              <?php if (isset($Get_Piutang_Usaha_AR_data->file_path) && $Get_Piutang_Usaha_AR_data->file_path !== null && trim($Get_Piutang_Usaha_AR_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Piutang_Usaha_AR_data->nama_akun . '/' . $Get_Piutang_Usaha_AR_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Piutang_Usaha_AR_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Piutang_Usaha_AR_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>
                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Piutang_Usaha_AR_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Piutang_Usaha_AR_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Piutang_Usaha_AR_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Piutang_Usaha_AR_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Piutang_Usaha_AR_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- selesai -->


                      <!-- Piutang Lain-lain -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Piutang Lain-lain
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Piutang_Lain as $Get_Piutang_Lain_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Piutang_Lain_data->list ?></td>
                              <?php if (isset($Get_Piutang_Lain_data->file_path) && $Get_Piutang_Lain_data->file_path !== null && trim($Get_Piutang_Lain_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Piutang_Lain_data->nama_akun . '/' . $Get_Piutang_Lain_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Piutang_Lain_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Piutang_Lain_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Piutang_Lain_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Piutang_Lain_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Piutang_Lain_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Piutang_Lain_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Piutang_Lain_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Persediaan -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Persediaan
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Het_Persediaan as $Het_Persediaan_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Het_Persediaan_data->list ?></td>
                              <?php if (isset($Het_Persediaan_data->file_path) && $Het_Persediaan_data->file_path !== null && trim($Het_Persediaan_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Het_Persediaan_data->nama_akun . '/' . $Het_Persediaan_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Het_Persediaan_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Het_Persediaan_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept" value="<?php echo $Het_Persediaan_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Het_Persediaan_data->list ?>">
                                    <input type="hidden" name="no_list" value="<?php echo $Het_Persediaan_data->no_list ?>">
                                    <input type="hidden" name="no_akun" value="<?php echo $Het_Persediaan_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Het_Persediaan_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Uang Muka -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Uang Muka
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Uang_muka as $Get_Uang_muka_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Uang_muka_data->list ?></td>
                              <?php if (isset($Get_Uang_muka_data->file_path) && $Get_Uang_muka_data->file_path !== null && trim($Get_Uang_muka_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Uang_muka_data->nama_akun . '/' . $Get_Uang_muka_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Uang_muka_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Uang_muka_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept" value="<?php echo $Get_Uang_muka_data->nama_akun ?>">
                                    <input type="hidden" name="akun" value="<?php echo $Get_Uang_muka_data->list ?>">
                                    <input type="hidden" name="no_list" value="<?php echo $Get_Uang_muka_data->no_list ?>">
                                    <input type="hidden" name="no_akun" value="<?php echo $Get_Uang_muka_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Uang_muka_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                      <!-- selesai -->

                      <!-- Pajak Dibayar Dimuka -->
                      <!-- Mulai -->
                      <table id="" class="display table table-striped table-bordered" style="width:100%">
                        <!-- Tabel DEPT. ACC, FINANCE, TAX & Etc. -->
                        <thead>
                          <tr>
                            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                              Pajak Dibayar Dimuka
                            </th>
                          </tr>
                          </tr>
                          <tr>
                            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                            <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                            <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                            <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Data DEPT. ACC, FINANCE, TAX & Etc. akan ditampilkan di sini -->
                          <?php $j = 1; ?>
                          <?php foreach ($Get_Pajak_dibayar_dimuka as $Get_Pajak_dibayar_dimuka_data): ?>
                            <tr>
                              <td align="center"><?php echo $j ?></td>
                              <td align="left"><?php echo $Get_Pajak_dibayar_dimuka_data->list ?></td>
                              <?php if (isset($Get_Pajak_dibayar_dimuka_data->file_path) && $Get_Pajak_dibayar_dimuka_data->file_path !== null && trim($Get_Pajak_dibayar_dimuka_data->file_path) !== ''): ?>
                                <!-- Your code here when the condition is true -->
                                <td style="background-color: #f4ea94;">
                                  <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Pajak_dibayar_dimuka_data->nama_akun . '/' . $Get_Pajak_dibayar_dimuka_data->nama_file); ?>"
                                    target="_blank">
                                    <?php
                                    echo substr($Get_Pajak_dibayar_dimuka_data->nama_file, 0, 20) . '.....';
                                    ?>
                                  </a>
                                  <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                <?php else: ?>
                                <td style="background-color: #e67272;">

                                </td>
                              <?php endif; ?>

                              <td align="left">
                                <?php
                                // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                $tanggal_upload = $Get_Pajak_dibayar_dimuka_data->tanggal_upload;

                                if (isset($tanggal_upload)):
                                  $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                  echo $formatted_date;
                                else:
                                endif;
                                ?>

                              </td>

                              <?php if ($this->session->userdata('role') == 3): ?>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                    <input type="hidden" name="dept"
                                      value="<?php echo $Get_Pajak_dibayar_dimuka_data->nama_akun ?>">
                                    <input type="hidden" name="akun"
                                      value="<?php echo $Get_Pajak_dibayar_dimuka_data->list ?>">
                                    <input type="hidden" name="no_list"
                                      value="<?php echo $Get_Pajak_dibayar_dimuka_data->no_list ?>">
                                    <input type="hidden" name="no_akun"
                                      value="<?php echo $Get_Pajak_dibayar_dimuka_data->no_akun ?>">
                                    <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                    <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                    <input type="submit" name="submit" value="UPLOAD">
                                  </form>
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <?php echo $Get_Pajak_dibayar_dimuka_data->nama_akun ?>
                                  </form>
                                </td>

                              <?php else: ?>

                                <td align="left">
                                </td>

                                <td align="left">
                                  <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                    <input class="btn btn-success" type="submit" id="save-button" name="btn"
                                      value="Masukkan Komentar" />
                                  </form>
                                </td>

                              <?php endif; ?>

                              <!-- <td align="center">
                                <a href="<?php echo site_url('admin/Upload_Perusahaan/view_data/' . $data_role->kode_perusahaan) ?>"
                                  style="margin-right: 10px"><i class="fa fa-edit"></i> View Data</a>
                              </td> -->
                            </tr>
                            <?php $j++; ?>
                          <?php endforeach; ?>


                        </tbody>
                      </table>
                      <!-- selesai -->

                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div><!-- /card Body-->


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></scrip >

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

                            // selesai

                            //             // Mulai
                            // $('#daftar_akun_all').change(function () {
                            //   var selectedValue = $(this).val();
                            //   console.log("User is Run");

                            //   if (selectedValue) {
                            //     $.ajax({
                            //       url: '<?php echo base_url('admin/Upload_Perusahaan/get_data'); ?>',
                            //       type: 'POST',
                            //       data: { id: selectedValue },
                            //       dataType: 'json',
                            //       success: function (response) {

                            //         // alert("test");
                            //         // alert(selectedValue);

                            //         if (response.status == 'success') {
                            //           var tableBody = $('#table-body');
                            //           tableBody.empty(); // Clear the table body         
                            //           $.each(response.data, function (index, item) {
                            //             var row = '<tr>' +
                            //               '<td>' + (index + 1) + '</td>' + // Nomor urut otomatis
                            //               '<td>' + item.list + '</td>' +
                            //               '<td><input type="file" name="fileToUpload" id="fileToUpload' + index + '"></td>' +
                            //               '</tr>';
                            //             tableBody.append(row);
                            //           });
                            //           $('#table-container').show(); // Show the table

                            //           // selesai


                            // $('#save-button').on('click', function () {
                            //   tableBody.find('tr').each(function (index) {
                            //     var row = $(this);
                            //     var listItem = row.find('td:eq(1)').text();
                            //     var fileInput = row.find('input[type="file"]')[0];
                            //     var file = fileInput.files[0];

                            //     var formData = new FormData();
                            //     formData.append('list', listItem);
                            //     formData.append('fileToUpload', file);


                            //     $.ajax({
                            //       url: '<?php echo site_url('admin/Upload_Perusahaan/simpan_data'); ?>',
                            //       type: 'POST',
                            //       data: formData,
                            //       processData: false,
                            //       contentType: false,
                            //       success: function (response) {
                            //         console.log('Data berhasil disimpan:', response);
                            //       },
                            //       error: function (xhr, status, error) {
                            //         console.error('Gagal menyimpan data:', error);
                            //       }
                            //     });

                            //     // alert("simpan");

                            //   });
                            // });


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