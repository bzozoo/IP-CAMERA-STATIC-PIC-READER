<?php
class coreClass
{
    public function globArray($defineddir) {
		$globarry = glob("{". $defineddir . "/*/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*.{jpg,JPG,jpeg,JPEG,png,PNG}}", GLOB_BRACE);
		return $globarry;
	}
	
    public function foreachval($array, $statrtslice, $stopslice) {
	   foreach($array as $key => $image){
	   $filedate = filemtime($image);
	   $imgdataarray[] = array('picturl' => $image, 'pictdate' => $filedate);
	   }
       array_multisort(array_column($imgdataarray, 'pictdate'), SORT_DESC, array_column($imgdataarray, 'picturl'), SORT_ASC, $imgdataarray);
	   
	   foreach(array_slice($imgdataarray, $statrtslice, $stopslice) as $key => $value) {
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
       }
    }
	
	
}



define("DIRECTORY", "/DATAS/CMS/");
$newCoreClass = new coreClass();
$ArrayedGlob = $newCoreClass->globArray(DIRECTORY);
$countglobarry = count($ArrayedGlob);
$negocountglobarry = (-1 * abs($countglobarry));
$page = $_GET['page'];
$perpage = 10;
$totalpage = (int)ceil(count($ArrayedGlob) / $perpage);
$pagenum = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pagenum = max(1, min($totalpage, $pagenum));

$slicestartcalculated = ($pagenum*$perpage)-$perpage; // Calculate Page start. Other: ($pagenum - 1) * $perpage;
$slicestopcalculated = $negocountglobarry + ($pagenum * $perpage); // Calculate Page stop
      
  $slicestart = $slicestartcalculated; // Always equal
           
   if ($slicestopcalculated < 0) {
       $slicestop = $slicestopcalculated; // Equal IF calculated  <0 
	   } 
	   else {
      $slicestop = NULL; // Not calculated IF not <0
      }

echo "AllFIles: $countglobarry , MinusAllFiles: $negocountglobarry , Totalpage: $totalpage , SliceStart: $slicestart , SliceStop: $slicestop<br />";
$newCoreClass->foreachval($ArrayedGlob, $slicestart, $slicestop); //Or perpage instead of slicestop 

?>