<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url('dist/datatables/jquery/jquery-2.2.3.min.js') ?>"></script>

<?php if (isset($response)) {
    if ($response['statusCode'] == 00) {
        echo '
    <script>
        $(window).load(function() {
            swal("' . $response['message'] . '", "", "success");
        });
    </script>';
    } else {
        echo '
        <script>
            $(window).load(function() {
                swal("' . $response['message'] . '", "", "error");
            });
        </script>';
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <h3 class="card-title"> <a href="<?= site_url($controller) ?>"><?= str_replace('_', ' ', $controller) ?> </a> / <?= $method ?></h3>


                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <a href='#' type="button" class="btn btn-tool">
                        <i class="fas fa-times"></i></a>
                </div>
            </div>
            <div class="card-body">

                <div class="content-row">
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                        </div>

                        <div class="col-md-12">
                            <form action="<?= site_url('UAC_User/Create') ?>" method="POST">
                                <div class="form-group">
                                    <label for="group_name">Fullname:</label>
                                    <input type="text" class="form-control" required value="<?= @$user['fullname'] ?>" name="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="group_info">Username:</label>
                                    <input type="text" class="form-control" required value="<?= @$user['username'] ?>" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="group_info">Email:</label>
                                    <input type="email" class="form-control" required value="<?= @$user['email'] ?>" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" required name="password">
                                </div>
                                <div class="form-group">
                                    <label for="">Re enter Password:</label>
                                    <input type="password" class="form-control" required name="re_password">
                                </div>
                                <div class="form-group">
                                    <label for="group_info">Phone Number:</label>
                                    <input type="text" pattern="\d*" minlength="10" maxlength="12" value="<?= @$user['phone_number'] ?>" class="form-control" required name="phone_number">
                                </div>
                                <div class="form-group">
                                    <label for="group_info">Address:</label>
                                    <input type="text" class="form-control" required value="<?= @$user['address'] ?>" name="address">
                                </div>
                                <button type="submit" class="btn btn-info">Create</button>
                                <a class="btn btn-default" href='<?= site_url('UAC_User/') ?>'>Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>