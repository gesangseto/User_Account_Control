<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>
<link href="<?php echo base_url('dist/datatables/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('dist/datatables/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?= base_url('dist/datatables/datatables/js/jquery.dataTables.min.js') ?>"></script>

<!-- SWAL Fire -->
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

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <a data-toggle="modal" data-target="#create_permission" class="btn btn-default"></i>Give Permission</a>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody><?php
                        @$no = 1;
                        foreach ($uac_permission as $row) {
                        ?>
                    <tr>
                      <td><?= @$no ?></td>
                      <td><b><?= @$row['parent_map'] ?></b></td>
                      <td><?= @str_replace('_', ' ', $row['access_map']) ?></td>
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
                        <button onclick="hapus(<?= @$row['permission_id']; ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <a data-toggle="modal" data-target="#role_<?= @$row['permission_id']; ?>" class="btn btn-warning"></i>manage permission</a>
                      </td>
                    </tr>
                  <?php
                          $no++;
                        } ?>
                </tbody>
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














<?php
foreach ($uac_permission as $row_role) { ?>
  <div class="modal" id="role_<?= $row_role['permission_id'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit permission
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="<?= site_url('UAC_Permission/Update') ?>" method="POST">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group has-warning has-feedback">
                  <label for="inputWarning2" class="control-label">This change will affect the access user to the application</label>
                  <input type="text" name="permission_id" hidden value="<?= $row_role['permission_id'] ?>">
                  <input type="text" name="group_id" hidden value="<?= $group_info[0]['id'] ?>">
                </div>
                <div class="form-group ">
                  <table class="" style="width:100%">
                    <thead>
                      <tr>
                        <td width="25%"></td>
                        <td width="5%"></td>
                        <td width="75%"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><b>Access Map </b></td>
                        <td><b>:</b></td>
                        <td><b><?= $row_role['access_map'] ?></b> </td>
                      </tr>
                      <tr>
                        <td><b>Parent Map</b></td>
                        <td><b>:</b></td>
                        <td><b><?= $row_role['parent_map'] ?></b> </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <input type="hidden" class="form-control" required name="id" value="<?= $row_role['permission_id'] ?>" placeholder="email" autocomplete="off" />
                <div class="form-group">
                  <div row>
                    <div class="col-md-12">



                      <label class="checkbox-group">
                        <?php if ($row_role['create'] == 1) {
                          echo '<input type="checkbox" name="create" checked >';
                        } else {
                          echo '<input type="checkbox" name="create">';
                        } ?> Create
                        <span class="checkmark"></span>
                      </label>


                      <label class="checkbox-group">
                        <?php if ($row_role['read'] == 1) {
                          echo '<input type="checkbox" name="read" checked >';
                        } else {
                          echo '<input type="checkbox" name="read">';
                        } ?> Read
                        <span class="checkmark"></span>
                      </label>


                      <label class="checkbox-group">
                        <?php if ($row_role['update'] == 1) {
                          echo '<input type="checkbox" name="update" checked >';
                        } else {
                          echo '<input type="checkbox" name="update">';
                        } ?> Update
                        <span class="checkmark"></span>
                      </label>


                      <label class="checkbox-group">
                        <?php if ($row_role['delete'] == 1) {
                          echo '<input type="checkbox" name="delete" checked >';
                        } else {
                          echo '<input type="checkbox" name="delete">';
                        } ?> Delete
                        <span class="checkmark"></span>
                      </label>

                    </div>
                  </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="change_permission" value="TRUE">Save</button>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-lg btn-danger btn-block" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php }
?>
<div class="modal" id="create_permission">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Permission</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('UAC_Permission/Create') ?>" method="POST">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="group_id" hidden value="<?= $group_info[0]['id'] ?>">
                <div class="input-group">
                  <div class="input-group-addon">Access
                  </div>
                  <select name="access_map_id" required class="form-control" required>
                    <option value="" disabled selected>-Pilih-</option>
                    <?php
                    foreach ($parent_map as $row_parent) {
                      echo '<optgroup label="' . $row_parent['parent_map'] . '">';
                      foreach ($access_map as $row_access) {
                        if ($row_parent['parent_map'] == $row_access["parent_map"]) {
                          echo '<option value="' . $row_access['id'] . '">' . $row_access['access_map'] . '</option>';
                        }
                      }
                      echo '</li>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">

                <label class="checkbox-group">
                  <input type="checkbox" name="create"> Create
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-group">
                  <input type="checkbox" name="read"> Read
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-group">
                  <input type="checkbox" name="update"> Update
                  <span class="checkmark"></span>
                </label>
                <label class="checkbox-group">
                  <input type="checkbox" name="delete"> Delete
                  <span class="checkmark"></span>
                </label>

              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="create_permission" value="TRUE">Create</button>
            </div>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-lg btn-danger btn-block" type="button" data-dismiss="modal">Cloe</button>
      </div>

    </div>
  </div>
</div>

<script>
  function hapus(uid) {
    swal({
        title: "Are you sure delete this role permission?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = "<?= site_url('UAC_Permission/Delete?permission_id='); ?>" + uid + "&group_id=<?= $group_info[0]['id'] ?>";
        } else {
          swal("User is safe!");
        }
      });
  }
</script>





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
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>