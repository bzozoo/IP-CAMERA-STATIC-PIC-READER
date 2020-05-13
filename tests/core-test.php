<html>
<head>
<title>CAM STATIC IMG LISTING</title>
<link rel="stylesheet" type="text/css" href="./css/modal.css">
<meta name="viewport" content="width=device-width, user-scalable=no">
</head>
<body>
<?php
// Check If called directly or not
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
echo "This script is only for call from directory define script! This script not running If you called directly!"; } else {

$newCoreClass = new coreClass();

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
		 
$slicestartcalculated = ($pagenum*$perpage)-$perpage; // Calculate Page start. Other: ($pagenum - 1) * $perpage;
$slicestopcalculated = $negocountglobarry + ($pagenum * $perpage); // Calculate Page stop
      
  $slicestart = $slicestartcalculated; // Always equal
           
   if ($slicestopcalculated < 0) {
       $slicestop = $slicestopcalculated; // Equal IF calculated  <0 
	   } 
	   else {
      $slicestop = NULL; // Not calculated IF not <0
      }

// Head Links and etc...           
echo "<a id='up'></a>
<div style='text-align: center; font-size: 20px;'>$countglobarry files - $perpage perpage <br />";
//pagination1
echo "<a href='?page=$prev&cam_num=$actualCameraNumber&sortdate=$sortByDate'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next&cam_num=$actualCameraNumber&sortdate=$sortByDate'> Next >> </a><br />";
//pagination2
	echo "<select id='pagenat' onchange='location = this.options[this.selectedIndex].value;'>";
for ($pageNumber = 1;$pageNumber <= $totalpage;$pageNumber++):
     if($pageNumber == $page){
    echo "<option selected='selected' value='?page=$pageNumber&cam_num=$actualCameraNumber&sortdate=$sortByDate'>$pageNumber</option>";
	 } else {
	 echo "<option value='?page=$pageNumber&cam_num=$actualCameraNumber&sortdate=$sortByDate'>$pageNumber</option>"; }
endfor;
echo "</select>";

echo "<br /><a href='#down'>&darr;</a><br />
</div><br />
<hr />
<div id='listcontent'>
<div id='listcontentinner' style='display: table; margin: 0 auto;'>
";
			  

//List images from CoreClass
$newCoreClass->foreachval($imagARRAY, $slicestart, $perpage); //Or perpage instead of slicestop

// Page footer - Pagination links etc...            
echo "</div><!-- /listcontentinner --></div><!-- /listcontent --><br />
      <div class='spacer' style='clear: both;'></div>
      <hr />
      <div style='text-align: center; font-size: 20px;'>$countglobarry files <br />
      <a href='?page=$prev&cam_num=$actualCameraNumber&sortdate=$sortByDate#down'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next&cam_num=$actualCameraNumber&sortdate=$sortByDate#down'> Next >> </a> <br />
      <a id='down'></a> <br /><a href='#up'>&uarr;</a><br /></div>";

// Modal Section
echo "<!-- MODAL HTML SECTION -->
      <div id='myModal' class='modal'>
      <span class='close cursor' onclick='closeModal()'>&times;</span>
      <div class='modal-content'>";

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

// Modal slider buttons
echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
      <a class='next' onclick='plusSlides(1)'>&#10095;</a>
      <div class='caption-container'>
         <p id='caption'></p>
      </div>";

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

// Modal divs end
echo "</div><!-- /modalcontent -->
      </div><!-- /mymodal -->
      <!-- MODAL HTML SECTION END -->";

// Include script for modal
echo "<!-- Modal Script -->
      <script src='core-modal.js'></script>";

} // End of Directory exist or not 

// Close HTML tags
echo "</body>
      </html>";
 ?>
