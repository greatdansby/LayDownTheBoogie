<?php

$Name = str_replace(' ', '', $_POST["Name"]);
echo $Name." to be replaced with template";
recurse_copy("template",strtolower($Name));
echo "Lowercase directory copied";
recurse_copy("template",$Name);
echo "Uppercase directory copied";

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
?>