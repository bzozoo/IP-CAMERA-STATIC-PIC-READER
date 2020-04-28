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
	
	    function getCameraByUserId($memberId)
    {
        $query = "select * FROM registered_cameras WHERE cam_owner = ?";
        $paramType = "i";
        $paramArray = array($memberId);
        $cameraResultByUID = $this->ds->select($query, $paramType, $paramArray);
        
        return $cameraResultByUID;
    }

}