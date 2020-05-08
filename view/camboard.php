<?php
namespace Phppot;

use \Phppot\Camera;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Camera.php';
	require_once __DIR__ . './../class/CoreClass.php';
    $camera = new Camera();
    $cameraResultByUID = $camera->getCameraByUserId($_SESSION["userId"]);
	
	if(!empty($cameraResultByUID)) {
		$cameraListByUidArray = $cameraResultByUID;
    } else {
       $cameraListByUidArray = Array(Array(
	                        "c_id" => 0,
							'display_camname' => 'User have not a camera',
							'cam_path' => 'You have not a campath'));
    }
	
	//Camera Sorter GET
	$sortByDate = $_GET['sortdate'];
	
	//Actual CameraNumber // Need in camlist
    $actualCameraNumber = $_GET['cam_num'];
	
	//CamPath From Array $cameraListByUidArray // Need in Camreader
    $actualCamPath = $cameraListByUidArray[($_GET['cam_num']-1)]['cam_path'];
	
	//GET page
	$actpage = $_GET['page'];
	
	// Camera directzory define from ActualCam Path GET
	define("DIRECTORY", $actualCamPath);
	     
    //Folder is Empty Check function moved to functions.php
	require_once __DIR__ . './../functions.php';
	
} //Session IF end
?>