<div class="x_title">
    <ul class="nav navbar-left panel_toolbox">
        <a href="#" data-toggle="modal" data-target="#BankModal" class="btn btn-success"><i class="fa fa-plus"></i>
            Upload Worksheet</a>
    </ul>
</div>

<!-- HRD & LEGAL  -->
<!-- mulai -->
<table border="1" id="" class="display table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                BANK
            </th>
        </tr>
        <tr>
            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                Saldo Per rincian
            </th>
            <th style="color: black;">
            <?php
            $this->load->helper('rupiah_helper');
            echo rupiah($total_rincian) ?>
            </th>
        </tr>
        <tr>
            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                Jumlah Per Laporan Keuangan
            </th>
            <th style="color: black;">
            <?php
            $this->load->helper('rupiah_helper');
            echo rupiah($total_rincian) ?>
            </th>
        </tr>
        <tr>
            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                Selisih
            </th>
            <th style="color: black;">
                0
            </th>
        </tr>
        <tr>
            <th bgcolor="#1471cf" colspan="2" style="color: white;">
                Minimal Konfirmasi 100% - SOP
            </th>
            <th style="color: black;">
            <?php
            $this->load->helper('rupiah_helper');
            $adjusted_rincian = $total_rincian * 100; // If you want to multiply by 100
            echo rupiah($adjusted_rincian) ?>
            </th>
        </tr>
        <tr>
            <th style="width: 50px;" bgcolor="#9fb7b7">No</th>
            <th style="width: 150px;" bgcolor="#9fb7b7">Rincian</th>
            <th style="width: 150px;" bgcolor="#9fb7b7">Account</th>
            <th style="width: 100px;" bgcolor="#9fb7b7">Saldo</th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Mata Uang Asing</th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Rekening Koran</th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Selisih Buku VS Giro</th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Arsip yang Sudah Ditandatangani Client</th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Balasan </th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Selisih Buku Vs Balasan </th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Keterangan </th>
            <th style="width: 120px;" bgcolor="#9fb7b7">Aksi </th>


        </tr>
    </thead>
    <tbody>


        <!-- Data will be appended here -->
        <?php $j = 1; ?>
        <?php foreach ($Get_Data_Konfirmasi_Bank as $Get_Data_Konfirmasi_Bank_data): ?>
            <tr>
                <td align="center"><?php echo $j ?></td>
                <td align="left" class="editable" >
                    <?php echo $Get_Data_Konfirmasi_Bank_data->nama_bank ?>
                </td>


                <td style="text-align: center;">
                    <?php echo $Get_Data_Konfirmasi_Bank_data->account ?>
                </td>
                <td style="text-align: right;">
                    <?php
                    $this->load->helper('rupiah_helper');
                    echo rupiah($Get_Data_Konfirmasi_Bank_data->rincian) ?>
                </td>
                <td style="text-align: right;">
                    <?php echo $Get_Data_Konfirmasi_Bank_data->Mata_uang_asing ?>
                </td>
                <td style="text-align: right;">
                    <?php
                    $this->load->helper('rupiah_helper');
                    echo rupiah($Get_Data_Konfirmasi_Bank_data->Rekening_Koran) ?>
                </td>
                <td style="text-align: right;">
                    <?php
                    // Pastikan nilai yang diambil adalah numerik
                    $rincian = floatval($Get_Data_Konfirmasi_Bank_data->rincian);
                    $Rekening_Koran = floatval($Get_Data_Konfirmasi_Bank_data->Rekening_Koran);
                    $this->load->helper('rupiah_helper');

                    // Lakukan pengurangan
                    $hasil_pengurangan = intval($rincian) - intval($Rekening_Koran);


                    // Format hasil pengurangan
                    if ($hasil_pengurangan < 0) {
                        // Jika hasil negatif, tambahkan tanda kurung
                        $selisih_lebih = "(" . rupiah(abs($hasil_pengurangan)). ")";


                         // Tampilkan hasil
                        echo $selisih_lebih;
                    } else {
                        // Jika tidak negatif, tampilkan hasil biasa
                        $selisih_lebih = rupiah($hasil_pengurangan);
                        echo $selisih_lebih;
                    }
                   
                    ?>
                </td>
                <td align="left">
                    <?php echo $Get_Data_Konfirmasi_Bank_data->arsip ?>
                </td>
                <td style="text-align: right;">
                    <?php 
                     $this->load->helper('rupiah_helper');
                    echo rupiah($Get_Data_Konfirmasi_Bank_data->Balasan) ?>
                </td>
                <td style="text-align: right;">

                <?php
                    // Pastikan nilai yang diambil adalah numerik
                    $rincian_balasan = floatval($Get_Data_Konfirmasi_Bank_data->rincian);
                    $Balasan = floatval($Get_Data_Konfirmasi_Bank_data->Balasan);
                    $this->load->helper('rupiah_helper');

                    // Lakukan pengurangan
                    $hasil_pengurangan_balasan = intval($rincian_balasan) - intval($Balasan);

                    //  echo $hasil_pengurangan_balasan ;


                    // Format hasil pengurangan
                    if ($hasil_pengurangan_balasan < 0) {
                        // Jika hasil negatif, tambahkan tanda kurung
                        $selisih_balasan = "(" . rupiah(abs($hasil_pengurangan_balasan)). ")";

                         // Tampilkan hasil
                        echo $selisih_balasan;
                    } else {
                        // Jika tidak negatif, tampilkan hasil biasa
                        $selisih_balasan = rupiah($hasil_pengurangan_balasan);
                        echo $selisih_balasan;
                    }
                   
                    ?>
                </td>
                <td align="left"><?php echo $Get_Data_Konfirmasi_Bank_data->Keterangan ?></td>
                <td style="text-align: center;">
                <a href="<?php echo site_url('admin/Data_perusahaan/edit/'.$Get_Data_Konfirmasi_Bank_data->id ) ?>" style="margin-right: 10px"><i class="fa fa-edit"></i> Edit</a>
                </td>


            </tr>
            <?php $j++; ?>
        <?php endforeach; ?>


    </tbody>
