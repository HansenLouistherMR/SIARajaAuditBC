  <!-- HRD & LEGAL  -->
                        <!-- mulai -->
                        <table border="1" id="" class="display table table-striped table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th bgcolor="#1471cf" colspan="2" style="color: white;">
                                LEGALITAS
                              </th>
                            </tr>
                            <tr>
                              <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                              <th style="width: 100px;" bgcolor="#9fb7b7">Nama File</th>
                              <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                              <th style="width: 150px;" bgcolor="#9fb7b7"></th>
                              <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                            </tr>
                          </thead>
                          <tbody>


                            <!-- Data will be appended here -->
                            <?php $j = 1; ?>
                            <?php foreach ($Get_Legal_HRD as $Get_Legal_HRD_data): ?>
                              <tr>
                                <td align="center"><?php echo $j ?></td>
                                <td align="left"><?php echo $Get_Legal_HRD_data->list ?></td>
                                <?php if ( $Get_Legal_HRD_data->status_upload !== null): ?>

                                  <!-- Your code here when the condition is true -->
                                  <!-- Cek Validasi selesai   -->
                                  <?php if ($Get_Legal_HRD_data->status_upload == 1): ?>

                                    <td style="background-color: #5fff57;">
                                    <?php echo $Get_Legal_HRD_data->status_upload ?>
                                      <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Legal_HRD_data->nama_akun . '/' . $Get_Legal_HRD_data->nama_file); ?>"
                                        target="_blank">
                                        <?php
                                        echo substr($Get_Legal_HRD_data->nama_file, 0, 15) . '.....';
                                        ?>
                                      </a>
                                      </td>
                                    <?php else: ?>

                                    <td style="background-color: #f4ea94;">
                                      <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Legal_HRD_data->nama_akun . '/' . $Get_Legal_HRD_data->nama_file); ?>"
                                        target="_blank">
                                        <?php
                                        echo substr($Get_Legal_HRD_data->nama_file, 0, 15) . '.....';
                                        ?>
                                      </a>
                                    <?php endif; ?>
                                    <!-- Selesai -->

                                    <!-- <a href="http://localhost/rajaaudit/uploads/RAJAAUDIT0004/HRD%20&%20LEGAL/Template_Script_Konten_Inti_Kursus_Online_ver_1_3_(1).docx">About us</a>                                </td> -->
                                  <?php else: ?>
                                  <td style="background-color: #e67272;">
   
                                  </td>
                                <?php endif; ?>

                                <td align="left">
                                  <?php
                                  // Assuming $Get_Legal_HRD_data->tanggal_upload contains the datetime string  
                                  $tanggal_upload = $Get_Legal_HRD_data->tanggal_upload;

                                  if (isset($tanggal_upload)):
                                    $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
                                    echo $formatted_date;
                                  else:
                                  endif;
                                  ?>

                                </td>

                                <?php if ($this->session->userdata('role') == 3): ?>

                                  <td align="left">

                                    <!-- Cek data Validasi -->
                                    <!-- Mulai -->
                                    <?php if ($Get_Legal_HRD_data->status_upload != 1): ?>
                                      <form action="aksi_upload" method="post" enctype="multipart/form-data" id="uploadFormhrd">
                                        <input type="hidden" size="20" name="id_perusahaan" value="<?= $kode_perusahaan; ?>">
                                        <input type="hidden" name="dept" value="<?php echo $Get_Legal_HRD_data->nama_akun ?>">
                                        <input type="hidden" name="akun" value="<?php echo $Get_Legal_HRD_data->list ?>">
                                        <input type="hidden" name="no_list"
                                          value="<?php echo $Get_Legal_HRD_data->id_list ?>">
                                        <input class="form-control" type="hidden" id="status_pages_upload"
                                          name="status_pages_upload" value="<?= $status_pages ?>" readonly />
                                          <input type="hidden" name="tahun_audit" id="tahun_audit_hidden" value="">
                                        <input type="hidden" name="no_akun"
                                          value="<?php echo $Get_Legal_HRD_data->Kode_Akun ?>">
                                        <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                        <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                        <input type="submit" name="submit" value="UPLOAD">
                                      </form>
                                    <?php endif; ?>
                                    <!-- selesau -->

                                  </td>

                                  <script>
                                    document.getElementById('uploadFormhrd').addEventListener('submit', function (event) {
                                      var tahunAudit = document.getElementById('tahun_audit').value;
                                 //     alert("test");
                                      if (tahunAudit === "") {
                                        alert("Pilih Tahun Audit terlebih dahulu!");
                                        event.preventDefault(); // Hentikan submit jika tahun audit belum dipilih
                                      } else {
                                        document.getElementById('tahun_audit_hidden').value = tahunAudit; // Set nilai tahun audit di input hidden
                                      }
                                    });
                                  </script>

                                  <td align="left">
                                    <!-- <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                          <?php echo $Get_Legal_HRD_data->nama_akun ?>
                                        </form> -->
                                    <?php echo $Get_Legal_HRD_data->komentar ?>


                                  </td>

                                <?php else: ?>

                                  <td align="left">
                                  </td>

                                  <td align="left">

                                    <!-- <ul class="nav navbar-right panel_toolbox"><a href="#" data-toggle="modal"
                                            data-target="#tambahModal" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                            Masukkan Komentar</a></ul> -->

                                    <?php if (isset($Get_Legal_HRD_data->file_path) && $Get_Legal_HRD_data->file_path !== null && trim($Get_Legal_HRD_data->file_path) !== ''): ?>
                                      <!-- Cek Vlidasi -->
                                      <!-- Mulai -->
                                      <?php if ($Get_Legal_HRD_data->status_upload == 1): ?>
                                        <?= $Get_Legal_HRD_data->komentar; ?>
                                      <?php else: ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"
                                          onclick="setValues('<?php echo $kode_perusahaan; ?>', '<?php echo $Get_Legal_HRD_data->no_list; ?>')">
                                          Validasi
                                        </button>
                                      <?php endif; ?>
                                      <!-- Selesai -->

                                    <?php else: ?>
                                      -- Data Upload Masih Kosong --
                                    <?php endif; ?>
                                  </td>

                                <?php endif; ?>

                              </tr>
                              <?php $j++; ?>
                            <?php endforeach; ?>


                          </tbody>
                        </table>

                        <!-- Selesai -->






                        
                        <!-- Save Model Audit -->
                        <div class="modal fade" id="SaveModelAuidt" tabindex="-1" role="dialog"
                          aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <div class="modal-body">Data akan disimpan.</div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <a id="btn-save-audit" class="btn btn-success" href="#">Simpan</a>
                              </div>
                            </div>
                          </div>
                        </div>


                           <!-- Akta  -->
                        <!-- mulai -->
                        <div class="table-container">
                          <table border="1" id="" class="display table table-striped table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th bgcolor="#1471cf" colspan="2" style="color: white;">
                                  AKTA
                                </th>
                              </tr>
                              <tr>
                                <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
                                <th style="width: 150px;" bgcolor="#9fb7b7">Keterangan</th>
                                <th style="width: 150px;" bgcolor="#9fb7b7">Nama File</th>
                                <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Upload</th>
                                <th style="width: 50px;" bgcolor="#9fb7b7"></th>
                                <th style="width: 100px;" bgcolor="#9fb7b7">File</th>
                                <!-- <th style="width: 100px;" bgcolor="#9fb7b7">Nomor Akta</th>
                                <th style="width: 100px;" bgcolor="#9fb7b7">Tanggal Akta</th>
                                <th style="width: 50px;" bgcolor="#9fb7b7">Perubahan Akta</th> -->
                                <th style="width: 150px;" bgcolor="#9fb7b7">Validasi Auditor</th>
                              </tr>
                            </thead>
                            <tbody>


                              <!-- Panggil data Akta Perubahan -->
                              <!-- mulai -->
                              <script>
                                $(document).ready(function () {
                                  $('#minusButton').click(function () {
                                    alert();
                                    $('#tableDiv').toggle(); // Tampilkan atau sembunyikan div
                                  });
                                });
                              </script>
                              <!-- Selesai -->


                              <!-- Data will be appended here -->
                              <?php $j = 1; ?>
                              <?php foreach ($Get_Akata as $Get_Akata_data): ?>
                                <tr>
                                  <td align="center"><?php echo $j ?></td>
                                  <td align="left"><?php echo $Get_Akata_data->list ?>

                                    <?php if ($Get_Akata_data->no_list == 22): ?>

                                      <button id="minusButton">-</button>
                                    <?php endif; ?>

                                  </td>
                                  <?php if (isset($Get_Akata_data->file_path) && $Get_Akata_data->file_path !== null && trim($Get_Akata_data->file_path) !== ''): ?>
                                    <!-- Your code here when the condition is true -->
                                    <td style="background-color: #f4ea94;">
                                      <a href=" <?= base_url('uploads/' . $kode_perusahaan . '/' . $Get_Akata_data->nama_akun . '/' . $Get_Akata_data->nama_file); ?>"
                                        target="_blank">
                                        <?php
                                        echo substr($Get_Akata_data->nama_file, 0, 15) . '.....';
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
                                    $tanggal_upload = $Get_Akata_data->tanggal_upload;

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
                                        <input type="hidden" size="20" name="id_perusahaan"
                                          value="<?= $kode_perusahaan; ?>">
                                        <input type="hidden" name="dept" value="<?php echo $Get_Akata_data->nama_akun ?>">
                                        <input type="hidden" name="akun" value="<?php echo $Get_Akata_data->list ?>">
                                        <input type="hidden" name="no_list" value="<?php echo $Get_Akata_data->no_list ?>">
                                        <input class="form-control" type="hidden" id="status_pages_upload"
                                          name="status_pages_upload" value="<?= $status_pages ?>" readonly />
                                        <input type="hidden" name="no_akun" value="<?php echo $Get_Akata_data->no_akun ?>">
                                        <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                        <!-- <input type="file" size="20" name="fileToUpload" id="fileToUpload<?php echo $j ?>"> -->

                                        <input type="submit" name="submit" value="UPLOAD">
                                      </form>
                                    </td>

                                    <td align="left">
                                      <?php if ($Get_Akata_data->no_list == 22): ?>

                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                          data-target="#ModalAktaPerubahan"
                                          onclick="setValues('<?php echo $kode_perusahaan; ?>', '<?php echo $Get_Legal_HRD_data->no_list; ?>')">
                                          Pilih Perubahan
                                        </button>
                                      <?php endif; ?>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalAktaPerubahan" tabindex="-1" role="dialog"
                                      aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Tambah Perubahan Akta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form id="dataForm">
                                              <div class="form-group">
                                                <label for="inputData">Nomor</label>
                                                <input
                                                  class="form-control <?php echo form_error('nama_perusahaan') ? 'is-invalid' : '' ?>"
                                                  type="text" id="nama_perusahaan" name="nama_perusahaan"
                                                  placeholder="Nomor Akta" required />
                                              </div>
                                              <div class="form-group">
                                                <label for="inputData">Tanggal Akta</label>
                                                <input
                                                  class="form-control <?php echo form_error('nama_perusahaan') ? 'is-invalid' : '' ?>"
                                                  type="text" id="nama_perusahaan" name="nama_perusahaan"
                                                  placeholder="Tanggal Akta" required />
                                              </div>
                                              <div class="form-group">
                                                <label for="inputData">Perubahan Akta</label>
                                                <select class="form-control" id="daftar_akun" name="daftar_akun" required>
                                                  <option value="1">Perihal Struktur</option>
                                                  <option value="1">Perihal Pemegang Saham</option>
                                                  <option value="1">Perihal Struktur & Pemegang Saham</option>
                                                  <option value="1">Perihal Anggaran Dasar & KBLI</option>
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                <label for="inputData">Upload File </label>
                                                <input type="file" size="20" name="fileToUpload" id="fileToUpload">
                                              </div>
                                              <!-- Input hidden untuk menyimpan dua nilai -->
                                              <input type="hidden" id="kodePerusahaan" name="kodePerusahaan">
                                              <input type="hidden" id="noList" name="noList">
                                            </form>
                                          </div>
                                          <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan Validasi</button> -->
                                            <button type="button" class="btn btn-secondary"
                                              onclick="CanceData()">Batalkan</button>
                                            <button type="button" class="btn btn-primary"
                                              onclick="submitData()">Simpan</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- <td align="left">
                                      <input
                                        class="form-control <?php echo form_error('nama_perusahaan') ? 'is-invalid' : '' ?>"
                                        type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nomor Akta"
                                        required />
                                    </td>

                                    <td align="left">
                                      <input
                                        class="form-control <?php echo form_error('nama_perusahaan') ? 'is-invalid' : '' ?>"
                                        type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Tanggal Akta"
                                        required />
                                    </td>

                                    <td align="left">
                                      <select class="form-control" id="daftar_akun" name="daftar_akun" required>
                                        <option value="1">Perihal Struktur</option>
                                        <option value="1">Perihal Pemegang Saham</option>
                                        <option value="1">Perihal Struktur & Pemegang Saham</option>
                                        <option value="1">Perihal Anggaran Dasar & KBLI</option>
                                      </select>
                                    </td> -->

                                    <td align="left">
                                      <!-- <form action="aksi_upload" method="post" enctype="multipart/form-data">
                                          <?php echo $Get_Legal_HRD_data->nama_akun ?>
                                        </form> -->

                                      -- Komentar Masih Kosong --
                                    </td>

                                  <?php else: ?>

                                    <td align="left">
                                    </td>

                                    <td align="left">

                                      <input type="hidden" name="no_akun"
                                        value="<?php echo $Get_Legal_HRD_data->no_akun ?>">

                                      <ul class="nav navbar-right panel_toolbox"><a href="#" data-toggle="modal"
                                          data-target="#tambahModal" class="btn btn-success">
                                          <i class="fa fa-plus"></i>
                                          Masukkan Komentar</a></ul>

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

                          <style>
                            #tableDiv {
                              display: none;
                              /* Sembunyikan div pada awalnya */
                              margin-top: 20px;
                            }

                            table {
                              width: 100%;
                              border-collapse: collapse;
                            }

                            table,
                            th,
                            td {
                              border: 1px solid black;
                            }

                            th,
                            td {
                              padding: 10px;
                              text-align: left;
                            }
                          </style>


                          <!-- Div yang akan ditampilkan -->
                          <div id="tableDiv">
                            <table>
                              <thead>
                                <tr>
                                  <th>Kolom 1</th>
                                  <th>Kolom 2</th>
                                  <th>Kolom 3</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Data 1</td>
                                  <td>Data 2</td>
                                  <td>Data 3</td>
                                </tr>
                                <tr>
                                  <td>Data 4</td>
                                  <td>Data 5</td>
                                  <td>Data 6</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Validasi Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form id="dataForm">
                                  <div class="form-group">
                                    <label for="inputData">Data</label>
                                    <input type="text" class="form-control" id="inputData" name="data"
                                      placeholder="Masukkan Koemntar">
                                  </div>
                                  <!-- Input hidden untuk menyimpan dua nilai -->
                                  <input type="hidden" id="kodePerusahaan" name="kodePerusahaan">
                                  <input type="hidden" id="noList" name="noList">
                                </form>
                              </div>
                              <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan Validasi</button> -->
                                <button type="button" class="btn btn-secondary" onclick="CanceData()">Batalkan
                                  Validasi</button>
                                <button type="button" class="btn btn-primary" onclick="submitData()">Kirim Ke
                                  Client</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Save data Pop Up -->
                        <script>
                          function setValues(kodePerusahaan, noList) {
                            console.log('kodePerusahaan:', kodePerusahaan); // Debug
                            console.log('noList:', noList); // Debug
                            $('#kodePerusahaan').val(kodePerusahaan);
                            $('#noList').val(noList);
                          }

                          function submitData() {
                            var kodePerusahaan = $('#kodePerusahaan').val();
                            var noList = $('#noList').val();
                            var data = $('#inputData').val();

                            $.ajax({
                              url: '<?php echo base_url("Admin/Upload_Perusahaan/addVlidasi"); ?>', // Ganti dengan URL ke controller
                              type: 'POST',
                              data: {
                                kodePerusahaan: kodePerusahaan,
                                noList: noList,
                                data: data
                              },
                              success: function (response) {
                                $('#myModal').modal('hide');
                                $('#SaveModelAuidt').modal('show');

                                $('#btn-save-audit').on('click', function () {
                                  window.location.href = "<?php echo base_url('Admin/Upload_Perusahaan/addperushaanaudit'); ?>/" + <?= $user_perusahaan; ?>;
                                });
                              },

                              error: function () {
                                alert("Terjadi kesalahan, coba lagi.");
                              }
                            });
                          }


                          function CanceData() {

                            alert(Test);
                            // var kodePerusahaan = $('#kodePerusahaan').val();
                            // var noList = $('#noList').val();
                            // var data = $('#inputData').val();

                            // $.ajax({
                            //   url: '<?php echo base_url("Admin/Upload_Perusahaan/method_name"); ?>', // Ganti dengan URL ke controller
                            //   type: 'POST',
                            //   data: {
                            //     kodePerusahaan: kodePerusahaan,
                            //     noList: noList,
                            //     data: data
                            //   },
                            //   success: function (response) {
                            //     $('#myModal').modal('hide');
                            //     $('#SaveModelAuidt').modal('show');

                            //     $('#btn-save-audit').on('click', function () {
                            //       window.location.href = "<?php echo base_url('Admin/Upload_Perusahaan/addperushaanaudit'); ?>/" + <?= $user_perusahaan; ?>;
                            //     });
                            //   },

                            //   error: function () {
                            //     alert("Terjadi kesalahan, coba lagi.");
                            //   }
                            // });
                          }
                        </script>
