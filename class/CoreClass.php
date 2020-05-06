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
        echo "<!-- FOREACH html -->
              <div class='kepbox' id='kep-$key' style='float: left; margin: 10 auto; font-size: 15px; text-align: center;'>
		      <img width='300px' style='max-height: 225px;' src='$picturl' onclick='openModal();currentSlide($key+1)' class='hover-shadow cursor'>
		      <br />
		     $key - $basepicturl <p> $datekep </p>
		     </div>
			 <!-- FOREACH html END -->";
       }
    }	
}
?>