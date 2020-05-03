<?php
namespace Phppot;

use \Phppot\DataSource;

class Camera
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function getCameraByCameraId($cameraId)
    {
        $query = "select * FROM registered_cameras WHERE c_id = ?";
        $paramType = "i";
        $paramArray = array($cameraId);
        $cameraResultByCID = $this->ds->select($query, $paramType, $paramArray);
        
        return $cameraResultByCID;
    }
	
	    function deleteCamera($RemoveCams)
    {
        $query = "DELETE FROM registered_cameras WHERE c_id = ? AND cam_owner = ? AND cam_secret = ?";
        $paramType = "iii";
        $paramArray = $RemoveCams;
        $cameraDELResult = $this->ds->del($query, $paramType, $paramArray);
        
        return $cameraDELResult;
    }
	
	    function getCameraByUserId($memberId)
    {
        $query = "select * FROM registered_cameras WHERE cam_owner = ?";
        $paramType = "i";
        $paramArray = array($memberId);
        $cameraResultByUID = $this->ds->select($query, $paramType, $paramArray);
        
        return $cameraResultByUID;
    }
	
		    function registerACamera($AddCameraDataArray)
    {
		$query = "INSERT INTO registered_cameras (display_camname, cam_path, cam_owner, cam_secret) VALUES (?, ?, ?, ?)";
        $paramType = "ssii";
        $paramArray = $AddCameraDataArray;
        $insertCamId  = $this->ds->insert($query, $paramType, $paramArray);
        
        return $insertCamId;
    }

}