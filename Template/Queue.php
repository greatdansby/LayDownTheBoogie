<?php
$con = mysqli_connect('127.0.0.1', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

//mysqli_select_db("tinysheets", $con);
$username = $_GET["Username"];
$contact = $_GET["Contact"];
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));

$sql="SELECT Title, Artist, COUNT(ID) as RequestCount FROM Requests WHERE DJ = '$dj' AND Status='Active' Group By Title, Artist Order By RequestCount Desc";
$songs = loadArray(mysqli_query($con, $sql),array('Artist','Title','RequestCount'));



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
		<a class="navbar-brand" href="#">Request Queue</a>
		<a type="button" class="btn btn-default navbar-btn pull-right" href="Dashboard.php?Username=<?echo $username;?>&Contact=<?echo $contact;?>">Back</a>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;">

	<?
	if(isset($_GET["Req"])){
	echo "<div class=row>";
	echo "<div class='col-xs-12'>";
	echo "<h3>Thanks for the Request, $Username</h3>";
	echo "</div>";
	echo "</div>";}?>
		<div class="row">
			<div class="col-xs-12">
				<h4>Request Queue:</h4>
				<ul class="list-group">	
<?	
foreach($songs as $song) {
?>
					<li class="list-group-item">
						<span class="badge"><?echo $song['RequestCount'];?></span>
						<?echo $song['Title'];?><br><small><?echo $song['Artist'];?></small>
					</li>
<?
}?>
				</ul>
			</div>
		</div>
	</div>
	</body>
</html>
			
			
	