<?php
class coreClass
{
    public function globArray($defineddir) {
		$globarry = glob("{". $defineddir . "/*/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*/*.{jpg,JPG,jpeg,JPEG,png,PNG},". $defineddir . "/*.{jpg,JPG,jpeg,JPEG,png,PNG}}", GLOB_BRACE);
		return $globarry;
	}
	
	public function imagedataArray($array) {
	   foreach($array as $key2 => $imageval){
	   $filedate = filemtime($imageval);
	   $imgdatAarrays[] = array('picturl' => $imageval, 'pictdate' => $filedate);
	   }
	   
	   $sortByDate = $_GET['sortdate'];
	   
	   if ($sortByDate == 'ASC') {
       array_multisort(array_column($imgdatAarrays, 'pictdate'), SORT_ASC, array_column($imgdatAarrays, 'picturl'), SORT_ASC, $imgdatAarrays);		   
	   }else {
       array_multisort(array_column($imgdatAarrays, 'pictdate'), SORT_DESC, array_column($imgdatAarrays, 'picturl'), SORT_ASC, $imgdatAarrays);
	   }
	   return $imgdatAarrays;
       }
	
    public function foreachval($sendedarray, $statrtslice, $stopslice) {
	   foreach(array_slice($sendedarray, $statrtslice, $stopslice) as $key => $value) {
		$picturl = $value['picturl'];
		$datekep = date("Y F d H:i:s", $value['pictdate']);
		$basepicturl = basename($picturl);
		$keyplusone = ($key+1);
        echo "<!-- FOREACH html -->
              <div class='kepbox' id='kep-$key' style='float: left; margin: 10 auto; font-size: 15px;'>
		      <div class='kepcontent' style='width: 350px; height: 250px;'>
			  <img width='100%' style='max-height: 250px;' src='$picturl' onclick='openModal();currentSlide($key+1)' class='hover-shadow cursor'>
		      </div>
		     <div class='kepdatacontent' style='width: 350px; display: flex;'>
			 <div class='keynumber' style='display: inline-block; width: 62px; text-align: center; padding-top: 8px; font-size: 20px; font-family: fantasy;'>$keyplusone</div>
			 <div class='kepdata' style='display: inline-block; width: 100%;'> <b>$basepicturl</b> <br /> $datekep </div>
			 </div> 
		     </div>
			 <!-- FOREACH html END -->";
       }
    }	
}
?>