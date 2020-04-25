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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="card-title"> <a href="<?= site_url($controller) ?>"><?= $field = str_replace('_', ' ', $controller) ?> </a> / <?= $method ?></h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                        <!-- <li class="breadcrumb-item active">User Profile</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/avatar.png') ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $this->session->userdata('fullname') ?></h3>

                            <p class="text-muted text-center"><?= $this->session->userdata('fullname') ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>User ID</b> <a class="float-right"><?= $user[0]['id'] ?></b></a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Save Change</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">


                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal" method="POST" action="<?= site_url($controller . '/Update') ?>" role="form">
                                        <input type="hidden" value="<?= $user[0]['id'] ?>" name="id">

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $user[0]['username'] ?>" id="title" class="form-control" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $user[0]['email'] ?>" id="subject" class="form-control" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Fullname</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $user[0]['fullname'] ?>" id="subject" class="form-control" name="fullname">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea name='address' class="form-control"> <?= $user[0]['address'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="<?= $user[0]['phone_number'] ?>" id="subject" class="form-control" name="phone_number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" value="" name="password" placeholder="Leave blank if you don't want to change">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Re enter Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" value="" name="re_password" placeholder="Leave blank if you don't want to change">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class=" btn btn-success"> Save</button>
                                                <a href="<?= site_url($controller) ?>" class=" btn btn-default">Back</a> </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>