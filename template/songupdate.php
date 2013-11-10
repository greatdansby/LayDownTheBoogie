<?php
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$SongID = $_POST["SongID"];
$DJ = $_POST["DJ"];
$Status = $_POST["Status"];
if($Status=="Danger"){
$Status="True";
}else{
$Status="False";}

$sql="UPDATE CustomLists SET Status='$Status' WHERE SongID='$SongID'";
if(!mysqli_query($con,$sql)){
	printf("Error: %s\n", mysqli_error($con));
}else{
echo "#Song".SongID;}
?>