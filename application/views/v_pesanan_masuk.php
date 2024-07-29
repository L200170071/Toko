<div class="col-12 col-sm-12">
    <?php
    if ($this->session->flashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>';
        echo $this->session->flashdata('pesan');
        echo '</h5></div>';
    }
    ?>
    <div class="card card-success card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pesanan Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Diproses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Dikirim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Selesai</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <table class="table">
                        <tr>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kurir</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pesanan as $key => $v) { ?>
                            <tr>
                                <td><?= $v->no_order ?></td>
                                <td><?= $v->tanggal ?></td>
                                <td>
                                    <b><?= $v->expedisi ?></b><br>
                                    Paket : <?= $v->paket ?><br>
                                    Ongkir : <?= $v->ongkir ?>
                                </td>
                                <td>
                                    <b>Rp. <?= number_format($v->total_bayar, 0) ?></b><br>
                                    <?php if ($v->status_bayar == 0) { ?>
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    <?php } else { ?>
                                        <span class="badge badge-info">Menunggu Verifikasi</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($v->status_bayar == 1) { ?>
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#cek<?= $v->id_transaksi ?>">Bukti Bayar</button>
                                        <a href="<?= base_url('admin/proses/' . $v->id_transaksi) ?>" class="btn btn-sm btn-warning">Proses</a>
                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <table class="table">
                        <tr>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kurir</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                        <?php foreach ($pesanan_diproses as $key => $v) { ?>
                            <tr>
                                <td><?= $v->no_order ?></td>
                                <td><?= $v->tanggal ?></td>
                                <td>
                                    <b><?= $v->expedisi ?></b><br>
                                    Paket : <?= $v->paket ?><br>
                                    Ongkir : <?= $v->ongkir ?>
                                </td>
                                <td>
                                    <b>Rp. <?= number_format($v->total_bayar, 0) ?></b><br>
                                    <span class="badge badge-primary">Dikemas</span>
                                </td>
                                <td>
                                    <?php if ($v->status_bayar == 1) { ?>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#kirim<?= $v->id_transaksi ?>">Kirim</button>
                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <table class="table">
                        <tr>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kurir</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                        </tr>
                        <?php foreach ($pesanan_dikirim as $key => $v) { ?>
                            <tr>
                                <td><?= $v->no_order ?></td>
                                <td><?= $v->tanggal ?></td>
                                <td>
                                    <b><?= $v->expedisi ?></b><br>
                                    Paket : <?= $v->paket ?><br>
                                    Ongkir : <?= $v->ongkir ?>
                                </td>
                                <td>
                                    <b>Rp. <?= number_format($v->total_bayar, 0) ?></b><br>
                                    <span class="badge badge-success">Dikirim</span>
                                </td>
                                <td>
                                    <?= $v->no_resi ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    <table class="table">
                        <tr>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kurir</th>
                            <th>Total Bayar</th>
                            <th>No Resi</th>
                            <th>Cetak Nota</th>
                        </tr>
                        <?php foreach ($pesanan_selesai as $key => $v) { ?>
                            <tr>
                                <td><?= $v->no_order ?></td>
                                <td><?= $v->tanggal ?></td>
                                <td>
                                    <b><?= $v->expedisi ?></b><br>
                                    Paket : <?= $v->paket ?><br>
                                    Ongkir : <?= $v->ongkir ?>
                                </td>
                                <td>
                                    <b>Rp. <?= number_format($v->total_bayar, 0) ?></b><br>
                                    <span class="badge badge-success">Diterima</span><br>
                                </td>
                                <td><?= $v->no_resi ?></td>
                                <td> <a href="<?= base_url(); ?>Pesanan_saya/cetak_pdf/<?= $v->no_order ?>" target="_blank"><button type=submit class="btn btn-danger"> PDF </button></a></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<?php foreach ($pesanan as $key => $v) { ?>

    <!-- modal cek bukti pembayaran -->
    <div class="modal fade" id="cek<?= $v->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $v->no_order ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Nama Bank</th>
                            <th>:</th>
                            <td><?= $v->nama_bank ?></td>
                        </tr>
                        <tr>
                            <th>No Rekening</th>
                            <th>:</th>
                            <td><?= $v->no_rek ?></td>
                        </tr>
                        <tr>
                            <th>Atas Nama</th>
                            <th>:</th>
                            <td><?= $v->atas_nama ?></td>
                        </tr>
                        <tr>
                            <th>Total Bayar</th>
                            <th>:</th>
                            <td>Rp. <?= number_format($v->total_bayar, 0) ?></td>
                        </tr>
                    </table>
                    <img class="img-fluid pad" src="<?= base_url('assets/bukti_bayar/' . $v->bukti_bayar) ?>" alt="">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<?php foreach ($pesanan_diproses as $key => $v) { ?>

    <!-- modal cek bukti pembayaran -->
    <div class="modal fade" id="kirim<?= $v->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= $v->no_order ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('admin/kirim/' . $v->id_transaksi); ?>
                    <table class="table">
                        <tr>
                            <th>Kurir</th>
                            <th>:</th>
                            <td><?= $v->expedisi ?></td>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <th>:</th>
                            <td><?= $v->paket ?></td>
                        </tr>
                        <tr>
                            <th>Ongkir</th>
                            <th>:</th>
                            <td>Rp. <?= number_format($v->ongkir, 0) ?></td>
                        </tr>
                        <tr>
                            <th>No Resi</th>
                            <th>:</th>
                            <td><input name="no_resi" class="form-control" placeholder="No Resi" required></td>
                        </tr>
                    </table>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save kirim</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>