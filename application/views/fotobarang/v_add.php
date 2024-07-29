<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?> | <?= $barang->nama_barang ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Succes! ';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }
            ?>
            <?php
            echo validation_errors('<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fas fa-info"></i> ', '</h6></div>');

            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fas fa-info"></i> ' . $error_upload . '</h6></div>';
            }

            echo form_open_multipart('foto/add/' . $barang->id_barang) ?>

            <div class="form-group">
                <label>Keterangan Foto</label>
                <input name="keterangan" type="text" class="form-control" placeholder="Keterangan Foto" value="<?= set_value('keterangan') ?>">
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Foto</label>
                        <input name="gambar" id="preview_gambar" type="file" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <img id="gambar_load" src="<?= base_url('assets/gambar/image.png') ?>" width="200px">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-m">Save</button>
                <a href="<?= base_url('foto') ?>" class="btn btn-danger btn-m">Back</a>
            </div>

            <?php echo form_close() ?>

            <hr>
            <div class="row">
                <?php foreach ($foto as $key => $v) { ?>
                    <div class="col-sm-3">
                        <div class="form-group text-center">
                            <img id="gambar_load" src="<?= base_url('assets/foto/' . $v->gambar) ?>" width="250px" height="200px">
                        </div>
                        <p>Keterangan : <?= $v->keterangan ?></p>
                        <button class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#delete<?= $v->id_gambar ?>"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<?php
foreach ($foto as $key => $v) { ?>
    <div class="modal fade" id="delete<?= $v->id_gambar ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $v->keterangan ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group text-center">
                        <img id="gambar_load" src="<?= base_url('assets/foto/' . $v->gambar) ?>" width="250px" height="200px">
                    </div>
                    <h6>Foto akan terhapus, pastikan foto sudah benar.</h6>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('foto/delete/' . $v->id_barang . '/' . $v->id_gambar) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    function previewGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar_load').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#preview_gambar").change(function() {
        previewGambar(this);
    })
</script>