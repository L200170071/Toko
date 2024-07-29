<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $title ?></h3>
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
            <table class="table table-bordered" id="example1">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Cover</th>
                        <th>Jumlah Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($foto as $key => $v) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $v->nama_barang ?></td>
                            <td class="text-center"><img src="<?= base_url('assets/gambar/' . $v->gambar) ?>" width="100px"></td>
                            <td class="text-center"><span class="badge bg-primary">
                                    <h5><?= $v->total_gambar ?></h5>
                                </span></td>
                            <td class="text-center">
                                <a href="<?= base_url('foto/add/' . $v->id_barang) ?>" class="btn btn-success btn-m"><i class="fas fa-plus"></i>ADD</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>