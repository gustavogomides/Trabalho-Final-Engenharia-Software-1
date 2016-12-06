<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

	<title>Bankinside Corporation</title>

	<link href="css/style.default.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="signin">
	<?php
	if (isset($_GET['error'])) {
		echo '<div class="alert alert-danger">
				<button class="close" data-dismiss="alert">×</button>
				Erro ao tentar fazer login!
			</div>';
	}
	?>
	<section>
		<h2 class="page-title" align="center"> BankInside Corporation </h2>
		<div class="signinpanel">
			<div class="row">
				<div class="col-md-7">
					<div class="signin-info">
						<div class="mb20"></div>
						<strong>Não é um membro? <a href="register.php">Registre-se</a></strong>
					</div>
				</div>

				<div class="col-md-5">
					<form method="post" action="includes/process_login.php" name="login_form">
						<h4 class="nomargin">Login</h4>
						<p class="mt5 mb20">Faça login para acessar sua conta.</p>
						<input type="email" class="form-control email" name="email" required="required" placeholder="E-mail" />
						<input type="password" class="form-control pword" name="password" required="required" placeholder="Senha"/>
						<!--<input type="password" id="password" class="" placeholder="Password" />-->
						<a href=""><small>Esqueceu sua senha?</small></a>
						<input type="button" class="btn btn-success btn-block" value="Login" onclick="formhash(this.form, this.form.password);" /> 
					</form>
				</div>
			</div>

			<div class="signup-footer">
				<div class="pull-left">
					&copy; 2015. Todos os Direitos Reservados. Bankinside Corporation
				</div>
				<div class="pull-right">
					Criado por: <a href="#" target="_self">New Idea Software</a>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/modernizr.min.js"></script>
	<script src="js/jquery.sparkline.min.js"></script>
	<script src="js/jquery.cookies.js"></script>
	<script src="js/toggles.min.js"></script>
	<script src="js/retina.min.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script> 
	<script type="text/JavaScript" src="js/forms.js"></script> 
</body>
</html>
