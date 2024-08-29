<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");
// $this->load->helper('bulan_helper'); 

// $bulan1 = bulan($bulan);

?>
<font size="12" face="Arial Narrow">
  <table id="tes" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th colspan="8" align="center">REKAP ABSENSI
        </th>
      </tr>
      <tr>
        <th style="text-transform: uppercase;" colspan="8" align="center">UNIVERSITAS MPU TANTULAR JAKARTA</th>
      </tr>
      <tr>
      </tr>
      <!-- <tr>
      <th colspan="4" style="text-align: center !important; border: solid;" bgcolor="FF9999">PENERIMAAN</th>
      <th colspan="4" style="text-align: center !important; border: solid" bgcolor="9999FF">PENGELUARAN</th>
    </tr> -->
      <tr align="center">
        <th width=50 style="text-align: center !important; border: solid;" bgcolor="FF9999">No.</th>
        <th width=100 style="text-align: center !important; border: solid;" bgcolor="FF9999">NIDN</th>
        <th width=200 style="text-align: center !important; border: solid;" bgcolor="FF9999">Nama Dosen</th>
        <th width=100 style="text-align: center !important; border: solid;" bgcolor="FF9999">Kode Mata Kuliah</th>
        <th width=200 style="text-align: center !important; border: solid;" bgcolor="FF9999">Nama Mata Kuliah</th>
        <th width=50 style="text-align: center !important; border: solid;" bgcolor="FF9999">SKS</th>
        <th width=50 style="text-align: center !important; border: solid;" bgcolor="FF9999">Hadir</th>
        <th width=100 style="text-align: center !important; border: solid;" bgcolor="FF9999">Presentase</th>

      </tr>



    </thead>
    <tbody>
      <?php $j = 1; ?>
      <?php foreach ($data_ajar as $data_ajar): ?>
        <tr>
        <td style="text-align: center !important; border: solid"><?php echo $j ?></td>
        <td style="text-align: center !important; border: solid"><?php echo $data_ajar->NIDN ?></td>
        <td style="text-align: center !important; border: solid"><?php echo $data_ajar->NAMA_DOSEN ?></td>
        <td style="text-align: center !important; border: solid"><?php echo $data_ajar->KD_MK ?></td>
        <td style="text-align: left !important; border: solid"><?php echo $data_ajar->NAMA_MK ?></td>
        <td style="text-align: center !important; border: solid"><?php echo $data_ajar->sks ?></td>
        <td style="text-align: center !important; border: solid"><?php echo $data_ajar->Hitung ?></td>
        <td style="text-align: center !important; border: solid"<?php
          $formatted_presentase = number_format($data_ajar->presentase, 2) . '%';

          if ($formatted_presentase < 50) {
            echo 'bgcolor="#ffff66 "';
          } else {
            echo 'bgcolor="#4da6ff "';
          }
          ?>>
            <?php
            echo $formatted_presentase
              ?>
          </td>
        </tr>
        <?php $j++; ?>
      <?php endforeach; ?>


    </tbody>
  </table>
</font>