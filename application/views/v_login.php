<div class="card">
    <div class="card-body register-card-body">
        <h1 class="login-box-msg">Login</h1>

        <?php
        echo validation_errors('<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>', '</div>');

        if ($this->session->flashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>';
            echo $this->session->flashdata('pesan');
            echo '</div>';
        }

        if ($this->session->flashdata('error')) {
            echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i>Gagal</h5>';
            echo $this->session->flashdata('error');
            echo '</div>';
        }
        echo form_open('pelanggan/login'); ?>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">

            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-success required btn-block">Login</button>
            </div>
            <div class="col-4">

            </div>
            <!-- /.col -->
        </div>
        <?php echo form_close() ?>

        <a href="<?= base_url('pelanggan/daftar') ?>" class="text-center">Belum punya akun?daftar</a>
    </div>
    <!-- /.form-box -->
</div><!-- /.card -->
<br><br><br><br><br><br><br><br><br><br><br><br>