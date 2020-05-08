<?php
session_start();
//user session check
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	require_once './view/camboard.php';


	echo "Welcome $displayName on NUM-$actualCameraNumber camera!";
    echo "<a href='camlist.php?&sortdate=$sortByDate' class='logout-button'>[CAMLIST]</a>";
	echo "<a href='logout.php' class='logout-button'>[Logout]</a><br />";
	echo "Actual campath: [$actualCamPath] Sort by: <a href='?page=$actpage&cam_num=$actualCameraNumber&sortdate=ASC'>[ASC]</a> <a href='?page=$actpage&cam_num=$actualCameraNumber&sortdate=DSC'>[DSC]</a><br />";

	   //Directory exist check
       if (is_dir(DIRECTORY)) {
		   //Directory empty check
           if (dirisempty(DIRECTORY)) {
               echo "This directory (".  DIRECTORY . ") is empty! We can display nothing."; 
               } else {
                       require_once('core.php'); 
               }
 
          } else {
                   echo "This directory (".  DIRECTORY . ") does not exist! Please define a new directory path!";
          }

    } else {
            require_once './view/login-form.php';
}
?>