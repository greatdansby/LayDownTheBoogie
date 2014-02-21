<?php

$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$Name = str_replace(' ', '', $_POST["Name"]);
$Email = $_POST["Email"];
$PW = $_POST["PW"];

$sql="SELECT * FROM DJs WHERE DJ='$Name' OR Email='$Email'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)==1){
	echo "That DJ Name or E-mail is already in use.";
	exit;
}else{
$sql="INSERT INTO DJs(DJ, Email, PW, Status) VALUES('$Name','$Email','$PW', 'Active')";
if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
$sql="INSERT INTO CustomLists(SongTitle, SongArtist, SongGenre, DJ, SongList, Status) SELECT SongTitle, SongArtist, SongGenre, '$Name', 'Top 1000', 'True' FROM SongList WHERE DJ='Template'";
if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
$sql="INSERT INTO SongLists(ListName, DJ, ShowGenre, AvailableList, SongCount, Active) VALUES('Top 1000', '$Name', '', 'True', '1000', 'True')";
if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}

recurse_copy("template",strtolower($Name));
recurse_copy("template",$Name);
header('Location: SignedUp.php?Name='.urlencode($Name));
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
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