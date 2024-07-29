<div class="row">
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
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Belum Bayar</a>
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
            <!-- Belum Bayar -->
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <table class="table">
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kurir</th>
                                <th>Total Bayar</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($belum_bayar as $key => $v) { ?>
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
                                        <?php if ($v->status_bayar == 0) { ?>
                                            <br><a href="<?= base_url('pesanan_saya/bayar/' . $v->id_transaksi) ?>" class="btn btn-sm btn-success">Bayar</a>
                                        <?php } else { ?>
                                            <br><span class="badge badge-success">
                                                <h6>Sudah Bayar</h6>
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>

                    <!-- Diproses -->
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <table class="table">
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Kurir</th>
                                <th>Total Bayar</th>
                            </tr>
                            <?php foreach ($diproses as $key => $v) { ?>
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
                                        <span class="badge badge-success">Terverifikasi</span><br>
                                        <span class="badge badge-primary">Dikemas</span>
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
                                <th></th>
                            </tr>
                            <?php foreach ($dikirim as $key => $v) { ?>
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
                                        <span class="badge badge-success">Dikirim</span><br>
                                    </td>
                                    <td><?= $v->no_resi ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#diterima<?= $v->id_transaksi ?>">Diterima</button>
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
                            </tr>
                            <?php foreach ($selesai as $key => $v) { ?>
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
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<?php foreach ($dikirim as $key => $v) { ?>

    <!-- modal cek bukti pembayaran -->
    <div class="modal fade" id="diterima<?= $v->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pesanan Diterima</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah pesanan sudah diterima?
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('pesanan_saya/diterima/' . $v->id_transaksi) ?>" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>