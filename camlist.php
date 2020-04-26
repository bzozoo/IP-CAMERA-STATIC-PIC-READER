<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	echo "<html>";
	echo "<head>";
	echo "<title>CAMERA LIST</title>";
	echo '<meta name="viewport" content="width=device-width, user-scalable=no">';
	echo "</head>";
	echo "<br />";
    echo "Hello $displayName";
	echo "<div style='font-size: 25px;'>";
    echo "<a href='CM1.php'>LIST-CM1</a><br />";
    echo "<a href='CM2.php'>LIST-CM2</a><br />";
    echo "<a href='CM3.php'>LIST-CM3</a>";
    echo "</div>";
	echo "Click to <a href='logout.php' class='logout-button'>Logout</a>";
	echo "<br />";
	echo "</html>";
} else {
    require_once './view/login-form.php';
}
?>