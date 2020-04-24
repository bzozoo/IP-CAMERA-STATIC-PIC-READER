<?php

$dir = '/DATAS/CMS/CM1/'; // JPG upload folder of Camera (Change to your own folder)
$globarry = glob($dir.'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);

$countglobarry = count($globarry);
$negocountglobarry = (-1 * abs($countglobarry));
$page = $_GET['page'];
$perpage = 100;
$totalpage = ceil($countglobarry/$perpage);

	 //Check pageGET exist or not
	if (isset($page)) {
         $pagenum = $page;
         } else {
	     $pagenum = 1;
	     }
		
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


// Create a new Array for add pair file date and file url
foreach($globarry as $file){
	$imag =  $file;
	$filedate = filemtime($imag);
	$imgdataarray[] = array('picturl' => $imag, 'pictdate' => $filedate);
}

//Resort imgdataarray by date
foreach ($imgdataarray as $key => $row) {
    $pictdatekey[$key]  = $row['pictdate'];
    $picturlkey[$key] = $row['picturl'];
}

$pictdatekey  = array_column($imgdataarray, 'pictdate');
$picturlkey = array_column($imgdataarray, 'picturl');

array_multisort($pictdatekey, SORT_DESC, $picturlkey, SORT_ASC, $imgdataarray);


// This code need to check Pagenumber is integer or not
if ( preg_match('/^\d+$/', $pagenum) && ($pagenum > 0) && ($pagenum <= $totalpage))
   {
     $slicestartcalculated = ($pagenum*$perpage)-$perpage; // Calculate Page start
     $slicestopcalculated = $negocountglobarry + ($pagenum * $perpage); // Calculate Page stop
      
       	  $slicestart = $slicestartcalculated; // Always equal
           
		   if ($slicestopcalculated < 0) {
               $slicestop = $slicestopcalculated; // Equal IF calculated  <0 
			   } 
			   else {
                    $slicestop = NULL; // Not calculated IF not <0
               }
                  
// Print out page datas In HTML              
echo "<div style='text-align: center; font-size: 20px;'>$countglobarry files  <br />";
echo "<a href='?page=$prev'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next'> Next >> </a> </div><br /><hr />";
//Only for TEST calculated echo "$slicestartcalculated - $slicestopcalculated <br />";
//Only for TEST echo "$slicestart - $slicestop <br /><hr />";				  

foreach(array_slice($imgdataarray, $slicestart, $slicestop) as $key => $value) {
		$timestampkep = $value['pictdate'];
		$datekep = date("Y F d H:i:s", $timestampkep);
	    $picturl = $value['picturl'];
		$basepicturl = basename($picturl);
		 ?>
		 <!-- FOREACH html -->
		 <div class="kepbox" id="kep-<?php echo $key; ?>" style="float: left; margin: 10px; font-size: 16px; text-align: center;">
		 <a href="<?php echo $picturl; ?>" target="_blank">
		 <img width="300px" src="<?php echo $picturl; ?>" />
		 </a><br />
		 <?php echo $key; ?> - <?php echo $basepicturl; ?> - <?php echo $datekep; ?>
		 </div>

			<?php
    } //Foreach end
     
	 } else { // If not an integer
       echo "You must enter an integer as a page! It can't be display bigger pagenumber than total the pages! (We have only <a href='?page=$totalpage'>$totalpage</a> pages)<br /><hr/>";
} // Integer check IF construct end 


// Print out page datas In HTML              
echo "<br /><div class='spacer' style='clear: both;'></div><hr /><div style='text-align: center; font-size: 20px;'>$countglobarry files  <br />";
echo "<a href='?page=$prev'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next'> Next >> </a> </div>";
 ?>
