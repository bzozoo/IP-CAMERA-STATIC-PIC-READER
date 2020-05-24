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
<link href='./view/css/popups.css' rel='stylesheet' type='text/css' />
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
				<a href='camreader.php?cam_num=<?echo $KeyPlusOne;?>&sortdate=<?echo $sortByDate;?>'>
				<button class="buttonact greenbtn"><i class="fa fa-eye" style="font-size:20px"></i></button></a>
				</td>
				<td>				 
                <a href='<? echo $GetImageDatas[0]['picturl'];?>' title="Last Img Date: <? echo $LastPicDate; ?>">
				<button class="buttonact bluebtn"><i class="fa fa-image" style="font-size:20px"></i></button></a>
				</td>
				<td>
				<button  class="buttonact yellowbtn editbuttons" id='edtcam-<?echo$KeyPlusOne;?>' data-camNum="<?echo$KeyPlusOne;?>" data-camId="<?echo$cID;?>" data-camName="<?echo$CamNameDisplay;?>" data-camPath="<?echo$CamPathDisplay;?>" name='edit'>
				<i class="fa fa-pencil-square-o" style="font-size:20px"></i>
				</button>
				</td>
				<td>
				<button  class="buttonact deletebtn" onclick="modalDelOpen();modalDeleteTextSet(<?echo $KeyPlusOne;?>,<? echo $cID;?>);" id='delcam-$KeyPlusOne' name='delalert'><i class="fa fa-trash-o" style="font-size:20px"></i></button>
				</td>
				</tr>
				</tbody>
                </table>
         </div>
    </div>
    </div>
</div>
		
        <? } //ForeachEnd ?>

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
    </div><!-- /member-dasboard -->
</div><!-- /dasboard -->

<!-- MODAL POPUPS -->

<!-- MODAL DELETE CONFIRM -->
<div id='deleteModal' class='modal'>
  <span onclick="document.getElementById('deleteModal').style.display='none'" class='close' title='Close Modal'>&times;</span>
  <form class='modal-content' action='./camera-action.php?act=del' method='POST' id='miDeletion' name='miDeletion'>
    <div class='container'>
      <h1>Delete a Camera</h1>
      <p id='deletesure'>Are you sure?</p>

      <div class='clearfix'>
	    <button type='submit' class='buttonact deletebtn' name='delcam' value='Delete'>Delete</button>
        <button onclick="document.getElementById('deleteModal').style.display='none'" type='button' class='buttonact cancelbtn'>Cancel</button>
      </div>
    </div>
  </form>
</div>


<!-- MODAL EDIT POPOP -->
<div class="editmodal modhidden o-editpopup c-cam-update" id="editcamera_modal">

    <div class="modal-content">
      <div class="modal-header">
        <button class="close o-editpopup__close-btn">
        X
		</button>
          <h4 class="modal-title"><span class="camnumprint">EDIT CAMERA X</span></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" class="c-cam-update__id" name="camID"/>
        <p>Camera Name</p>
        <input type="text" class="c-cam-update__name wdt95" name="camName"/>

        <p>Camera Path</p>
        <input type="text" class="c-cam-update__path wdt95" name="camPath"/>
      </div>
      <div class="modal-footer">

        <button class="btn btn-default o-editpopup__close-btn" >Close</button>
        <button class="btn o-editpopup__close-btn">UPDATE</button>
      </div>
    </div>
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
</script>

<!-- EDIT CAMERA MODAL JS + -->
<script>
const camupdatepopup = document.querySelector('.o-editpopup.c-cam-update');
const camNumPrint = camupdatepopup.querySelector('.camnumprint');
const camIdInput = camupdatepopup.querySelector('.c-cam-update__id');
const camNameInput = camupdatepopup.querySelector('.c-cam-update__name');
const camPathInput = camupdatepopup.querySelector('.c-cam-update__path');

//PopupCloser
camupdatepopup.addEventListener('click', e => {
  if (e.target.classList.contains('o-editpopup__close-btn')) {
    camupdatepopup.classList.add('modhidden');
  }
})

const editbuttons = document.querySelectorAll('.editbuttons');
const onEditButtonClick = e => {
  const editbutton = e.currentTarget;
  const camnum = editbutton.dataset.camnum;
  const id = editbutton.dataset.camid;
  const name = editbutton.dataset.camname;
  const path = editbutton.dataset.campath;
  console.log(name);
  camNumPrint.innerHTML = "EDIT CAMERA: " + camnum;
  camIdInput.value = id;
  camNameInput.value = name;
  camPathInput.value = path;
  camupdatepopup.classList.remove('modhidden');
}

for (const editbutton of editbuttons) {
  editbutton.addEventListener('click', onEditButtonClick);
}

</script>

<!-- Script FOR Window.Onclick event -->
<script>
// Get the editcamera_modal
var editmodal = document.getElementById('editcamera_modal');

// Get the modal
var deletemodal = document.getElementById('deleteModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == camupdatepopup) {
	camupdatepopup.classList.add('modhidden');
    }
  if (event.target == deletemodal) {
    document.getElementById('deleteModal').style.display='none';
  }
}
</script>

<!-- KeyboardEvets -->
<script>
//KeyboardEvets
document.onkeydown = function(ez){
    ez = ez || window.event;
    var key = ez.which || ez.keyCode;
            if(key===84){
            console.log('TEST');
    }
           if(key===27){
          document.getElementById('deleteModal').style.display='none';
          camupdatepopup.classList.add('modhidden');
    }
}
</script>

</html>