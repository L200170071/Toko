 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md" style="background-color:rgb(118, 96, 138)">
     <div class="container">
         <a href="<?= base_url() ?>" class="navbar-brand">
             <i class="fas fa-store text-white"></i>
             <span class="brand-text font-weight-light" style="color: white;"><b>AdaTokoKue</b></span>
         </a>

         <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse order-3" id="navbarCollapse">
             <!-- Left navbar links -->
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a href="<?= base_url() ?>" class="nav-link" style="color: white;">Home</a>
                 </li>
                 <?php $kategori = $this->m_home->get_all_data_kategori(); ?>
                 <li class="nav-item dropdown">
                     <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" style="color: white;">Kategori</a>
                     <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                         <?php foreach ($kategori as $key => $v) { ?>
                             <li><a href="<?= base_url('home/kategori/' . $v->id_kategori) ?>" class="dropdown-item"><?= $v->nama_kategori ?></a></li>
                         <?php } ?>
                     </ul>
                 </li>
                 <li>
                     <div class="navbar-form">
                         <?php echo form_open('filter/search') ?>
                         <input type="text" name="keyword" class="form-control" placeholder="Search">
                     </div>
                 </li>
                 <li class="pl-2">
                     <button type="submit" class="btn btn-default">Cari</button>
                     <?php echo form_close() ?>
                 </li>
             </ul>

         </div>

         <!-- Right navbar links -->
         <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
             <!-- Messages Dropdown Menu -->
             <?php
                $keranjang = $this->cart->contents();
                $items = 0;
                foreach ($keranjang as $key => $v) {
                    $items = $items + $v['qty'];
                }
                ?>
             <li class="nav-item dropdown">
                 <a class="nav-link" data-toggle="dropdown" href="#">
                     <i class="fas fa-shopping-bag" style="color: rgb(192, 255, 98);"></i>
                     <span class="badge badge-danger navbar-badge"><?= $items ?></span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                     <?php if (empty($keranjang)) { ?>
                         <a href="#" class="dropdown-item">
                             <p class="text-center">Keranjang Belum Terisi</p>
                         </a>
                         <?php } else {
                            foreach ($keranjang as $key => $v) {
                                $barang = $this->m_home->detail_barang($v['id']);
                            ?>
                             <a href="#" class="dropdown-item">
                                 <div class="media">
                                     <img src="<?= base_url('assets/gambar/' . $barang->gambar) ?>" alt="User Avatar" class="img-size-50 mr-3">
                                     <div class="media-body">
                                         <h3 class="dropdown-item-title">
                                             <?= $v['name'] ?>
                                         </h3>
                                         <p class="text-sm"><?= $v['qty'] ?> x Rp.<?= number_format($v['price'], 0) ?></p>
                                         <p class="text-sm text-muted"><i class="fa fa-calculator text-green"></i> Rp.<?= $this->cart->format_number($v['subtotal']) ?></p>
                                     </div>
                                 </div>
                             </a>
                             <div class="dropdown-divider"></div>
                         <?php } ?>
                         <a href="#" class="dropdown-item">
                             <div class="media">
                                 <div class="media-body">
                                     <tr>
                                         <td colspan="2"></td>
                                         <td class="right"><strong>Total </strong></td>
                                         <td class="right">Rp.<?= $this->cart->format_number($this->cart->total()); ?></td>
                                     </tr>
                                 </div>
                             </div>
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href="<?= base_url('belanja') ?>" class="dropdown-item dropdown-footer">Keranjang</a>
                         <a href="<?= base_url('belanja/cekout') ?>" class="dropdown-item dropdown-footer">Bayar</a>

                     <?php } ?>
                     <!-- Barang End -->
                 </div>
             </li>
             <li class="nav-item">
                 <?php if ($this->session->userdata('email') == "") { ?>
                     <a class="nav-link" href="<?= base_url('pelanggan/login') ?>" style="color: white;">
                         <img src="<?= base_url() ?>assets/profil/kosong.png" class="brand-image img-circle elevation-3">
                         <span class="brand-text font-weight-light">Login</span>
                     </a>
                 <?php } else { ?>
                     <a class="nav-link" data-toggle="dropdown" href="#">
                         <img src="<?= base_url('assets/profil/' . $this->session->userdata('foto')) ?>" class="brand-image img-circle elevation-3">
                         <span class="brand-text font-weight-light" style="color: white;"><?= $this->session->userdata('nama') ?> </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                         <div class="dropdown-divider"></div>
                         <a href="<?= base_url('pelanggan/akun') ?>" class="dropdown-item">
                             <i class="fas fa-user mr-2"></i>Akun Saya
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href="<?= base_url('pesanan_saya') ?>" class="dropdown-item">
                             <i class="fas fa-shopping-cart mr-2"></i>Pesanan Saya
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href="<?= base_url('pelanggan/logout') ?>" class="dropdown-item dropdown-footer" style="background-color: rgb(255, 70, 60);">Log Out</a>
                     </div>
                 <?php } ?>
             </li>
         </ul>
     </div>
 </nav>
 <!-- /.navbar -->

 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark"><?= $title ?></h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">AdaTokoKue</a></li>
                         <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                     </ol>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
         <div class="container">