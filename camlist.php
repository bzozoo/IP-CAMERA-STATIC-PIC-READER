<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	require_once './view/camboard.php';
	$sessionUserID = $_SESSION['userId'];
	$sortByDate = $_GET['sortdate'];
	echo "<html>";
	echo "<head>";
	echo "<title>CAMERA LIST</title>";
	echo '<meta name="viewport" content="width=device-width, user-scalable=no">';
	echo "<link href='./view/css/style.css' rel='stylesheet' type='text/css' />";
	echo "</head>";
	echo "<br />";
	
	echo "  <div class='dashboard'>
            <div class='member-dashboard'>";
    echo "Hello $displayName UID($sessionUserID) <a href='./'>[Dashboard]</a>";
	echo "<br />";
	echo "<div style='font-size: 18px; text-align: -webkit-center; text-align: -moz-center;'>";
	//Camlist
	echo "<h2>Camera List</h2>";
	echo $_SESSION['deletedcamera_message'];
	unset($_SESSION['deletedcamera_message']);
	echo "
	<table border='1'>
     <tbody>
        <tr>
            <td><b>NUM</b></td>
            <td><b>NAME</b></td>
            <td><b>PATH</b></td>
            <td><b>View</b></td>
            <td><b>Update</b></td>
            <td><b>Delete</b></td>
        </tr>";
		foreach($cameraListByUidArray as $key => $value1) {
		$cID = $value1['c_id'];
		$camSecret = $value1['cam_secret'];
		$_SESSION[$cID.'-CAM'] = "$camSecret";
		$cams = $_SESSION[$cID.'-CAM'];
		$CamNameDisplay = $value1['display_camname'];
        $CamPathDisplay = $value1['cam_path'];
		$KeyPlusOne = ($key+1);
        echo "
		    <!-- CID $cID CAMS $cams -->
			 <tr>
                <td>$KeyPlusOne</td>
                <td>$CamNameDisplay</td>
                <td>$CamPathDisplay</td>
                <td><a href='camreader.php?cam_num=$KeyPlusOne&sortdate=$sortByDate'>VIEW</a></td>
                <td>SOON!</td>
                <td><form action='./camera-action.php?act=del' method='POST'>
				<input type='hidden' id='delcamID-$KeyPlusOne' name='delcamID' value='$cID'>
				<input type='submit' id='delcam-$KeyPlusOne' name='delcam' value='DEL'>
				</form>
				</td>
              </tr>";
        }
		
    echo "</tbody>
    </table>";
	
    echo "<br />";
	echo "<b>Add a Camera:</b>";
	echo "<br />";
	echo $_SESSION['try_hackID_message'] . "<br />";
	unset($_SESSION['try_hackID_message']);
	echo "
	<form action='./camera-action.php?act=add' method='POST'>
	<table border='1'>
     <tbody>
        <tr>
            <td><b>CAMERA NAME</b></td>
            <td><b>CAMERA PATH</b></td>
            <td><b>Submit</b></td>
        </tr>
		<tr>
            <td><input type='hidden' id='cam_owner' name='cam_owner' value='$sessionUserID' required />
			    <input type='text' id='cam_name' name='cam_name' placeholder='MyCamera' required /></td>
            <td><input type='text' id='cam_path' name='cam_path' placeholder='/My/Image/Directory/Path/' required /></td>
            <td><input type='submit' id='addcam' name='addcam' value='ADD'></td>
        </tr>
		</tbody>
    </table>
	</form> 
		";
	echo "</div>";
	echo "<br />";

	echo "Sort camera images by: <a href='?&sortdate=ASC'>[ASC]</a> <a href='?&sortdate=DSC'>[DSC]</a>";
	echo "<br />";
	echo "<br />";
	echo "Click to <a href='logout.php' class='logout-button'>Logout</a>";
	echo "<br />";
	echo "<hr />";
	
	echo "  </div>
            </div>";

	echo "</html>";
} else {
    require_once './view/login-form.php';
}
?>