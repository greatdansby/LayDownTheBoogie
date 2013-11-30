<?php
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$CustomReq = $_POST["CustomReq"];
$DJ = $_POST["DJ"];
if($CustomReq=="disable"){
$Status="no";
}else{
$Status="yes";}

$sql="UPDATE DJs SET CustomRequest='$Status' WHERE DJ='$DJ'";
if(!mysqli_query($con,$sql)){
	printf("Error: %s\n", mysqli_error($con));
}else{
if($CustomReq=="disable"){
	echo "enable";
}else{
	echo "disable";}}
?>