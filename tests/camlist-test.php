<?php
session_start();
if(empty($_SESSION["userId"])) {
 require_once './view/login-form.php';
 exit;
}
    require_once './view/userboard.php';
	require_once './view/camboard.php';
	
	echo "<html>";
	echo "<head>";
	echo "<title>CAMERA LIST</title>";
	echo '<meta name="viewport" content="width=device-width, user-scalable=no">';
	echo "<link href='./view/css/style.css' rel='stylesheet' type='text/css' />";
	echo "<link href='./view/css/deletepopup.css' rel='stylesheet' type='text/css' />";
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
                
            </tr>
			    <td colspan='2'>
				<a href='camreader.php?cam_num=$KeyPlusOne&sortdate=$sortByDate'><button>VIEW</button></a>
				</td>
                <td colspan='1'>
				<script>
				var hidimp$KeyPlusOne = \"<input type='hidden' id='delcamID-$KeyPlusOne' name='delcamID' value='$cID'>\"
				</script>
				
				<input  onclick=\"document.getElementById('id01').style.display='block'; document.getElementById('deletesure').innerHTML = 'Are You sure DELETE $KeyPlusOne. camera? ' + hidimp$KeyPlusOne \" type='button' id='delcam-$KeyPlusOne' name='delalert'  value='DEL'>
			<tr>
			
			</tr>";
        }
		
    echo "</tbody>
    </table>";
	
	echo "<!-- MODAL DELETE CONFIRM -->
	<div id='id01' class='modal'>
  <span onclick=\"document.getElementById('id01').style.display='none'\" class='close' title='Close Modal'>&times;</span>
  <form class='modal-content' action='./camera-action.php?act=del' method='POST' id='miDeletion' name='miDeletion'>
    <div class='container'>
      <h1>Delete a Camera</h1>
      <p id='deletesure'>Are you sure?</p>

      <div class='clearfix'>
        <button onclick=\"document.getElementById('id01').style.display='none'\" type='button' class='cancelbtn'>Cancel</button>
        <button type='submit' class='deletebtn' name='delcam' value='Delete'>Delete</button>
      </div>
    </div>
  </form>
</div>
<!-- DELETE MODAL JS + -->
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}
</script>
	";
	
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
        </tr>
		<tr>
            <td><input type='hidden' id='cam_owner' name='cam_owner' value='$sessionUserID' required />
			    <input type='text' id='cam_name' name='cam_name' placeholder='MyCamera' required /></td>
            <td><input type='text' id='cam_path' name='cam_path' placeholder='/My/Image/Path/' required /></td>
         </tr>
		 <tr>
			<td colspan='2'><input type='submit' id='addcam' name='addcam' value='ADD'></td>
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
?>