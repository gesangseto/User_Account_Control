<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>
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
                    <div class="col-md-12">

                        <form class="form-horizontal" action="<?= site_url('UAC_Group/Update') ?>" method="POST" role="form">
                            <input type="hidden" name="id" value="<?= @$group[0]['id'] ?>">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Group Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required value="<?= @$group[0]['group_name'] ?>" name="group_name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Group Info:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required value="<?= @$group[0]['group_info'] ?>" name="group_info">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class=" btn btn-success"> Save</button>
                                    <a href="<?= site_url($controller) ?>" class=" btn btn-default">Back</a> </div>
                            </div>
                        </form>
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