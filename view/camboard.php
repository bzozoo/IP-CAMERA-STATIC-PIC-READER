<?php
namespace Phppot;

use \Phppot\Camera;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Camera.php';
    $camera = new Camera();
    $cameraResultByUID = $camera->getCameraByUserId($_SESSION["userId"]);
	if(!empty($cameraResultByUID)) {
		$cameraListByUidArray = $cameraResultByUID;
    } else {
       $cameraListByUidArray = "User have not a camera";
    }
}
?>