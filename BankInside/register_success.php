<!DOCTYPE html>
<!--
Copyright (C) 2013 peredur.net

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Success</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    
<body class="signup">
	<?php
	if (!isset($_GET['error'])) {
		echo '<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				Registro concluído com Sucesso!
				Você será redirecionado em 5 segundos! 
			</div>';
		echo '<script>setTimeout(function () {
				window.location.href= "../../../index.php";
				}, 5000);
				</script>';
	}else{
		echo '<div class="alert alert-error">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Erro!</strong>O registro falhou!
		Tente novamente!
		</div>';
		}

	?>
    </body>
</html>









<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html lang="en">
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
	
</body>
</html>
