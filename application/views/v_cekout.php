<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="far fa-credit-card"></i>Pembayaran
                <small class="float-right">Date: <?= date('d/m/Y') ?></small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->

    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                        <th>Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total_berat = 0;
                    foreach ($this->cart->contents() as $items) {
                        $barang = $this->m_home->detail_barang($items['id']);
                        $berat = $items['qty'] * $barang->berat;
                        $total_berat = $total_berat + $berat;
                    ?>
                        <tr>
                            <td><?php echo $items['name']; ?></td>
                            <td style="text-align:left">Rp. <?php echo number_format($items['price'], 0); ?></td>
                            <td><?php echo $items['qty']; ?></td>
                            <td style="text-align:left">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
                            <td style="text-align:left"><?= $berat ?>g</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php
    echo form_open('belanja/cekout');
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));
    ?>
    <div class="row">
        <div class="col-8 invoice-col">
            <?php
            echo validation_errors('<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');
            ?>
            Tujuan
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Penerima</label>
                        <input name="nama_penerima" class="form-control" required>
                        </input>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>No Handphone</label>
                        <input name="hp_penerima" class="form-control" required>
                        </input>
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
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kurir</label>
                        <select name="expedisi" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Paket</label>
                        <select name="paket" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" class="form-control" required>
                        </input>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input name="kode_pos" class="form-control" required>
                        </input>
                    </div>
                </div>
            </div>
        </div>

        <!-- accepted payments column -->
        <!-- /.col -->
        <div class="col-4">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Grandtotal:</th>
                        <td>Rp. <?php echo number_format($this->cart->total(), 0); ?></td>
                    </tr>
                    <tr>
                        <th>Berat:</th>
                        <td><?= $total_berat ?>g</td>
                    </tr>
                    <tr>
                        <th>Ongkir:</th>
                        <td><label id="ongkir"></label></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td><label id="total_bayar">0</label></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Simpan transaksi (Hidden) -->
    <input name="no_order" value="<?= $no_order ?>" hidden>
    <input name="estimasi" hidden>
    <input name="ongkir" hidden>
    <input name="berat" value="<?= $total_berat ?>" hidden><br>
    <input name="grand_total" value="<?= $this->cart->total() ?>" hidden>
    <input name="total_bayar" hidden>
    <!-- End Simpan transaksi (Hidden) -->

    <!-- Simpan rincian transaksi (Hidden)  -->
    <?php
    $i = 1;
    foreach ($this->cart->contents() as $items) {
        echo form_hidden('qty' . $i++, $items['qty']);
    } ?>
    <!-- End Simpan rincian transaksi  -->
    <div class="row no-print">
        <div class="col-12">
            <a href="<?= base_url('belanja') ?>" class="btn btn-danger"></i>Batal</a>
            <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                Pembayaran
            </button>
        </div>
    </div>
    <?php echo form_close() ?>
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

        $("select[name=kota").on("change", function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('kurir/expedisi') ?>",
                success: function(daftar_kurir) {
                    $("select[name=expedisi]").html(daftar_kurir);
                }
            })
        });

        $("select[name=expedisi").on("change", function() {
            var expedisi_terpilih = $("select[name=expedisi]").val()
            var id_kota_tujuan_terpilih = $("option:selected", "select[name=kota]").attr('id_kota');
            var tot_berat = <?= $total_berat ?>;

            $.ajax({
                type: "POST",
                url: "<?= base_url('kurir/paket') ?>",
                data: 'expedisi=' + expedisi_terpilih + '&id_kota=' + id_kota_tujuan_terpilih + '&berat=' + tot_berat,
                success: function(daftar_paket) {
                    $("select[name=paket]").html(daftar_paket);
                }
            })
        });

        $("select[name=paket").on("change", function() {
            var dataongkir = $("option:selected", this).attr('ongkir');
            var reverse = dataongkir.toString().split('').reverse().join(''),
                ribuan_ongkir = reverse.match(/\d{1,3}/g);
            ribuan_ongkir = ribuan_ongkir.join(',').split('').reverse().join('');
            $("#ongkir").html("Rp. " + ribuan_ongkir);

            var total_bayar = parseInt(dataongkir) + parseInt(<?= $this->cart->total() ?>)
            var reverse2 = total_bayar.toString().split('').reverse().join(''),
                ribuan_total_bayar = reverse2.match(/\d{1,3}/g);
            ribuan_total_bayar = ribuan_total_bayar.join(',').split('').reverse().join('');
            $("#total_bayar").html("Rp. " + ribuan_total_bayar);

            //estimasi dan ongkir
            var estimasi = $("option:selected", this).attr('estimasi');
            $("input[name=estimasi]").val(estimasi);
            $("input[name=ongkir]").val(dataongkir);
            $("input[name=total_bayar]").val(total_bayar);
        });
    });
</script>