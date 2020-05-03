<?php
namespace Phppot;

use \Phppot\Camera;
session_start();
 
if(!empty($_SESSION["userId"])) {
require_once ("./class/Camera.php");
$camera = new Camera();

 if (($_GET["act"]) == "add") {
  if (isset($_POST["addcam"]) && isset($_POST["cam_owner"]) && isset($_POST["cam_name"]) && isset($_POST["cam_path"])) {
	  if ($_POST["cam_owner"] == $_SESSION["userId"]) {
	     $AddCameraName = filter_var($_POST["cam_name"], FILTER_SANITIZE_STRING);
	     $AddCamPath = filter_var($_POST["cam_path"], FILTER_SANITIZE_STRING);
	     $AddCamOwner = filter_var($_SESSION["userId"], FILTER_SANITIZE_NUMBER_INT);
		 $rander = rand(10000000, 99999999);
         $AddCameraDataArray = Array($AddCameraName, $AddCamPath, $AddCamOwner, $rander);
	     $insertCamId  = $camera->registerACamera($AddCameraDataArray);
	  } else {  $_SESSION['try_hackID_message'] = "Dont try ADD camrea for other user!";}
  }

 }
 
  if (($_GET["act"]) == "del") {
	    if (isset($_POST["delcam"]) && isset($_POST["delcamID"])) {
	        $DelCamIDval = filter_var($_POST["delcamID"], FILTER_SANITIZE_NUMBER_INT);
			$DelCamSecret = $_SESSION[$DelCamIDval. '-CAM'];
			$DelCamOwner = filter_var($_SESSION["userId"], FILTER_SANITIZE_NUMBER_INT);
			$DelCamSecret = filter_var($_SESSION[$DelCamIDval. '-CAM'], FILTER_SANITIZE_NUMBER_INT);
		    $DelCameraDataArray = Array('0'=>$DelCamIDval, '1'=>$DelCamOwner, '2'=>$DelCamSecret);
			if (($DelCameraDataArray[2]) > 9999999) {
			$cameraDELResult  = $camera->deleteCamera($DelCameraDataArray);
		    $_SESSION['deletedcamera_message'] = " Camera with ID " . $DelCamIDval . " is DELETED <br />";
			} else {
            $_SESSION['deletedcamera_message'] = " I cloud not DELETE ID " . $DelCamIDval . " camera<br />";			
			}
		}
  }
            	if (!empty($_SERVER['HTTP_REFERER'])) {
                header("Location: ".$_SERVER['HTTP_REFERER']);
			} else {  header("Location: ./index.php"); exit(); }
}