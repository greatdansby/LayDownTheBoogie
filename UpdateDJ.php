<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$Name = str_replace(' ', '', $_GET["Name"]);
echo $Name." to be replaced with template\n";
recurse_copy("template",strtolower($Name));
echo "Lowercase directory copied\n";
recurse_copy("template",$Name);
echo "Uppercase directory copied\n";

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
ini_set('display_errors', 'Off');
?>