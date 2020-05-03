<?php
session_start();
//user session check
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	require_once './view/camboard.php';
	require_once './class/CoreClass.php';
	
	//CameraNumber
    $actualCameraNumber = $_GET['cam_num'];
    $actualCamPath = $cameraListByUidArray[($_GET['cam_num']-1)]['cam_path'];
	$actpage = $_GET['page'];
	$sortByDate = $_GET['sortdate'];
	echo "Welcome $displayName on NUM-$actualCameraNumber camera!";
    echo "<a href='camlist.php?&sortdate=$sortByDate' class='logout-button'>[CAMLIST]</a>";
	echo "<a href='logout.php' class='logout-button'>[Logout]</a><br />";
	echo "Actual campath: [$actualCamPath] Sort by: <a href='?page=$actpage&cam_num=$actualCameraNumber&sortdate=ASC'>[ASC]</a> <a href='?page=$actpage&cam_num=$actualCameraNumber&sortdate=DSC'>[DSC]</a><br />";

    define("DIRECTORY", $actualCamPath);
	     
		 // Empty dir checking function
	     function is_dir_empty($dir) {
                  if (!is_readable(DIRECTORY)) return NULL; 
                  return (count(scandir(DIRECTORY)) == 2);
        }
	   
	   //Directory exist check
       if (is_dir(DIRECTORY)) {
		   //Directory empty check
           if (is_dir_empty(DIRECTORY)) {
               echo "This directory (".  DIRECTORY . ") is empty! We can display nothing."; 
               } else {
                       require_once('core-teszt.php'); 
               }
 
          } else {
                   echo "This directory (".  DIRECTORY . ") does not exist! Please define a new directory path!";
          }

    } else {
            require_once './view/login-form.php';
}
?>