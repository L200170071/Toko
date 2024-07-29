<div class="col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: darkorchid;">
            <h3 class="card-title text-white">Add Data Barang</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            echo validation_errors('<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fas fa-info"></i> ', '</h6></div>');

            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fas fa-info"></i> ' . $error_upload . '</h6></div>';
            }

            echo form_open_multipart('barang/add') ?>
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" value="<?= set_value('nama_barang') ?>">
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option value="">----- Pilih Kategori -----</option>
                            <?php foreach ($kategori as $key => $v) { ?>
                                <option value="<?= $v->id_kategori ?>"><?= $v->nama_kategori ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Harga</label>
                        <input name="harga" class="form-control" placeholder="Rp." value="<?= set_value('harga') ?>">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Berat (g)</label>
                        <input type="number" min="0" name="berat" class="form-control" placeholder="Berat (gram)" value="<?= set_value('berat') ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="7" cols="30" placeholder="Deskripsi"><?= set_value('deskripsi') ?></textarea>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="gambar" id="preview_gambar" type="file" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <img id="gambar_load" src="<?= base_url('assets/gambar/image.png') ?>" width="400px">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-m">Save</button>
                <a href="<?= base_url('barang') ?>" class="btn btn-danger btn-m">Back</a>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

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