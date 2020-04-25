<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>/dist/css/adminlte.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<script src="<?= base_url('dist/datatables/jquery/jquery-2.2.3.min.js') ?>"></script>
	<script src="<?= base_url('assets/') ?>/dist/js/adminlte.min.js"></script>
</head>


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

<body class="hold-transition login-page">
	<div class="login-box">

		<div class="login-logo">
			<a href="#"> <b>User Account Control</b></a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">

			<p class="login-box-msg">Sign in to start your session</p>

			<form class="form-signin" action="<?= site_url('') ?>Login" method="POST">
				<h4 class="form-signin-heading">Login</h4>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="glyphicon glyphicon-user"></i>
						</div>
						<input type="text" class="form-control" required name="username" id="username" placeholder="Username" autocomplete="off" />
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class=" glyphicon glyphicon-lock "></i>
						</div>
						<input type="password" class="form-control" required name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
			<!-- /.social-auth-links -->

			<a href="#">I forgot my password</a>
			<br>
			<a href="#" class="text-center">Register a new membership</a>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->
</body>

</html>