<?php
	session_start();
	//Distroy the session
	unset($_SESSION['email']);
	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['phone_number']);
	unset($_SESSION['address']);
	session_destroy();
	//Redirect user back to the login page
	header("Location: login.html");
	exit;
?>