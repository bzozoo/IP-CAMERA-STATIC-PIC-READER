<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	require_once './view/camboard.php';
	$sessionUserID = $_SESSION['userId'];
	echo "<html>";
	echo "<head>";
	echo "<title>CAMERA LIST</title>";
	echo '<meta name="viewport" content="width=device-width, user-scalable=no">';
	echo "</head>";
	echo "<br />";
		
    echo "Hello $displayName UID($sessionUserID)";
	echo "<br />";	echo "<br />";
	
	echo "<div style='font-size: 18px;'>";
	//Camlist
	
	foreach($cameraListByUidArray as $key => $value1) {
    echo ($key+1), ' - '; echo $value1['c_id'], ' - '; echo $value1['display_camname'], ' - '; echo $value1['cam_path'], ' - '; echo '<a href="camreader.php?cam_num=', ($key+1), '">VIEW</a><br>';
    }

	echo "</div>";
	echo "Click to <a href='logout.php' class='logout-button'>Logout</a>";
	echo "<br />";
	echo "<hr />";
	echo "<pre>";
    print_r($cameraListByUidArray);
    echo "</pre>";
	$key10 = array_search('4', array_column($cameraListByUidArray, 'c_id'));
	echo $key10;
	echo "<br />";
	echo "</html>";
} else {
    require_once './view/login-form.php';
}
?>