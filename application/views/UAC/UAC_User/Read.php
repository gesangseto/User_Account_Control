<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>
<?php
$controller = $this->router->fetch_class();
$method = strtolower($this->router->fetch_method()); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="card-title"> <a href="<?= site_url($controller) ?>"><?= str_replace('_', ' ', $controller) ?> </a> / <?= $method ?></h1>

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
                <li class="nav-item"><a class="nav-link" href="#group" data-toggle="tab">Group Permission</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">


                <div class="active tab-pane" id="profile">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" readonly value="<?= $user[0]['username'] ?>" id="title" class="form-control" name="title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" readonly value="<?= $user[0]['email'] ?>" id="subject" class="form-control" name="title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Fullname</label>
                      <div class="col-sm-10">
                        <input type="text" readonly value="<?= $user[0]['fullname'] ?>" id="subject" class="form-control" name="title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" readonly> <?= $user[0]['address'] ?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Phone</label>
                      <div class="col-sm-10">
                        <input type="text" readonly value="<?= $user[0]['phone_number'] ?>" id="subject" class="form-control" name="title">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <a class="btn btn-warning" href="<?= site_url('UAC_User/Update') ?>?id=<?= $user[0]['id'] ?>">Edit</a>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="tab-pane" id="group">
                  <form method="GET" action="<?= site_url('UAC_Group/Update') ?>" role="form" class="form-horizontal">
                    <input type="hidden" value="<?= $user[0]['id'] ?>" class="form-control" name="user_id">

                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label"><b>Group Permission</b></label>
                      <div class="col-sm-10">
                        <input type="text" readonly value=" <?= @$user[0]['group_name'] ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>Change Group Permission </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label"><b>Filter</b></label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <input type="search" id="SearchName" placeholder="Group Name" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" onclick="SearchGroup()"><span>
                              </span> Filter</button>
                          </span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label"><b>Select Group</b></label>
                      <div class="col-sm-10 " id="SearchResult">
                        <select required name="group_id" class="form-control">
                          <option value="">None</option>
                        </select> </div>
                    </div>

                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-warning"> Change Permission Group</button>
                        <a href="<?= site_url('UAC_Permission/Read') ?>?id=<?= $user[0]['group_id'] ?>" class="btn btn-info">
                          <i class="fa fa-lock"></i>&nbsp; View Permission</a>
                      </div>
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





























<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script>
  function SearchGroup() {
    var SearchName = $('#SearchName').val();
    if (SearchName) {
      $.ajax({
        type: 'GET',
        url: '<?= site_url("UAC/Ajax_Search/search_group"); ?>?filter=' + SearchName,
        success: function(isi) {
          $('#SearchResult').html(isi);
        }
      });
    }
  }
</script>