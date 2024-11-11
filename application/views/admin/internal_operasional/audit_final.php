<!-- HRD & LEGAL  -->
<!-- mulai -->
<?php echo form_open_multipart('admin/Internal_operasional/addIO_AF'); ?>

<div class="card mb-3">
  <div class="card-header">
    <a href="<?php echo site_url('admin/Akun_auditor') ?>"><i class="fa fa-arrow-left"></i> Back</a>
  </div>
  <div class="card-body">
    <div class="x_title">
      <h2 class="col-md-12 col-sm-12" style="text-align: center;">Audit Final</h2>
      <div class="clearfix"></div>

    </div>

    <form action="<?php echo site_url('admin/Akun_auditor/add') ?>" method="post" enctype="multipart/form-data">

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
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="PIC">PIC</label>
        <div class="col-md-6 col-sm-6">
          <input type="text" class="form-control" id="PIC" name="PIC" placeholder="PIC" required>
        </div>
      </div>


      <!-- <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Englat">Englat</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="Englat" id="Englat">
        </div>
      </div> -->


      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Surat_k_p">Surat Keberatan Profesi</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="Surat_k_p" id="Surat_k_p">
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Excel_Final">Excel Final</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="Excel_Final" id="Excel_Final">
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Excel_Final">Perset. Final</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="Perset_Final" id="Perset_Final">
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="File_Buku_Audit">File Buku Audit</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="File_Buku_Audit" id="File_Buku_Audit">
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="PMPJ">PMPJ</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="PMPJ" id="PMPJ">
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Surat_Pembatalan">Surat Pembatalan:</label>
        <div class="col-md-6 col-sm-6">
          <input type="file" size="20" name="Surat_Pembatalan" id="Surat_Pembatalan">
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



<?php echo form_close(); ?>

<br><br>


<table border="1" id="" class="display table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
      <th style="width: 150px;" bgcolor="#9fb7b7">Nama Perusahaan</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">Tanggal Opini</th>
      <th style="width: 100px;" bgcolor="#9fb7b7">PIC</th>
      <!-- <th style="width: 120px;" bgcolor="#9fb7b7">Englat</th> -->
      <th style="width: 120px;" bgcolor="#9fb7b7">Surat Keberatan Profesi</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">Perset. FInal</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">Excel Final</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">File Buku Audit</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">PMPJ</th>
      <th style="width: 120px;" bgcolor="#9fb7b7">Surat Pembatalan</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <!-- Data will be appended here -->
      <?php $j = 1; ?>
      <?php foreach ($Daily_report as $Daily_report_data): ?>



        <td align="center"><?php echo $j ?></td>


        <!-- Panggil Nama Perusahaan -->
        <td align="left">
          <?php echo $Daily_report_data->fullname ?>
        </td>

        <!-- Panggil Tahun Buku -->
        <!-- <td align="left"><?php echo $Daily_report_data->tahun_buku ?></td> -->



        <!-- Panggil File -->

        <?php if ($this->session->userdata('role') == 1): ?>

          <td>

            <a href="#"
              onclick="openPopup('<?= $Daily_report_data->kode_user ?>', '<?= $Daily_report_data->nama_file ?>', '<?php echo $Daily_report_data->id; ?>'); return false;">Lihat
              File</a>

            <!-- <a href=" <?= base_url('Internal_Opersional/uploads/' . $Daily_report_data->kode_user . '/' . $Daily_report_data->nama_file); ?>"
              target="_blank">

              <?php
              echo substr($Daily_report_data->nama_file, 0, 15) . '.....';
              ?>
            </a> -->

          </td>

        <?php else: ?>
          <?php if ($Daily_report_data->konfirmasi == 0): ?>
            <td style="background-color: #bd0d0d; font-family: Arial; color: white;">
              - Dokumen di tutup -
            </td>

          <?php elseif ($Daily_report_data->konfirmasi == 1): ?>
            <td style="background-color: #e1cb00; font-family: Arial; color: white;">
              - Dokumen sedang di konfirmasi -
            </td>

          <?php else: ?>

            <td>

              <!-- Menampilkan file di dalam iframe -->
              <!-- <iframe src="<?= base_url('Internal_Opersional/uploads/' . $Daily_report_data->kode_user . '/' . $Daily_report_data->nama_file); ?>" width="100%" height="600px">
                Browser Anda tidak mendukung iframe.
              </iframe> -->

              <a href=" <?= base_url('Internal_Opersional/uploads/' . $Daily_report_data->kode_user . '/' . $Daily_report_data->nama_file); ?>"
                target="_blank">

                <?php
                echo substr($Daily_report_data->nama_file, 0, 15) . '.....';
                ?>
              </a>

            </td>
          <?php endif; ?>
        <?php endif; ?>


        <!-- Panggil Tanggal Upload -->
        <td align="left">
          <?php
          // Assuming $Daily_report_data->tanggal_upload contains the datetime string  
          $tanggal_upload = $Daily_report_data->tanggal;

          if (isset($tanggal_upload)):
            $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
            echo $formatted_date;
          else:
          endif;
          ?>
        </td>

        <!-- Cek Auditor -->
        <td align="left"><?php echo $Daily_report_data->auditor ?></td>


        <!-- Panggil Tanggal Download -->
        <!-- <td align="left">
          <?php
          // Assuming $Daily_report_data->tanggal_upload contains the datetime string  
          $tanggal_upload = $Daily_report_data->tanggal;

          if (isset($tanggal_upload)):
            $formatted_date = date('d F Y H:i:s', strtotime($tanggal_upload));
            echo $formatted_date;
          else:
          endif;
          ?>
        </td> -->

        <!-- Cek Total Download -->
        <td align="right">
          <a href="javascript:void(0);" style="margin-right: 10px" data-toggle="modal" data-target="#filterModalAkun"
            data-id_akun="<?php echo htmlspecialchars($Daily_report_data->id_io, ENT_QUOTES, 'UTF-8'); ?>">
            <!-- Pastikan value id_perusahaan yang sesuai -->
            <?php echo htmlspecialchars($Daily_report_data->total_downloads, ENT_QUOTES, 'UTF-8'); ?>
          </a>
        </td>

        <!-- Cek Konfirmasi -->
        <td align="left">

          <?php if ($this->session->userdata('role') == 1): ?>

            <?php if ($Daily_report_data->konfirmasi == 1): ?>
              <button
                onclick=" konfirmasiIO('<?php echo site_url('admin/Internal_operasional/konfirmasiIO/' . $Daily_report_data->id) ?>')">Konfirmasi
                File!</button>
            <?php elseif ($Daily_report_data->konfirmasi == 2): ?>
              - Selesai Konfirmasi -
            <?php else: ?>

            <?php endif; ?>

          <?php else: ?>


            <?php if ($Daily_report_data->konfirmasi == 0): ?>

              <button
                onclick=" konfirmasiIO('<?php echo site_url('admin/Internal_operasional/konfirmasiIO/' . $Daily_report_data->id) ?>')">Konfirmasi
                File!</button>

            <?php elseif ($Daily_report_data->konfirmasi == 1): ?>
              - Konfirmasi Admin -
            <?php else: ?>
              - Selesai Konfirmasi -
            <?php endif; ?>

          <?php endif; ?>

        </td>



      </tr>
      <?php $j++; ?>
    <?php endforeach; ?>


  </tbody>
