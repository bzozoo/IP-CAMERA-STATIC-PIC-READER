<?php
session_start();
if(empty($_SESSION["userId"])) {
    require_once './view/login-form.php';
	exit;
}
	require_once './view/dashboard.php';
?>