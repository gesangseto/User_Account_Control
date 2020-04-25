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
                    <div class="col-md-4">
                        <a class="btn btn-primary" href="<?= site_url('UAC_Group/Create') ?>">Add Group</a>
                    </div>
                    <div class="col-md-8">
                    </div>

                    <div class="col-md-12">
                        <br>
                        <table id="table" class="display table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Group Name</th>
                                    <th>Info</th>
                                    <th>User on Group</th>
                                    <th>Update Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('UAC/Ajax_Datatables/get_data_user_group') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });

    });
</script>
<script>
    function hapus(uid) {
        swal({
                title: 'Are you sure?',
                text: "This will delete everything related to this group like Permission and User!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= site_url('UAC_Group/Delete?id='); ?>" + uid;
                } else {
                    swal("Group is safe!");
                }
            });
    }
</script>