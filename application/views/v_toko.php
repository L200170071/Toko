<div class="col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: darkorchid;">
            <h3 class="card-title text-white">Setting Toko</h3>
        </div>
        <div class="card-body">

            <?php
            if ($this->session->flashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Succes! ';
                echo $this->session->flashdata('pesan');
                echo '</h5></div>';
            }
            echo form_open('admin/toko'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input class="form-control" type="text" name="nama_toko" value="<?= $toko->nama_toko ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kota</label>
                        <select name="kota" class="form-control">
                            <option value="<?= $toko->lokasi ?>"><?= $toko->lokasi ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input class="form-control" type="text" name="no_telp" value="<?= $toko->no_telp ?>" required>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Alamat Toko</label>
                        <input class="form-control" type="text" name="alamat_toko" value="<?= $toko->alamat_toko ?>" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-m">Save</button>
                <a href="<?= base_url('admin') ?>" class="btn btn-danger btn-m">Back</a>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        //Daftar Provinsi
        $.ajax({
            type: "POST",
            url: "<?= base_url('kurir/provinsi') ?>",
            success: function(daftar_provinsi) {
                //console.log(daftar_provinsi);
                $("select[name=provinsi]").html(daftar_provinsi);
            }
        })

        //Daftar Kota
        $("select[name=provinsi").on("change", function() {
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

            $.ajax({
                type: "POST",
                url: "<?= base_url('kurir/kota') ?>",
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(daftar_kota) {
                    $("select[name=kota]").html(daftar_kota);
                }
            })
        });
    });
</script>