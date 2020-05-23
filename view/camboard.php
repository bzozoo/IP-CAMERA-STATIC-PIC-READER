<?php
namespace Phppot;

use \Phppot\Camera;
use \Phppot\coreClass;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Camera.php';
	require_once __DIR__ . './../class/CoreClass.php';
    $camera = new Camera();
	$newCoreClass = new coreClass();
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
	
    //Directory exist check
        if (is_dir(DIRECTORY)) {
		   //Directory empty check
           if (dirisempty(DIRECTORY)) {
               $dircheck = "This directory (".  DIRECTORY . ") is empty! We can display nothing."; 
               } else {
                       $dircheck = null;
               }
 
          } else {
               $dircheck = "This directory (".  DIRECTORY . ") does not exist! Please define a new directory path!";
          }
		  


// Glob files from defined dyrectory
$ArrayedGlob = $newCoreClass->globArray(DIRECTORY);
$imagARRAY = $newCoreClass->imagedataArray($ArrayedGlob);
$countglobarry = count($ArrayedGlob);
$negocountglobarry = (-1 * abs($countglobarry));
$page = $_GET['page'];
$perpage = 200;
$totalpage = (int)ceil(count($ArrayedGlob) / $perpage);

	 //Check pageGET exist or not
	$pagenum = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$pagenum = max(1, min($totalpage, $pagenum));
		
	//Check Next
	if ($pagenum == $totalpage) {
         $next = 1;
	     } else {
	      $next = ($pagenum + 1); 
	     }
	
	//Check Prev
	if ($pagenum == 1) {
         $prev = $totalpage;
	     } else {
	     $prev = ($pagenum - 1);
	     }
		
// SLICE calculators		
$slicestartcalculated = ($pagenum*$perpage)-$perpage; // Calculate Page start. Other: ($pagenum - 1) * $perpage;
$slicestopcalculated = $negocountglobarry + ($pagenum * $perpage); // Calculate Page stop
      
  $slicestart = $slicestartcalculated; // Always equal
           
   if ($slicestopcalculated < 0) {
       $slicestop = $slicestopcalculated; // Equal IF calculated  <0 
	   } 
	   else {
      $slicestop = NULL; // Not calculated IF not <0
      }
	  
// PREV - NEXT LINKS
$prevlink = "?page=$prev&cam_num=$actualCameraNumber&sortdate=$sortByDate";
$nextlink = "?page=$next&cam_num=$actualCameraNumber&sortdate=$sortByDate";

//Initialize CountAllFiles for Camlist
$countallfiles = 0;
	
} //Session IF end
?>