<?php 
session_start();
$_SESSION["user_id"] = "";
session_destroy();
	if (!empty($_SERVER['HTTP_REFERER']))
    header("Location: ".$_SERVER['HTTP_REFERER']);
else
    header("Location: ./index.php");