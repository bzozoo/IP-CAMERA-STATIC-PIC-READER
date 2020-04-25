<?php
define("DIRECTORY", "/YOUR/CAMERA/STATIC/JPG-FILE/DIRECTORY"); // JPG upload folder of Camera (Change to your own folder)
if (is_dir(DIRECTORY)) {
	
 if (is_dir_empty(DIRECTORY)) {
  echo "This directory is empty! We can display nothing."; 
} else {
    require_once('core.php'); 
}
	
 
}else {
  echo "This directory does not exist! Please define a new directory path!";
}

function is_dir_empty($dir) {
  if (!is_readable(DIRECTORY)) return NULL; 
  return (count(scandir(DIRECTORY)) == 2);
}
?>
