<!-- Body Here -->
<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>
<link href="<?php echo base_url('dist/datatables/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('dist/datatables/jquery/jquery-2.2.3.min.js') ?>"></script>
<script src="<?= base_url('dist/datatables/datatables/js/jquery.dataTables.min.js') ?>"></script>
<!-- SWAL Fire -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if (isset($response)) {
    if ($response['statusCode'] == 00) {
        echo '
    <script>
        $(window).load(function() {
            swal("' . $response['message'] . '", "' . $response['statusCode'] . '", "success");
        });
    </script>';
    } else {
        echo '
        <script>
            $(window).load(function() {
                swal("' . $response['message'] . '", "' . $response['statusCode'] . '", "error");
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
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#parent" data-toggle="tab">Parent Menu</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#menu" data-toggle="tab">Menu Mapping</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="active tab-pane" id="parent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a data-toggle="modal" data-target="#new_parent_map" class="btn btn-info"></i>Create New</a>
                                            </div>
                                            <div class="col-md-8">
                                            </div>

                                            <div class="col-md-12">
                                                <table id="example1" class="table table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Parent Map</th>
                                                            <th>Child Map total</th>
                                                            <th>Icon</th>
                                                            <th>Create Time</th>
                                                            <th>Last Update</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        @$no = 1;
                                                        @$count = 0;
                                                        foreach ($parent_map as $row_parent) {
                                                            echo '<tr>';
                                                            echo '<td>' . $no . '</td>';
                                                            echo '<td><b>' . str_replace('_', ' ', $row_parent['parent_map']) . '</b></td>';
                                                            foreach ($access_map as $row_access) {
                                                                if ($row_parent['parent_map'] == $row_access['parent_map']) {
                                                                    $count++;
                                                                }
                                                            }
                                                            echo '<th>' . $count . '</th>';
                                                            echo '<td>' . $row_parent['icon'] . '</td>';
                                                            echo '<td>' . $row_parent['create_time'] . '</td>';
                                                            echo '<td>' . $row_parent['update_time'] . '</td>';
                                                            echo '<td>';
                                                            echo '<a onclick="hapus_parent(' . $row_parent['id'] . ')" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                                                            echo '<a data-toggle="modal" data-target="#parent_' . $row_parent['id'] . '" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            $no++;
                                                            @$count = 0;
                                                        } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="menu">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a data-toggle="modal" data-target="#new_access_map" class="btn btn-info"></i>Create New</a>
                                            </div>
                                            <div class="col-md-8">
                                            </div>
                                            <div class="col-md-12">
                                                <table id="example2" class="table table-hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Access Map</th>
                                                            <th>Parent Map</th>
                                                            <th>Total Group</th>
                                                            <th>Create Time</th>
                                                            <th>Last Update</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        @$no = 1;
                                                        foreach ($access_map as $row_access) {
                                                            echo '<tr>';
                                                            echo '<td>' . $no . '</td>';
                                                            echo '<td><b>' . str_replace('_', ' ', $row_access['access_map']) . '</b></td>';
                                                            echo '<td>' . str_replace('_', ' ', $row_access['parent_map']) . ' </td>';
                                                            foreach ($count_access_map as $row_count) {
                                                                if ($row_access['access_map'] == $row_count['access_map']) {
                                                                    $count++;
                                                                }
                                                            }
                                                            echo '<th>' . $count . '</th>';
                                                            echo '<td>' . $row_access['create_time'] . '</td>';
                                                            echo '<td>' . $row_access['update_time'] . '</td>';

                                                            echo '<td>';
                                                            echo '<a onclick="hapus_access(' . $row_access['id'] . ')" class="btn btn-danger"><i class="fa fa-trash"></i></a>';
                                                            echo '<a data-toggle="modal" data-target="#access_' . $row_access['id'] . '" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                                                            if ($count != 0) {
                                                                echo '<a href="' . site_url('UAC_Menu_Mapping/Read') . '?id=' . $row_access['id'] . '" class="btn btn-success"><i class="fa fa-search"></i></a>';
                                                            }
                                                            echo '</td>';
                                                            echo '</tr>';
                                                            $no++;
                                                            @$count = 0;
                                                        } ?>
                                                </table>
                                            </div>
                                        </div>
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
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<?php
foreach ($parent_map as $row_parent) { ?>
    <div class="modal" id="parent_<?= $row_parent['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Parent Map</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('UAC_Menu_Mapping/Update') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-warning has-feedback">
                                    <label for="inputWarning2" class="control-label">This change will affect the appearance of the application</label>
                                </div>
                                <input type="hidden" class="form-control" required name="id" value="<?= $row_parent['id'] ?>" placeholder="email" autocomplete="off" />
                                <div class="form-group">
                                    <label for="inputWarning2" class="control-label">Parent Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        </div>
                                        <input type="test" class="form-control" required name="parent_map" value="<?= $row_parent['parent_map'] ?>" placeholder="email" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputWarning2" class="control-label">Icon from glyphicon</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        </div>
                                        <input type="text" class="form-control" required name="icon" value="<?= @$row_parent['icon'] ?>" placeholder="Username" autocomplete="off" />
                                        <div class="input-group-addon">
                                            <i class="<?= @$row_parent['icon'] ?>"></i>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn_parent_map" value="TRUE">Save</button>
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
<?php }
foreach ($access_map as $row_access) { ?>
    <div class="modal" id="access_<?= $row_access['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Access Map</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('UAC_Menu_Mapping/Update') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" required name="id" value="<?= $row_access['id'] ?>" placeholder="email" autocomplete="off" />
                                <div class="form-group">
                                    <label for="inputWarning2" class="control-label">Parent Name</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        </div>
                                        <select name="parent_map_id" required class="form-control" required>
                                            <option value="<?= $row_access['parent_map_id'] ?>" selected><?= $row_access['parent_map'] ?></option>
                                            <option value="" disabled>-Pilihan lainya-</option>
                                            <?php foreach ($parent_map as $row) {
                                                echo '<option value="' . $row['id'] . '">' . $row['parent_map'] . '</option>';
                                            }  ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputWarning2" class="control-label">Access Name</label>
                                    <input type="text" class="form-control" required name="access_map" value="<?= @$row_access['access_map'] ?>" placeholder="Username" autocomplete="off" />
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn_access_map" value="TRUE">Save</button>
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
<?php } ?>
<div class="modal" id="new_parent_map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Parent Map</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('UAC_Menu_Mapping/Create') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputWarning2" class="control-label">Parent Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                    </div>
                                    <input type="test" class="form-control" required name="parent_map" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarning2" class="control-label">Icon</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                    </div>
                                    <input type="text" class="form-control" required name="icon" autocomplete="off" />
                                </div>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="new_parent_map" value="TRUE">Create</button>
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
<div class="modal" id="new_access_map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Access Map</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('UAC_Menu_Mapping/Create') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputWarning2" class="control-label">Parent Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                    </div>
                                    <select name="parent_map_id" required class="form-control" required>
                                        <option value="" disabled selected>-Pilih-</option>
                                        <?php foreach ($parent_map as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['parent_map'] . '</option>';
                                        }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarning2" class="control-label">Access Name</label>
                                <input type="text" class="form-control" required name="access_map" autocomplete="off" />
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="new_access_map" value="TRUE">Create</button>
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
    $(document).ready(function() {
        $('#example1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
    $(document).ready(function() {
        $('#example2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
<script>
    function hapus_parent(uid) {
        console.log(uid);
        swal({
                title: "Are you sure delete this Mapping?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= site_url('UAC_Menu_Mapping/Delete?parent_map_id='); ?>" + uid;
                } else {
                    swal("Map is safe!");
                }
            });
    }

    function hapus_access(id) {
        console.log(id);
        swal({
                title: "Are you sure delete this Access Map?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= site_url('UAC_Menu_Mapping/Delete?access_map_id='); ?>" + id;
                } else {
                    swal("Map is safe!");
                }
            });
    }
</script>