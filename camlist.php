<?php
session_start();
if(empty($_SESSION["userId"])) {
 require_once './view/login-form.php';
 exit;
}
    require_once './view/userboard.php';
	require_once './view/camboard.php';
?>
<html>
<head>
<title>CAMERA LIST</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link href='./view/css/style.css' rel='stylesheet' type='text/css' />
<link href='./view/css/deletepopup.css' rel='stylesheet' type='text/css' />
</head>
<br />
	
<div class='dashboard'>
  <div class='member-dashboard'>
    Hello <? echo $displayName; ?> UID(<? echo $sessionUserID; ?>) <a href='./'>[Dashboard]</a>
	<br />
	 <div style='font-size: 18px; text-align: -webkit-center; text-align: -moz-center;'>
	
	<h2>Camera List</h2>
	<?php
	echo $_SESSION['deletedcamera_message'];
	unset($_SESSION['deletedcamera_message']);
	?>
	
	<table border='1'>
     <tbody>
        <tr>
            <td><b>NUM</b></td>
            <td><b>NAME</b></td>
            <td><b>PATH</b></td>
        </tr>
		
		<?php
		foreach($cameraListByUidArray as $key => $value1) {
		$cID = $value1['c_id'];
		$camSecret = $value1['cam_secret'];
		$_SESSION[$cID.'-CAM'] = "$camSecret";
		$cams = $_SESSION[$cID.'-CAM'];
		$CamNameDisplay = $value1['display_camname'];
        $CamPathDisplay = $value1['cam_path'];
		$KeyPlusOne = ($key+1);
        ?>
		    <!-- CID <?echo$cID; CAMSEC <?echo$cams;?> -->
			 <tr>
                <td><?echo$KeyPlusOne;?></td>
                <td><?echo$CamNameDisplay;?></td>
                <td><?echo$CamPathDisplay;?></td>
                
            </tr>
			    <td colspan='2'>
				<a href='camreader.php?cam_num=<?echo $KeyPlusOne;?>&sortdate=<?echo $sortByDate;?>'><button>VIEW</button></a>
				</td>
                <td colspan='1'>
				<script>
				var hidimp<?echo $KeyPlusOne;?> = "<input type='hidden' id='delcamID-<?echo $KeyPlusOne;?>' name='delcamID' value='<? echo $cID;?>'>"
				</script>
				
				<input  onclick="document.getElementById('deleteModal').style.display='block'; document.getElementById('deletesure').innerHTML = 'Are You sure DELETE <?echo $KeyPlusOne;?>. camera? ' + hidimp<? echo $KeyPlusOne;?>" type='button' id='delcam-$KeyPlusOne' name='delalert'  value='DEL'>
			<tr>
			
			</tr>
        <? } //ForeachEnd ?>
		
    </tbody>
    </table>
	
	<!-- MODAL DELETE CONFIRM -->
	<div id='deleteModal' class='modal'>
  <span onclick=\"document.getElementById('deleteModal').style.display='none'\" class='close' title='Close Modal'>&times;</span>
  <form class='modal-content' action='./camera-action.php?act=del' method='POST' id='miDeletion' name='miDeletion'>
    <div class='container'>
      <h1>Delete a Camera</h1>
      <p id='deletesure'>Are you sure?</p>

      <div class='clearfix'>
        <button onclick="document.getElementById('deleteModal').style.display='none'" type='button' class='cancelbtn'>Cancel</button>
        <button type='submit' class='deletebtn' name='delcam' value='Delete'>Delete</button>
      </div>
    </div>
  </form>
</div>
<!-- DELETE MODAL JS + -->
<script>
// Get the modal
var modal = document.getElementById('deleteModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}
</script>
	
   <br />
   <b>Add a Camera:</b>
    <br />
	<?
	echo $_SESSION['try_hackID_message'] . "<br />";
	unset($_SESSION['try_hackID_message']);
	?> 
	 
	<form action='./camera-action.php?act=add' method='POST'>
	<table border='1'>
     <tbody>
        <tr>
            <td><b>CAMERA NAME</b></td>
            <td><b>CAMERA PATH</b></td>
        </tr>
		<tr>
            <td><input type='hidden' id='cam_owner' name='cam_owner' value='<?echo $sessionUserID;?>' required />
			    <input type='text' id='cam_name' name='cam_name' placeholder='MyCamera' required /></td>
            <td><input type='text' id='cam_path' name='cam_path' placeholder='/My/Image/Path/' required /></td>
         </tr>
		 <tr>
			<td colspan='2'><input type='submit' id='addcam' name='addcam' value='ADD'></td>
        </tr>
		</tbody>
    </table>
	</form> 
		
	   </div>
	    <br />

	   Sort camera images by: <a href='?&sortdate=ASC'>[ASC]</a> <a href='?&sortdate=DSC'>[DSC]</a>
	   <br />
	   <br />
	     Click to <a href='logout.php' class='logout-button'>Logout</a>
	     <br />
	      <hr />

	       </div>
             </div> 
	</html>