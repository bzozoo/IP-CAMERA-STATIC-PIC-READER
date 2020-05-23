<html>
<head>
<title>CAM STATIC IMG LISTING</title>
<link rel="stylesheet" type="text/css" href="./view/css/modal.css">
<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
<?php
// Check If called directly or not
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
echo "This script is only for to include!"; exit;}
?>


<!-- Head Links and etc... -->
<a id='up'></a>
<div style='text-align: center; font-size: 20px;'><?echo$countglobarry;?> files - <?echo$perpage;?> perpage <br />
<!-- pagination1 -->
<a href="?page=<?echo$prev;?>&cam_num=<?echo$actualCameraNumber;?>&sortdate=<?echo$sortByDate;?>">
<button><< Prev </button>
</a> 

<?echo$pagenum . " / " . $totalpage;?> . page(s) 

<a href='?page=<?echo$next;?>&cam_num=<?echo$actualCameraNumber;?>&sortdate=<?echo$sortByDate;?>'>
<button> Next >> </button></a><br />
<!-- pagination2 -->
	<select id='pagenat' onchange='location = this.options[this.selectedIndex].value;'>
<?php
for ($pageNumber = 1;$pageNumber <= $totalpage;$pageNumber++):
     if($pageNumber == $page){
    echo "<option selected='selected' value='?page=$pageNumber&cam_num=$actualCameraNumber&sortdate=$sortByDate'>$pageNumber</option>";
	 } else {
	 echo "<option value='?page=$pageNumber&cam_num=$actualCameraNumber&sortdate=$sortByDate'>$pageNumber</option>"; }
endfor;
?>
</select>

<br /><a href='#down'>&darr;</a><br />
</div><br />
<hr />
<div id='listcontent'>
<div id='listcontentinner' style='display: table; margin: 0 auto;'>

			  
<?php
//List images from CoreClass
$newCoreClass->foreachval($imagARRAY, $slicestart, $perpage); //Or perpage instead of slicestop
?>

      <!-- Page footer - Pagination links etc... -->            
      </div><!-- /listcontentinner --></div><!-- /listcontent --><br />
      <div class='spacer' style='clear: both;'></div>
      <hr />
      <div style='text-align: center; font-size: 20px;'>$countglobarry files <br />
      <a href='?page=$prev&cam_num=$actualCameraNumber&sortdate=$sortByDate#down'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next&cam_num=$actualCameraNumber&sortdate=$sortByDate#down'> Next >> </a> <br />
      <a id='down'></a> <br /><a href='#up'>&uarr;</a><br /></div>

      <!-- MODAL  SECTION -->
      <div id='myModal' class='modal'>
      <span class='close cursor' onclick='closeModal()'>&times;</span>
      <div class='modal-content'>

<?php
//Modal Slider foreach
foreach(array_slice($imagARRAY, $slicestart, $slicestop) as $key3 => $value3) {
		$timestampkep3 = $value3['pictdate'];
		$datekep3 = date("Y F d H:i:s", $timestampkep3);
	    $picturl3 = $value3['picturl'];
		$basepicturl3 = basename($picturl3);
		$key3plusone = ($key3+1);
		 echo "<!-- MODAL Slider FOREACH HTML -->
	           <div class='mySlides'>
               <div class='numbertext'> $key3plusone / $perpage </div>
               <img src='$picturl3' style='width:100%; max-height: 500px;' />
			   <a href='javascript:void(0)' onclick='startCallback();'>START</a> - <a href='javascript:void(0)' onclick='stopCallback();'>STOP</a>
               </div>
	           <!-- MODAL Slider FOREACH HTML END -->";
} //Modal Slider Foreach end
?>

       <!-- Modal slider buttons -->
      <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
      <a class='next' onclick='plusSlides(1)'>&#10095;</a>
      <div class='caption-container'>
         <p id='caption'></p>
      </div>

<?php
//Modal thumb foreach
foreach(array_slice($imagARRAY, $slicestart, $slicestop) as $key2 => $value2) {
		$timestampkep2 = $value2['pictdate'];
		$datekep2 = date("Y F d H:i:s", $timestampkep2);
	    $picturl2 = $value2['picturl'];
		$basepicturl2 = basename($picturl2);
		$key2plusone = ($key2+1);
         echo "<!-- MODAL THUMB PIC FOREACH HTML -->
               <div class='column'>
               <img class='demo cursor' src='$picturl2' style='width:100%;' onclick='currentSlide(($key2+1))' alt='ID-$key2plusone - $basepicturl2 - $datekep2' title='ID-$key2plusone - $basepicturl2 - $datekep2'>
               </div>
	           <!-- MODAL THUMB PIC FOREACH HTML END -->";
} //Modal Thumb Foreach end 
?>

<!-- Modal divs end -->
</div><!-- /modalcontent -->
</div><!-- /mymodal -->
<!-- MODAL HTML SECTION END -->

<!-- Include Modal Script -->
<script src='./view/js/core-modal.js'></script>

    </body>
</html>