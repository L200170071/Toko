<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $title ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>
                    ADD</button>
            </div>
            <!-- /.card-tools -->
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
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user as $key => $v) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $v->nama_user ?></td>
                            <td><?= $v->username ?></td>
                            <td><?= $v->password ?></td>
                            <td class="text-center"><?php
                                                    if ($v->level_user == 1) {
                                                        echo '<span class="badge bg-primary">Admin</span>';
                                                    } else {
                                                        echo '<span class="badge bg-success">staff</span>';
                                                    }
                                                    ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit" data-toggle="modal" data-target="#edit<?= $v->id_user ?>"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash" data-toggle="modal" data-target="#delete<?= $v->id_user ?>"></i></button>
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

<!-- /.modal-add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add <?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo form_open('user/add');
                ?>

                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Nama User" required>
                </div>

                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="">Level User</label>
                    <select name="level_user" class="form-control">
                        <option value="">--- Level --- </option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal-edit -->
<?php

foreach ($user as $key => $v) { ?>
    <div class="modal fade" id="edit<?= $v->id_user ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?> | <?= $v->nama_user ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo form_open('user/edit/' . $v->id_user);
                    ?>

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama_user" value="<?= $v->nama_user ?>" class="form-control" placeholder="Nama User" required>
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" value="<?= $v->username ?>" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" value="<?= $v->password ?>" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label for="">Level User</label>
                        <select name="level_user" class="form-control">
                            <option value="1" <?php if ($v->level_user == 1) {
                                                    echo 'selected';
                                                } ?>>Admin</option>
                            <option value="2" <?php if ($v->level_user == 2) {
                                                    echo 'selected';
                                                } ?>>User</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<!-- /.modal-delete -->
<?php

foreach ($user as $key => $v) { ?>
    <div class="modal fade" id="delete<?= $v->id_user ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $v->nama_user ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Data akan terhapus, pastikan data sudah benar.</h6>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('user/delete/' . $v->id_user) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>