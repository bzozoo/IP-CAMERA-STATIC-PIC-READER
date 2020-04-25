<html>
<head>
<title>CAM STATIC IMG LISTING</title>
<link rel="stylesheet" type="text/css" href="modal.css">
</head>
<body>
<?php
// Check If called directly or not
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
echo "This script is only for call from directory define script! This script not running If you called directly!"; } else {  
$globarry = glob(DIRECTORY .'*.{jpg,JPG,jpeg,JPEG,png,PNG}',GLOB_BRACE);

$countglobarry = count($globarry);
$negocountglobarry = (-1 * abs($countglobarry));
$page = $_GET['page'];
$perpage = 100;
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
echo "<a href='?page=$prev'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next'> Next >> </a> 
<br />";
//pagination
    for ($pageNumber = 1;$pageNumber <= $totalpage;$pageNumber++):
    echo "<a href='?page=$pageNumber'> &nbsp; $pageNumber &nbsp; </a>";
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
		$timestampkep = $value['pictdate'];
		$datekep = date("Y F d H:i:s", $timestampkep);
	    $picturl = $value['picturl'];
		$basepicturl = basename($picturl);
		 ?>
		 <!-- FOREACH html -->
		
		 <div class="kepbox" id="kep-<?php echo $key; ?>" style="float: left; margin: 10 auto; font-size: 15px; text-align: center;">
		 <img width="300px" style="max-height: 225px;" src="<?php echo $picturl; ?>" onclick="openModal();currentSlide(<?php echo ($key+1); ?>)" class="hover-shadow cursor">
		 <br />
		 <?php echo $key; ?> - <?php echo $basepicturl; ?> - <?php echo $datekep; ?>
		 </div>

			<?php
    } //Foreach end

// Print out page datas in pagefooter              
echo "</div><!-- /listcontentinner --></div><!-- /listcontent --><br /><div class='spacer' style='clear: both;'></div><hr /><div style='text-align: center; font-size: 20px;'>$countglobarry files  <br />";
echo "<a href='?page=$prev'><< Prev </a> $pagenum / $totalpage . page(s) <a href='?page=$next'> Next >> </a> <br /> 
<a id='down'></a> <br /><a href='#up'>&uarr;</a><br /></div>";
?>

<!-- MODAL HTML SECTION -->

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">	

	<?php
	//Modal Slider foreach
foreach(array_slice($imgdataarray, $slicestart, $slicestop) as $key3 => $value3) {
		$timestampkep3 = $value3['pictdate'];
		$datekep3 = date("Y F d H:i:s", $timestampkep3);
	    $picturl3 = $value3['picturl'];
		$basepicturl3 = basename($picturl3);
		 ?>
    <!-- MODAL Slider  FOREACH -->
	
	    <div class="mySlides">
      <div class="numbertext"><?php echo $key3; ?> / <?php echo $perpage; ?></div>
      <img src="<?php echo $picturl3; ?>" style="width:100%; max-height: 770px;">
    </div>
	
	<?php } //Modal Slider Foreach end ?>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>
	
	<?php
	//Modal thumb foreach
foreach(array_slice($imgdataarray, $slicestart, $slicestop) as $key2 => $value2) {
		$timestampkep2 = $value2['pictdate'];
		$datekep2 = date("Y F d H:i:s", $timestampkep2);
	    $picturl2 = $value2['picturl'];
		$basepicturl2 = basename($picturl2);
		 ?>
    <!-- MODAL THUMB PIC FOREACH -->
    <div class="column">
      <img class="demo cursor" src="<?php echo $picturl2; ?>" style="width:100%" onclick="currentSlide(<?php echo ($key2+1); ?>)" alt="<?php echo "ID-$key2 - $basepicturl2 - $datekep2"; ?>" title="<?php echo "ID-$key2 - $basepicturl2 - $datekep2"; ?>">
    </div>
	
	<?php } //Modal Thumb Foreach end ?>

  </div><!-- /modalcontent -->
</div><!-- /mymodal -->
<!-- MODAL HTML SECTION END -->

 <!-- Modal Script -->
<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

document.onkeydown = function(e){
    e = e || window.event;
    var key = e.which || e.keyCode;
    if(key===84){
          alert('TEST');
    }
	        if(key===37){
          plusSlides(-1);
    }
		    if(key===39){
          plusSlides(1);
    }
		    if(key===38){
          plusSlides(-1);
    }
		    if(key===40){
          plusSlides(1);
    }
}
</script>
<?php
} // End of Directore exist or not 
?>
 </body>
 </html>
