<?php
$con = mysqli_connect('127.0.0.1', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

$username = $_GET["Username"];
$contact = $_GET["Contact"];
$song = $_GET["Song"];
$artist = $_GET["Artist"];
$notes = $_GET["Notes"];
$dj = $_GET["DJ"];

$sql="INSERT INTO Requests (Username, Contact, Title, Artist, Notes, DJ, Status) VALUES('$username','$contact','$song','$artist','$notes','$dj','Active') ";
if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));
} else {
header('Location: Queue.php?Username='.$username.'&Contact='.$contact.'&Req=Y');}
exit;
?>