<?php
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$Title = $_POST["Title"];
$Artist = $_POST["Artist"];
$DJ = $_POST["DJ"];
$Status = $_POST["Status"];

$sql="UPDATE Requests SET Status='$Status' WHERE DJ='$DJ' AND Artist='$Artist' AND Title='$Title'";
if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
?>