</table>
<!-- Selesai -->


<!-- Save Model Audit -->
<div class="modal fade" id="SaveModelAuidt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
      <div class="modal-body">Data akan disimpan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-save-audit" class="btn btn-success" href="#">Simpan</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <input type="text" class="form-control" id="inputData" name="data" placeholder="Masukkan Koemntar">
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


<!-- Filter Modal -->
<div class="modal fade" id="filterModalAkun" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Download</h4>
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
        url: "<?php echo site_url('Admin/Internal_operasional/getDataRoleAkun'); ?>", // URL controller
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



<script>
  function openPopup(kodeuser, namafile, idOp) {

    // Menggunakan AJAX untuk menyimpan data unduhan ke database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?= base_url('Admin/Internal_operasional/log_download'); ?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Jika berhasil menyimpan, buka pop-up
        var popup = window.open("", "popupWindow", "width=800,height=600,scrollbars=yes");
        popup.document.write('<html><head><title>File Viewer</title></head><body>');
        popup.document.write('<iframe src="<?= base_url('Internal_Opersional/uploads/'); ?>' + kodeuser + '/' + namafile + '" width="100%" height="100%"></iframe>');
        popup.document.write('</body></html>');
      }
    };
    console.log("Mengirim data:", "kode_user=" + kodeuser, "nama_file=" + namafile);
    xhr.send("kode_user=" + encodeURIComponent(kodeuser) +
      "&nama_file=" + encodeURIComponent(namafile) +
      "&idOp=" + encodeURIComponent(idOp)); // Tambahkan idOp di sini
  }
</script>

<script>
  function konfirmasiIO(url) {
    // Mengubah href tombol konfirmasi menjadi URL yang diberikan
    $('#btn-konfirmasi').attr('href', url);

    // Mengatur href untuk push WhatsApp
    //  $('#btn-konfirmasi').attr('href', 'http://wa.link/8ui8g1');

    // Menampilkan modal
    $('#deleteModal').modal();
  }
</script>


</script>

<!-- Modal -->
<!-- Logout Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if ($this->session->userdata('role') == 1): ?>
          Konfirmasi untuk memberikan akses file kepada auditor

        <?php else: ?>
          Silahkan konfirmasi file tersebut kepada admin agar dapat membuka file !!!
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-konfirmasi" class="btn btn-success" href="#">Konfirmasi</a>
      </div>
    </div>
  </div>
</div>


<script>
  function tampilkanPesan() {
    alert("Tombol telah diklik!");
  }
</script>


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