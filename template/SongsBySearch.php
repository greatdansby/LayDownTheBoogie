<?php
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

//mysqli_select_db("tinysheets", $con);
$username = $_GET["Username"];
$contact = $_GET["Contact"];
$searchTerms = $_GET["Terms"];
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));

$sql="SELECT * FROM SongList WHERE DJ = '$dj' and (SongTitle Like '%$searchTerms%' OR SongArtist Like '%$searchTerms%' OR SongGenre Like '%$searchTerms%') Order By SongTitle";
$songs = loadArray(mysqli_query($con, $sql),array('SongArtist','SongTitle','SongGenre'));

$sql = "SELECT DJ, CustomRequest FROM DJs WHERE DJ='$dj'";
$result = mysqli_query($con,$sql);
$r = mysqli_fetch_assoc($result);
$customreq = $r["CustomRequest"];

function loadArray($result,$columns){
	$rows = array();
	if(count($columns)>1){
		$i=0;
		while($r = mysqli_fetch_assoc($result)) {
			$rows[$i] = array();
			foreach($columns as $key){
				$rows[$i][$key] = $r[$key];
			}
			$i++;
		}
	} else {
		while($r = mysqli_fetch_assoc($result)) {
			foreach($columns as $key){
				$rows[] = $r[$key];
			}
		}
	}
	return $rows;
}
?>
<html>
	<head>
		<title>Lay Down the Boogie - <?echo $dj;?></title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="../css/iOS.css" rel="stylesheet">
			<script src="../js/jquery.js"></script> 
			<script src="../bootstrap/js/bootstrap.min.js"></script>
			<script src="../js/gatracking.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">Search Results</a>
		<a type="button" class="btn btn-default navbar-btn pull-right" href="Dashboard.php?Username=<?echo $username;?>&Contact=<?echo $contact;?>">Back</a>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;">
<?		
if($customreq=="yes") {echo "<a href='RequestSong.php?Username=".$username."&Contact=".$contact."'>Can\'t find what you\'re looking for? Click here to enter a custom request.</a>";}
foreach($songs as $song) {
?>
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-block btn-lg btn-default" id="submitbtn" href="RequestSong.php?Song=<?echo urlencode($song['SongTitle'])."&Artist=".urlencode($song['SongArtist'])."&Username=".$username."&Contact=".$contact;?>"><?echo $song['SongTitle'];?><br><small><?echo $song['SongArtist'];?></small></a>
			</div>
		</div>
<?
}?>
	</div>
	</body>
</html>
			
			
	