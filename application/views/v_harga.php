<?php echo form_open('filter/harga') ?>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="text" name="minimal" class="form-control" placeholder="Harga Minimal">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <input type="text" name="maksimal" class="form-control" placeholder="Harga Maksimal">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <button type="submit" class="btn btn-default">Cari</button>
        </div>
    </div>
</div>
<?php echo form_close() ?>

<div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">

            <?php foreach ($barang as $key => $v) { ?>

                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-white">
                        <div class="card-header text-white border-bottom-0 text-center" style="background-color: darkorchid;">
                            <h2 class="lead"><b><?= $v->nama_barang ?></b></h2>
                        </div>
                        <div class="card-body pt-1">

                            <img src="<?= base_url('assets/gambar/') . $v->gambar ?>" class="img-fluid" width="300px">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-7">
                                    <p class="text-green"><b> Rp.<?= number_format($v->harga, 0) ?></b></p>
                                </div>
                                <div class="col-5 text-right">
                                    <a href="<?= base_url('home/detail_barang/' . $v->id_barang) ?>" class="btn btn-sm btn-primary">
                                        Beli
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>