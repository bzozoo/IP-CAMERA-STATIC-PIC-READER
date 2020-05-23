<?php
session_start();
if(empty($_SESSION["userId"])) {
 require_once './view/login-form.php';
 exit;
}
    require_once './view/userboard.php';
	require_once './view/camboard.php';
	
	//We have $newCoreClass = new coreClass(); in camboard.php
?>
<html>
<head>
<title>CAMERA LIST</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link href='./view/css/style.css' rel='stylesheet' type='text/css' />
<link href='./view/css/deletepopup.css' rel='stylesheet' type='text/css' />
<link href='./view/css/camlist.css' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<br />
	
<div class='dashboard'>
  <div class='member-dashboard'>
    Hello <? echo $displayName; ?> UID(<? echo $sessionUserID; ?>) <a href='./'>[Dashboard]</a>
	<br />
	
	
	<h2>Camera List</h2>
	<p>(<? echo count($cameraListByUidArray);?> cams)</p>
	<?php
	echo $_SESSION['deletedcamera_message'];
	unset($_SESSION['deletedcamera_message']);
	?>
		
		<?php
		// $cameraListByUidArray in camboard.php
		foreach($cameraListByUidArray as $key => $value1) {
		// Camera ID var
		$cID = $value1['c_id'];
		// Camera Secret Value Var
		$camSecret = $value1['cam_secret'];
		// Camera ID pair with Secret in session
		$_SESSION[$cID.'-CAM'] = "$camSecret";
		// Check CamSecret Value from session 
		$cams = $_SESSION[$cID.'-CAM'];
		//Get Camera Name
		$CamNameDisplay = $value1['display_camname'];
        // Get Camera path
		$CamPathDisplay = $value1['cam_path'];
		// Gen An array with actual CAM PATH
		$ArrayedDir = $newCoreClass->globArray($CamPathDisplay);
		//Get Image Datas If ArrayedDir not null
		if (!empty($ArrayedDir)) {
		  $GetImageDatas = $newCoreClass->imagedataArray($ArrayedDir);
		  $LastPicDate = date("Y F d H:i:s", $GetImageDatas[0]['pictdate']);
		} else {
			$GetImageDatas[0]['picturl'] = "No";
			$LastPicDate = $GetImageDatas[0]['pictdate'] = "data";
		}
		//Total item in actual CAM PATH array
		$TotalFilesInDir = count($ArrayedDir);
		// First item GET NUM 1
		$KeyPlusOne = ($key+1);
		$countallfiles = $countallfiles + $TotalFilesInDir; 
		
        ?>
		
		 <!-- CID <?echo$cID;?> CAMSEC <?echo$cams;?>  -->
		
		
		<div class="camitem">
    <div class="camitem-content">
        <div class="camitem-number">
            <?echo$KeyPlusOne;?>
        </div>
    <div class="camitem-listbody">
        <div class="camitem-title">
               <h2><?echo$CamNameDisplay;?></h2> (<? echo$TotalFilesInDir;?> files)
        </div>
        <div class="camitem-path">
          <?echo$CamPathDisplay;?>
         </div>
         <div class="camitem-actions">
                <table>
					 <tbody>
				<tr>
				<td>				 
                <a href='<? echo $GetImageDatas[0]['picturl'];?>' title="Last Img Date: <? echo $LastPicDate; ?>"><button class="button bluebtn"><i class="fa fa-image" style="font-size:20px"></i></button></a>
				</td>
                <td>				 
				<a href='camreader.php?cam_num=<?echo $KeyPlusOne;?>&sortdate=<?echo $sortByDate;?>'><button><i class="fa fa-eye" style="font-size:20px"></i></button></a>
				</td>
				<td>
				<button  class="button deletebtn" onclick="modalDelOpen();modalDeleteTextSet(<?echo $KeyPlusOne;?>,<? echo $cID;?>);" id='delcam-$KeyPlusOne' name='delalert'><i class="fa fa-trash-o" style="font-size:20px"></i></button>
				</td>
				</tr>
				</tbody>
                </table>
         </div>
    </div>
    </div>
</div>
		
        <? } //ForeachEnd ?>
		
		
	
	<!-- MODAL DELETE CONFIRM -->
	<div id='deleteModal' class='modal'>
  <span onclick="document.getElementById('deleteModal').style.display='none'" class='close' title='Close Modal'>&times;</span>
  <form class='modal-content' action='./camera-action.php?act=del' method='POST' id='miDeletion' name='miDeletion'>
    <div class='container'>
      <h1>Delete a Camera</h1>
      <p id='deletesure'>Are you sure?</p>

      <div class='clearfix'>
	    <button type='submit' class='deletebtn' name='delcam' value='Delete'>Delete</button>
        <button onclick="document.getElementById('deleteModal').style.display='none'" type='button' class='cancelbtn'>Cancel</button>
      </div>
    </div>
  </form>
</div>
<!-- DELETE MODAL JS + -->
<script>
//Modal Open
function modalDelOpen() {
document.getElementById('deleteModal').style.display='block';
}

function modalDeleteTextSet(keyplusone,cidd) {
  var hidimp = "<input type='hidden' id='delcamID-'" + keyplusone + "' name='delcamID' value='" + cidd + "'>"
  document.getElementById('deletesure').innerHTML = 'Are You sure DELETE ' + keyplusone + '. camera? ' + hidimp;
}

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
		

	    <br />

	   Sort camera images by: <a href='?&sortdate=ASC'>[OldFirst]</a> <a href='?&sortdate=DSC'>[NewFirst]</a>
	   <br />
	   <br />
	     Click to <a href='logout.php' class='logout-button'>Logout</a>
	     <br />
	      <hr />

	       </div>
             </div> 
	</html>