</table>

<!-- Selesai -->
 



<!-- Tambah Modal Untuk Bank -->
<div class="modal fade" id="BankModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Upload </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12">

                    <br>
                    <a href="#" data-toggle="modal" data-target="#tambahExcelModal" class="btn btn-success"><i
                            class="fa fa-plus"></i> Upload Excel</a>


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


<!-- Tambah via Upload Excel Modal -->
<div class="modal fade" id="tambahExcelModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Upload Excel </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php if (form_error('fileURL')) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php print form_error('fileURL'); ?>
                    </div>
                <?php } ?>


                <form action="<?php print site_url(); ?>/admin/Konfirmasi/uplouploadBankad" class="excel-upl"
                    id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="form-group col-md-12 col-sm-12">
                        <div class="col-md-8 col-sm-8">

                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div>
                        <div class="col-md-4 col-sm-4">

                            <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-12">
                        <div> <label>Contoh template excel untuk upload</label>
                        </div>
                        <div class="float-right">
                            <a href="<?php print base_url('assets/uploads/bank.xlsx') ?>" class="btn btn-link btn-sm"><i
                                    class="fa fa-file-excel"></i> Sample .XLSX</a>
                            <!-- <a href="<?php print base_url('assets/uploads/sample-xls.xls') ?>"
                                class="btn btn-link btn-sm"><i class="fa fa-file-excel"></i> Sample .XLS</a>
                            <a href="<?php print base_url('assets/uploads/sample-csv.csv') ?>"
                                class="btn btn-link btn-sm" target="_blank"><i class="fa fa-file-csv"></i> Sample
                                .CSV</a> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




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

<script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var $row = $(this).closest('tr');
                $row.find('.editable').each(function() {
                    var $this = $(this);
                    var currentText = $this.text();
                    $this.html('<input type="text" class="form-control" value="' + currentText + '"/>');
                });
                $row.find('.btn-edit').hide();
                $row.find('.btn-save').show();
            });

            $('.btn-save').on('click', function() {
                var $row = $(this).closest('tr');
                var id = $row.data('id');
                var name = $row.find('input[name="name"]').val();
                var email = $row.find('input[name="email"]').val();

                $.ajax({
                    url: "<?php echo site_url('user/update'); ?>",
                    type: "POST",
                    data: {id: id, name: name, email: email},
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            $row.find('.editable').each(function() {
                                var $this = $(this);
                                var newValue = $this.find('input').val();
                                $this.html(newValue);
                            });
                            $row.find('.btn-edit').show();
                            $row.find('.btn-save').hide();
                        } else {
                            alert('Error updating user.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>