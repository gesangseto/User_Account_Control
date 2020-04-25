<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>
<link href="<?php echo base_url('dist/datatables/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('dist/datatables/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?= base_url('dist/datatables/datatables/js/jquery.dataTables.min.js') ?>"></script>

<!-- SWAL Fire -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Body Here -->
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

          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-options">
                <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
              </div>
            </div>

            <div class="panel-body">
              <form novalidate="" role="form" class="form-horizontal">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Group Name</label>
                  <div class="col-sm-10">
                    <input type="text" readonly value="<?= $group_info[0]['group_name'] ?>" id="title" class="form-control" name="title">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Total User</label>
                  <div class="col-sm-10">
                    <input type="text" readonly value="<?= $group_info[0]['total_user'] ?>" id="subject" class="form-control" name="title">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Total Permission</label>
                  <div class="col-sm-10">
                    <input type="text" readonly value="<?= $group_info[0]['total_permission'] ?>" id="subject" class="form-control" name="title">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Latest Update</label>
                  <div class="col-sm-10">
                    <input type="text" readonly value="<?= $group_info[0]['update_time'] ?>" id="subject" class="form-control" name="title">
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <!-- <a class="btn btn-primary" href="<?= site_url('UAC_User/Create') ?>">Add Admin</a> -->
            </div>
            <div class="col-md-8">
            </div>

            <div class="col-md-12">
              <br>
              <a href="<?= site_url('UAC_Permission/Read') . "?id=" . $group_info[0]['id'] ?>" class="btn btn-info"></i>Change Permission</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Parent Map</th>
                    <th>Menu Mapping</th>
                    <th>create</th>
                    <th>read</th>
                    <th>update</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  @$no = 1;
                  foreach ($group_permission as $row) {
                  ?>
                    <tr>
                      <td><?= @$no ?></td>
                      <td><?= @$row['parent_map'] ?></td>
                      <td><?= @str_replace('_', ' ', $row['access_map']) ?></td>
                      <td><?= @$row['create'] ?></td>
                      <td><?= @$row['read'] ?> </td>
                      <td><?= @$row['update'] ?></td>
                      <td><?= @$row['delete'] ?></td>
                    </tr>
                  <?php
                    $no++;
                  } ?>
                </tbody>
              </table>
            </div>



            <div class="col-md-12">
              List User On Group
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Fullname</th>
                    <th>Phone Number</th>
                    <th>Latest Update</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  @$no = 1;
                  foreach ($group_user as $row) {
                  ?>
                    <tr>
                      <td><?= @$no ?></td>
                      <td><?= @$row['username'] ?></td>
                      <td><?= @$row['email'] ?></td>
                      <td><?= @$row['fullname'] ?></td>
                      <td><?= @$row['phone_number'] ?> </td>
                      <td><?= @$row['update_time'] ?></td>
                      <td>
                        <a href="<?php echo "" . site_url('UAC_User/Read?id=') . "" . $row['id']; ?>" class="btn btn-warning"></i>View User</a>
                      </td>
                    </tr>
                  <?php
                    $no++;
                  } ?>
              </table>
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


<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>