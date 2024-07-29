<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($hero as $key => $v) { ?>
            <div class="carousel-item <?php echo ($key == 0 ? 'active' : '') ?>">
                <img class="d-block w-100" src="<?= base_url('assets/slider/') . $v['file_foto'] ?>" alt="First slide">
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php echo form_open('filter/harga') ?>
<div class="row py-5">
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
        <div class="row">

            <?php foreach ($barang as $key => $v) { ?>


                <div class="col-sm-4">
                    <?php
                    echo form_open('belanja/add');
                    echo form_hidden('id', $v->id_barang);
                    echo form_hidden('qty', 1);
                    echo form_hidden('price', $v->harga);
                    echo form_hidden('name', $v->nama_barang);
                    echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
                    ?>
                    <div class="card bg-white">
                        <div class="card-header text-white border-bottom-0 text-center" style="background-color: rgb(166, 89, 238);">
                            <h2 class="lead"><b><?= $v->nama_barang ?></b></h2>
                        </div>
                        <div class="card-body pt-1">

                            <img src="<?= base_url('assets/gambar/') . $v->gambar ?>" width="300px" height="250px">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-7">
                                    <p class="text-green"><b> Rp.<?= number_format($v->harga, 0) ?></b></p>
                                </div>
                                <div class="col-5 text-right">
                                    <a href="<?= base_url('home/detail_barang/' . $v->id_barang) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button href="#" type="submit" class="btn btn-sm btn-primary swalDefaultSuccess">
                                        <i class="fas fa-cart-plus"></i> Beli
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Barang ditambahkan kedalam keranjang'
            })
        });
    });

    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 2000
        })
    });
</script>