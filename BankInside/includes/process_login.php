<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start(); // Nossa segurança personalizada para iniciar uma sessão php.

if (isset($_POST['email'], $_POST['p'])) {
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = $_POST['p']; // The hashed password.

	if (login($email, $password, $mysqli) == true) {
		// Login com sucesso 
		header('Location: ../admin/index.php');
		exit();
	} else {
		// Falha de login 
		header('Location: ../index.php?error=1');
		exit();
	}
} else {
	// The correct POST variables were not sent to this page. 
	header('Location: ../error.php?err=Could not process login');
	exit();
}
