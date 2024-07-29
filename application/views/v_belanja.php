<div class="card card-solid">
    <div class="card-body pb-0">
        <div class="row">
            <div class="col-sm-12">
                <?php
                if ($this->session->flashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                    echo $this->session->flashdata('pesan');
                    echo '</h5></div>';
                }
                ?>
            </div>
            <div class="col-sm-12">
                <?php echo form_open('belanja/update'); ?>

                <table class="table" cellpadding="6" cellspacing="1" style="width:100%">

                    <tr>
                        <th width="90px">QTY</th>
                        <th>Nama Barang</th>
                        <th style="text-align:right">Harga</th>
                        <th style="text-align:right">Berat</th>
                        <th style="text-align:right">Sub-Total</th>
                        <th>Action</th>
                    </tr>

                    <?php $i = 1; ?>

                    <?php
                    $total_berat = 0;
                    foreach ($this->cart->contents() as $items) {
                        $barang = $this->m_home->detail_barang($items['id']);
                        $berat = $items['qty'] * $barang->berat;
                        $total_berat = $total_berat + $berat;
                    ?>
                        <tr>
                            <td><?php echo form_input(array('name' => $i . '[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'min' => '0', 'size' => '5', 'type' => 'number', 'class' => 'form-control')); ?></td>
                            <td><?php echo $items['name']; ?></td>
                            <td style="text-align:right">Rp. <?php echo number_format($items['price'], 0); ?></td>
                            <td style="text-align:right"><?= $berat ?>g</td>
                            <td style="text-align:right">Rp. <?php echo number_format($items['subtotal'], 0); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('belanja/delete/' . $items['rowid']) ?>" class="btn btn-danger btn-m"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php $i++; ?>

                    <?php } ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            <h5 class="text-muted"><?= $total_berat ?>g</h5>
                        </td>
                        <td class="text-right">
                            <h3>Rp. <?php echo number_format($this->cart->total(), 0); ?></h3>
                        </td>
                        <td></td>

                    </tr>

                </table>
                <div class="pb-2">
                    <button class="btn btn-warning" type="submit"><b>Update</b></button>
                    <a href="<?= base_url('belanja/clear') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> <b>Hapus Semua</b></a>
                    <a href="<?= base_url('belanja/cekout') ?>" class="btn btn-success"><i class="fa fa-check-circle"></i> <b>Checkout</b></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>