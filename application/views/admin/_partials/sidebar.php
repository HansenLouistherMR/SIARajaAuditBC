<div class="col-md-3 left_col" style="margin-top: 20px">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo site_url('admin') ?>" class="site_title">
        <img src="<?php echo base_url('images/logo.png') ?>" height="50" width="50" />
        <span style="margin-left: 10px">Raja Audit</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->

    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section" style="margin-top: 20px">

        <h3>Sistem Ifnormasi Audit</h3>
        <div class="title"></div>
        <ul class="nav side-menu">

          <?php foreach ($data_menu as $menu): ?>
            <?php if ($menu->kode_role == $this->session->userdata('role')): ?>
              <li>
                <a href="<?php echo site_url($menu->link); ?>">
                  <i class="<?php echo $menu->nama_icon; ?>"></i>
                  <?php echo $menu->nama_menu; ?>
                  <span class="fa fa-chevron"></span>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>


          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/jadwal_ajar') ?>"><i class="fa fa-calendar"></i> Daftar Mengajar <span
                class="fa fa-chevron"></span></a>
          </li> -->
          <!-- Selesai -->

          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/jadwal_kuliah') ?>"><i class="fa fa-calendar"></i> Daftar Kuliah <span
                class="fa fa-chevron"></span></a>
          </li> -->
          <!-- Selesai -->

          <!-- Mulai -->
          <?php if ($this->session->userdata('role') == 1): ?>
            <li><a><i class="fa fa-area-chart"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="<?php echo site_url('admin/Role'); ?>">Role </a></li>
                <li><a href="<?php echo site_url('admin/Menu'); ?>">Menu </a></li>
              </ul>
            </li>
          <?php endif; ?>


          <!-- Selesai -->


          <!-- Mulai -->

          <!-- <li><a><i class="fa fa-area-chart"></i> Rekapitulasi <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo site_url('admin/rekapitulasi') ?>">Rekapitulasi Bulanan </a></li>
                    <li><a href="<?php echo site_url('admin/bayar_spp/rekapSPP') ?>">Rekapitulasi SPP </a></li>
                    <li><a href="<?php echo site_url('admin/bayar_catering/rekapCatering') ?>">Rekapitulasi Catering </a></li>
                    <li><a href="<?php echo site_url('admin/daftar_ulang/rekapDaftarUlang') ?>">Rekapitulasi Daftar Ulang </a></li>
                    <li><a href="<?php echo site_url('admin/pemasukkan_lain/rekapPemasukkanLain') ?>">Rekapitulasi Pemasukkan Lain </a></li>
                    <li><a href="<?php echo site_url('admin/pengeluaran/rekapPengeluaran') ?>">Rekapitulasi Pengeluaran </a></li>
                  </ul>
                </li> -->
          <!-- <li><a href="<?php echo site_url('admin/siswa') ?>"><i class="fa fa-child"></i> Data Siswa <span class="fa fa-chevron"></span></a>
                </li>  -->
          <!-- Selesai -->

          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/bayar_spp') ?>"><i class="fa fa-calendar"></i> Pembayaran SPP <span class="fa fa-chevron"></span></a>
                </li> -->
          <!-- Selesai -->


          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/daftar_ulang') ?>"><i class="fa fa-money"></i> Daftar Ulang <span class="fa fa-chevron"></span></a>
                </li> -->
          <!-- Selesai -->

          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/pemasukkan_lain') ?>"><i class="fa fa-credit-card"></i> Pemasukkan Lainnya <span class="fa fa-chevron"></span></a>
                </li> -->
          <!-- Selesai -->

          <!-- Mulai -->
          <!-- <li><a href="<?php echo site_url('admin/pengeluaran') ?>"><i class="fa fa-cart-plus"></i> Pengeluaran <span class="fa fa-chevron"></span></a>
                </li> -->
          <!-- Selesai -->

          <!-- Mulai -->
          <!-- <li><a><i class="fa fa-edit"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo site_url('admin/pemasukkan_lain/list_kategori_pemasukkan_lain') ?>">Set Kategori Pemasukkan Lain</a></li>
                    <li><a href="<?php echo site_url('admin/pengeluaran/list_kategori_pengeluaran') ?>">Set Kategori Pengeluaran</a></li>
                    <li><a href="#"  data-toggle="modal" data-target="#naikKelasModal">Set Naik Kelas</a></li>                   
                  </ul>
                </li> -->
          <!-- Selesai -->


        </ul>
      </div>


    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= site_url('login/logout') ?>"
        style="width: 100%;">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>