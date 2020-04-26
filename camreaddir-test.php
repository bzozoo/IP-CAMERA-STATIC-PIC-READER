<?php
session_start();
//user session check
if(!empty($_SESSION["userId"])) {
    require_once './view/userboard.php';
	echo "Welcome $displayName! ";
	echo "<a href='camlist.php' class='logout-button'>(CAMLIST)</a>";
	echo "<a href='logout.php' class='logout-button'>(Logout)</a>";
	echo "<br />";
    define("DIRECTORY", "/DATAS/CMS/TEST/"); // JPG upload folder of Camera (Change to your own folder)
	     
		 // Empty dir checking function
	     function is_dir_empty($dir) {
                  if (!is_readable(DIRECTORY)) return NULL; 
                  return (count(scandir(DIRECTORY)) == 2);
        }
	   
	   //Directory exist check
       if (is_dir(DIRECTORY)) {
		   //Directory empty check
           if (is_dir_empty(DIRECTORY)) {
               echo "This directory (".  DIRECTORY . ") is empty! We can display nothing."; 
               } else {
                       require_once('core-teszt.php'); 
               }
 
          } else {
                   echo "This directory (".  DIRECTORY . ") does not exist! Please define a new directory path!";
          }

    } else {
            require_once './view/login-form.php';
}
?>