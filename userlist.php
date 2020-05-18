<?php
session_start();
	echo "<html>";
	echo "<head>";
	echo "<title>USEER LIST</title>";
	echo '<meta name="viewport" content="width=device-width, user-scalable=no">';
	echo "<link href='./view/css/style.css' rel='stylesheet' type='text/css' />";
	echo "</head>";
	echo "<br />";
if(empty($_SESSION["userId"])) {
	require_once './view/login-form.php';
    exit;
}

    //We need require userboard to admin check!
    require_once './view/userboard.php';
	if ($adminCheck == NULL) {
		echo "This page visible only for admin. Got to -> <a href='./'>Dashboard</a>";
	    echo "<br />";
	    echo "Click to <a href='logout.php' class='logout-button'>Logout</a>";
	    exit;
	}
	require_once 'functions.php';
	
    echo "  <div class='dashboard'>
            <div class='member-dashboard'>";
    echo "Hello $displayName UID($sessionUserID) <a href='./'>[Dashboard]</a>";
	echo "<br />";
	
	predumparray($AllMemberResult);
	
	echo "<br />";
	echo "Click to <a href='logout.php' class='logout-button'>Logout</a>";
	echo "<br />";	
	echo "<hr />";
	echo "  </div>
            </div>";
	echo "</html>";
?>