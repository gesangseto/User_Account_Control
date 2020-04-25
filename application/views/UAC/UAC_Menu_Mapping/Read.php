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

              <div class="row">
                <div class="col-md-4">
                  <!-- <a class="btn btn-primary" href="<?= site_url('UAC_User/Create') ?>">Add Admin</a> -->
                </div>
                <div class="col-md-8">
                </div>

                <div class="col-md-12">
                  <br>
                  <table id="example1" class="table table-hover" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Group</th>
                        <th>Create</th>
                        <th>Read</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      @$no = 1;
                      foreach ($access_map as $row) {
                      ?>
                        <tr>
                          <td><?= @$no ?></td>
                          <td><b><?= @$row['group_name'] ?></b></td>
                          <td>
                            <?php if (@$row['create'] == 1) {
                              echo '<input type="checkbox" checked disabled>';
                            } else {
                              echo '<input type="checkbox" disabled>';
                            } ?>
                          </td>
                          <td>
                            <?php if (@$row['read'] == 1) {
                              echo '<input type="checkbox" checked disabled>';
                            } else {
                              echo '<input type="checkbox" disabled>';
                            } ?>
                          </td>
                          <td>
                            <?php if (@$row['update'] == 1) {
                              echo '<input type="checkbox" checked disabled>';
                            } else {
                              echo '<input type="checkbox" disabled>';
                            } ?>
                          </td>
                          <td>
                            <?php if (@$row['delete'] == 1) {
                              echo '<input type="checkbox" checked disabled>';
                            } else {
                              echo '<input type="checkbox" disabled>';
                            } ?>
                          </td>
                          <td>
                            <a href="<?= base_url('UAC_Permission/Delete') ?>?group_id=<?= $row['group_id'] ?>&permission_id=<?= $row['permission_id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <a href="<?= base_url('UAC_Permission/Read') ?>?id=<?= $row['group_id'] ?>" class="btn btn-success"><i class="fa fa-search"></i></a>
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

        </div>
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>










<!--footer-->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  function hapus(uid) {
    swal({
        title: "Are you sure delete this user?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = "<?= site_url('User_mapping/Delete?id_user='); ?>" + uid;
        } else {
          swal("User is safe!");
        }
      });
  }
</script>