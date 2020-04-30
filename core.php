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
// Glob files from defined dyrectory
$globarry = glob("{". DIRECTORY . "/*/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". DIRECTORY . "/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". DIRECTORY . "/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". DIRECTORY . "/*.{jpg,JPG,jpeg,JPEG,png,PNG}}", GLOB_BRACE);

$countglobarry = count($globarry);
$negocountglobarry = (-1 * abs($countglobarry));
$page = $_GET['page'];
$perpage = 200;
$totalpage = (int)ceil(count($globarry) / $perpage);

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

// Create a new Array for add pair file date and file url
foreach($globarry as $image){
	$filedate = filemtime($image);
	$imgdataarray[] = array('picturl' => $image, 'pictdate' => $filedate);
}

//Sort imgdataarray by reverse date
//$pictdatekey  = array_column($imgdataarray, 'pictdate');
//$picturlkey = array_column($imgdataarray, 'picturl');
//array_multisort($pictdatekey, SORT_DESC, $picturlkey, SORT_ASC, $imgdataarray);
array_multisort(array_column($imgdataarray, 'pictdate'), SORT_DESC, array_column($imgdataarray, 'picturl'), SORT_ASC, $imgdataarray);

// Print out page datas In HTML              
echo "<a id='up'></a>
<div style='text-align: center; font-size: 20px;'>$countglobarry files  <br />";
echo "<a href='?page=$prev&cam_num=$actualCameraNumber'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next&cam_num=$actualCameraNumber'> Next >> </a> 
<br />";
//pagination
for ($pageNumber = 1;$pageNumber <= $totalpage;$pageNumber++):
    echo "<a href='?page=$pageNumber&cam_num=$actualCameraNumber'> &nbsp; $pageNumber &nbsp; </a>";
endfor;
echo "<br /><a href='#down'>&darr;</a><br />
</div><br />
<hr />
<div id='listcontent'>
<div id='listcontentinner' style='display: table; margin: 0 auto;'>
";
//Only for TEST calculated echo "$slicestartcalculated - $slicestopcalculated <br />";
//Only for TEST echo "$slicestart - $slicestop <br /><hr />";				  

foreach(array_slice($imgdataarray, $slicestart, $perpage) as $key => $value) {
		$picturl = $value['picturl'];
		$datekep = date("Y F d H:i:s", $value['pictdate']);
		$basepicturl = basename($picturl);
        echo "<!-- FOREACH html -->
              <div class='kepbox' id='kep-$key' style='float: left; margin: 10 auto; font-size: 15px; text-align: center;'>
		      <img width='300px' style='max-height: 225px;' src='$picturl' onclick='openModal();currentSlide($key+1)' class='hover-shadow cursor'>
		      <br />
		     $key - $basepicturl - $datekep
		     </div>
			 <!-- FOREACH html END -->";
} //Foreach end

// Print out page datas in pagefooter              
echo "</div><!-- /listcontentinner --></div><!-- /listcontent --><br />
      <div class='spacer' style='clear: both;'></div>
      <hr />
      <div style='text-align: center; font-size: 20px;'>$countglobarry files <br />
      <a href='?page=$prev&cam_num=$actualCameraNumber#down'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next&cam_num=$actualCameraNumber#down'> Next >> </a> <br />
      <a id='down'></a> <br /><a href='#up'>&uarr;</a><br /></div>";

// Modal Section
echo "<!-- MODAL HTML SECTION -->
      <div id='myModal' class='modal'>
      <span class='close cursor' onclick='closeModal()'>&times;</span>
      <div class='modal-content'>";	

//Modal Slider foreach
foreach(array_slice($imgdataarray, $slicestart, $slicestop) as $key3 => $value3) {
		$timestampkep3 = $value3['pictdate'];
		$datekep3 = date("Y F d H:i:s", $timestampkep3);
	    $picturl3 = $value3['picturl'];
		$basepicturl3 = basename($picturl3);
		 echo "<!-- MODAL Slider FOREACH HTML -->
	           <div class='mySlides'>
               <div class='numbertext'> $key3 / $perpage </div>
               <img src='$picturl3' style='width:100%; max-height: 770px;'>
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
foreach(array_slice($imgdataarray, $slicestart, $slicestop) as $key2 => $value2) {
		$timestampkep2 = $value2['pictdate'];
		$datekep2 = date("Y F d H:i:s", $timestampkep2);
	    $picturl2 = $value2['picturl'];
		$basepicturl2 = basename($picturl2);
         echo "<!-- MODAL THUMB PIC FOREACH HTML -->
               <div class='column'>
               <img class='demo cursor' src='$picturl2' style='width:100%;' onclick='currentSlide(($key2+1))' alt='ID-$key2 - $basepicturl2 - $datekep2' title='ID-$key2 - $basepicturl2 - $datekep2'>
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