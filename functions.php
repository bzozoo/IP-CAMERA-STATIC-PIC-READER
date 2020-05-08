<?php
function predumparray($dupedarr) {
 echo "<pre>";
 print_r($dupedarr);
 echo "</pre>"; 
}

function simpledumparray($dupedarr) {
 print_r($dupedarr);    
}

// Empty dir checking function
function dirisempty($dir) {
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      closedir($handle);
      return FALSE;
    }
  }
  closedir($handle);
  return TRUE;
}

?>