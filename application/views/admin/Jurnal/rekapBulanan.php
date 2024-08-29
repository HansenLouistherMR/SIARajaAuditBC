<!DOCTYPE html>
<html lang="en">

<head> <?php $this->load->view("admin/_partials/head.php") ?>
  <link rel="stylesheet" href="
      <?php echo base_url() . 'css/jquery-ui.css' ?>">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container"> <?php $this->load->view("admin/_partials/sidebar.php") ?>
      <!-- top navigation --> <?php $this->load->view("admin/_partials/navbar.php") ?>
      <!-- /top navigation -->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <!-- form Tambah --> <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->flashdata('success'); ?>
              </div> <?php } else if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert">&times;</a>
                  <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div> <?php } else if ($this->session->flashdata('warning')) { ?>
                  <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                  </div> <?php } else if ($this->session->flashdata('info')) { ?>
                    <div class="alert alert-info">
                      <a href="#" class="close" data-dismiss="alert">&times;</a>
                      <strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
                    </div> <?php } ?>
            <div class="card mb-3">
              <div class="card-body">
                <div class="x_title" style="margin-bottom: 30px;" align="center">
                  <b>
                    <h4> JURNAL </h4>
                    <br> PT MASARYO GATRA NASTITI <br> From 01 Jan 2023 to 31 Dec 2023
                </div>
                <!-- <div><form action="
                          <?php echo site_url('admin/rekapitulasi/rekapBulananGo') ?>" method="post" enctype="multipart/form-data" ><div class="item form-group col-md-12 col-sm-12"><label class="col-form-label col-md-1 col-sm-1 label-align" for="nama_siswa">Bulan : </label><div class="col-md-2 col-sm-2 "><div class="form-group"><div class='input-group date' id='myDatepicker4'><input type="text" class="form-control" placeholder="Bulan" name="bulan" required value="<?php echo $bulan ?>"/><span class="input-group-addon" style="padding-top: 10px"><span class="fa fa-calendar-o"></span></span></div></div></div><label class="col-form-label col-md-1 col-sm-1 label-align" for="nama_siswa">Tahun : </label><div class="col-md-2 col-sm-2 "><div class="form-group"><div class='input-group date' id='myDatepicker3'><input type='text' class="form-control" placeholder="Tahun" name="tahun" required value="<?php echo $tahun ?>"/><span class="input-group-addon" style="padding-top: 10px"><span class="fa fa-calendar-o"></span></span></div></div></div><div class="col-md-2 col-sm-2 label-align"><button type="submit" class="btn btn-success">Go!</button></div></div></form></div>
 -->
              </div>
              <!-- /card Body-->
            </div>
            <!-- /card mb3-->
            <div class="card mb-3">
              <!-- 
            <div class="card-body"><div class="x_title" ><h2 >Rekap Penerimaan & Pengeluaran 
                        <?php $this->load->helper('bulan_helper');
                        echo bulan($bulan) ?>
                        <?php echo $tahun ?></h2><div class="clearfix"></div></div><div class="x_content"><div class="row col-sm-12 col-md-12" style="display: inline-block;" align="center" ><div class="top_tiles" ><div class="col-md-4 col-sm-4  tile"><span>Penerimaan </span><h2>Rp. 
                        <?php $this->load->helper('rupiah_helper');
                        echo rupiah($pemasukkan) ?></h2></div></div><div class="top_tiles" ><div class="col-md-4 col-sm-4  tile"><span>Pengeluaran </span><h2>Rp. 
                        <?php $this->load->helper('rupiah_helper');
                        echo rupiah($pengeluaran) ?></h2></div></div><div class="top_tiles" ><div class="col-md-4 col-sm-4  tile"><span>Saldo Bulan 
                        <?php $this->load->helper('bulan_helper');
                        echo bulan($bulan) ?>
                        <?php echo $tahun ?></span><h2>Rp. 
                        <?php $this->load->helper('rupiah_helper');
                        echo rupiah($saldo) ?></h2></div></div></div></div> -->
            </div>
            <div class="card-body">
              <div class="x_title">
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="col-sm-12 col-md-12" align="center">
                  <div class="x_title">
                    <h2>Menu</h2>
                    <!-- <ul class="nav navbar-right panel_toolbox"><a href="#"  data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i> Filter</a></ul> -->
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="
                                  <?php echo site_url('admin/menu/add') ?>" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah </a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="card-box table-responsive">
                    <!-- <div align="right"><a href="
                              <?php echo site_url('admin/rekapitulasi/printRekapBulananExcel/' . $bulan . '/' . $tahun) ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a></div> -->
                    <table id="tes" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr bgcolor="C0C0C0" align="center">
                          <th style="width: 30px" rowspan="2">No</th>
                          <th style="width: 40px" rowspan="2">Kode</th>
                          <th style="width: 150px" rowspan="2">Account</th>
                          <th style="width: 150px" colspan="4"></th>
                          <th style="width: 150px" colspan="3">Laba Rugi</th>
                          <th style="width: 70px" rowspan="2">Reff</th>
                          <th style="width: 70px"  rowspan="2">Nama Perushaan</th>

                        </tr>
                        <tr bgcolor="C0C0C0" align="center">
                          <td> # </td>
                          <td> Debet </td>
                          <td> Credit </td>
                          <td> Reff </td>
                          <td> Debet </td>
                          <td> Credit </td>
                        </tr>
                        <tr>
                          <td> </td>
                          <td>
                            <input type="text" name="Kode" id="Kode" size="15">
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                          <td>
                            <input type="number" name="Debet" id="Debet" size="15">
                          </td>
                          <td>
                            <input type="number" name="Credit" id="Credit" size="15">
                          </td>
                          <td>
                            <select id="category">
                              <option value="">Select Category</option>
                              <option value="Category 1">Aj 1</option>
                              <option value="Category 1">Aj 2</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                          <td>
                            <input type="text" name="Account" id="Account" size="15">
                          </td>
                        </tr>
                        <!-- <tr><td colspan="3" style="text-align: center !important; font-weight: bold;" bgcolor="FF9999">
                            Jumlah Total Debet 
                                  <?php echo bulan($bulan) . " " . $tahun; ?></td><td style="text-align: center !important; font-weight: bold;" bgcolor="FF9999"> Rp.
                            
                                  <?php $this->load->helper('rupiah_helper');
                                  echo rupiah($pemasukkan) ?></td><td colspan="3" style="text-align: center !important; font-weight: bold;" bgcolor="9999FF">
                            Jumlah Total Kredit 
                                  <?php echo bulan($bulan) . " " . $tahun; ?></td><td style="text-align: center !important; font-weight: bold;" bgcolor="9999FF"> Rp.
                            
                                  <?php $this->load->helper('rupiah_helper');
                                  echo rupiah($pengeluaran) ?></td></tr><tr bgcolor="C0C0C0" style="text-align: center; font-weight: bold;"><td colspan="7">
                            Saldo Bulan
                            
                                  <?php
                                  // if (($bulan+1 == 13)) {
                                  //   $bulan1 = 1;
                                  // } else {
                                  //   $bulan1 = $bulan+1;
                                  // }
                                  $this->load->helper('bulan_helper');
                                  echo bulan($bulan);

                                  // if (($bulan1) == 1 ){
                                  //   echo $tahun+1;
                                  // } else {
                                  echo " " . $tahun;
                                  // }  
                                  ?></td><td>Rp. 
                                  <?php echo rupiah($saldo) ?></td></tr> -->
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="card mb-3"><div class="card-body"><div class="x_title"><h2>Rekapitulasi Pertanggal 
                    <?php $this->load->helper('bulan_helper');
                    echo bulan($bulan) ?>
                    <?php echo $tahun ?></h2><div class="clearfix"></div></div><div align="right"><a href="
                    <?php echo site_url('admin/rekapitulasi/printRekapBulananPertanggalExcel/' . $bulan . '/' . $tahun) ?>"
                  class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a></div></div><div class="x_content"><div class="col-sm-12 col-md-12" align="center"><div class="card-box table-responsive"><table id="tes" class="table table-striped table-bordered" style="width:100%"><thead><tr bgcolor="C0C0C0" align="center"><th>NO</th><th>TGL</th><th>KODE</th><th>KETERANGAN</th><th>DEBET(Rp.)</th><th>KREDIT(Rp.)</th></tr></thead><tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($PerTanggal as $a) { ?><tr><td align="center">
                    <?php echo $i ?></td><td align="center">
                    <?php echo $a->tanggal ?></td><td align="center">
                    <?php
                    if ($a->kode == "spp") {
                      if ($a->ket == "1A") {
                        echo "20.2.11";
                      } else if ($a->ket == "1B") {
                        echo "20.2.12";
                      } else if ($a->ket == "2A") {
                        echo "20.2.21";
                      } else if ($a->ket == "2B") {
                        echo "20.2.22";
                      } else if ($a->ket == "3A") {
                        echo "20.2.31";
                      } else if ($a->ket == "3B") {
                        echo "20.2.32";
                      } else if ($a->ket == "4A") {
                        echo "20.2.41";
                      } else if ($a->ket == "4B") {
                        echo "20.2.42";
                      } else if ($a->ket == "5A") {
                        echo "20.2.51";
                      } else if ($a->ket == "5B") {
                        echo "20.2.52";
                      } else if ($a->ket == "6A") {
                        echo "20.2.61";
                      } else if ($a->ket == "6B") {
                        echo "20.2.62";
                      }

                    } else {
                      echo $a->kode;
                    }

                    ?></td><td>
                    <?php echo $a->keterangan ?></td><td align="right" style="padding-right: 40px">
                    <?php
                    if ($a->debet == "") {
                      echo $a->debet;
                    } else {
                      echo rupiah($a->debet);
                    }
                    ?></td><td align="right" style="padding-right: 40px">
                    <?php
                    if ($a->kredit == "") {
                      echo $a->kredit;
                    } else {
                      echo rupiah($a->kredit);
                    }
                    ?></td></tr>
                    <?php $i++; ?>
                    <?php }
                    // var_dump($PerTanggal);
                    // die();
                    ?><tr bgcolor="C0C0C0"><th colspan="4" style="text-align: center;">TOTAL</th><th style="text-align: right; padding-right: 40px">Rp. 
                    <?php echo rupiah($pemasukkan) ?></th><th style="text-align: right; padding-right: 40px"> Rp. 
                    <?php echo rupiah($pengeluaran) ?></th></tr></tbody></table></div></div></div></div> -->
        </div>
      </div>
      <!-- /card mb3-->
    </div>
  </div>
  </div>
  <!-- /page content -->
  <!-- footer content --> <?php $this->load->view("admin/_partials/footer.php") ?>
  <!-- /footer content -->
  </div>
  </div>
  <!-- Modal --> <?php $this->load->view("admin/_partials/modal.php") ?>
  <!-- MODAL --> <?php $this->load->view("admin/_partials/modal.php") ?>
  <!-- jQuery -->
  <script src="
        <?php echo base_url('assets/jquery/dist/jquery.min.js') ?>">
        </script>
  <!-- Bootstrap -->
  <script src="
        <?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>">
        </script>
  <!-- FastClick -->
  <script src="
        <?php echo base_url('assets/fastclick/lib/fastclick.js') ?>">
        </script>
  <!-- NProgress -->
  <script src="
        <?php echo base_url('assets/nprogress/nprogress.js') ?>">
        </script>
  <!-- Datatables -->
  <script src="
        <?php echo base_url('assets/datatables.net/js/jquery.dataTables.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-buttons/js/dataTables.buttons.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-buttons/js/buttons.flash.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-buttons/js/buttons.html5.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-buttons/js/buttons.print.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-keytable/js/dataTables.keyTable.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-responsive/js/dataTables.responsive.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-responsive-bs/js/responsive.bootstrap.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/datatables.net-scroller/js/dataTables.scroller.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/jszip/dist/jszip.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/pdfmake/build/pdfmake.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/pdfmake/build/vfs_fonts.js') ?>">
        </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('table.display').DataTable();
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#nama_siswa').autocomplete({
        source: " < ? php echo site_url('admin/bayar_catering/get_autocomplete'); ? > ",
        select: function (event, ui) {
          $('[name="nama_siswa"]').val(ui.item.label);
          $('[name="nis"]').val(ui.item.nomor);
          $('[name="kelas"]').val(ui.item.kelas);
          $('[name="biaya_catering"]').val(ui.item.biaya);
        }
      });
    });
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
  <script src="
        <?php echo base_url('assets/moment/min/moment.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>">
        </script>
  <script src="
        <?php echo base_url() . 'js/jquery-ui.js' ?>" type="text/javascript">
        </script>
  <!-- bootstrap-daterangepicker -->
  <script src="
        <?php echo base_url('assets/moment/min/moment.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js') ?>">
        </script>
  <script src="
        <?php echo base_url() . 'js/jquery-ui.js' ?>" type="text/javascript">
        </script>
  <!-- bootstrap-datetimepicker -->
  <script src="
        <?php echo base_url('assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/echarts/dist/echarts.min.js') ?>">
        </script>
  <!-- Initialize datetimepicker -->
  <script type="text/javascript">
    $('.myDatepicker2').datetimepicker({
      format: 'DD/MM/YYYY'
    });
    $('#myDatepicker3').datetimepicker({
      format: 'YYYY'
    });
    $('#myDatepicker4').datetimepicker({
      format: 'MM'
    });
  </script>
  <!-- PNotify -->
  <script src="
        <?php echo base_url('assets/pnotify/dist/pnotify.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/pnotify/dist/pnotify.buttons.js') ?>">
        </script>
  <script src="
        <?php echo base_url('assets/pnotify/dist/pnotify.nonblock.js') ?>">
        </script>
  <!-- Custom Theme Scripts -->
  <script src="
        <?php echo base_url('js/custom.min.js') ?>">
        </script>
</body>

</html>