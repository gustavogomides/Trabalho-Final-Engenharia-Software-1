<?php   
	//conexão com a base de dados
	include_once '../includes/db_connect.php';
	//funções de login
	include_once '../includes/functions.php';

	//horários e datas setados para o Brasil
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');

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

	<link href="../css/style.default.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<section>
		<?php include_once 'util/menu.php'; ?>
		<div class="mainpanel">
			<?php include_once 'util/top_bar.php'; ?>