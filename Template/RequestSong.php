<?php
$username = $_GET["Username"];
$contact = $_GET["Contact"];
$song = $_GET["Song"];
$artist = $_GET["Artist"];
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  } 
$sql = "SELECT DJ, CustomRequest FROM DJs WHERE DJ='$dj'";
$result = mysqli_query($con,$sql);
$r = mysqli_fetch_assoc($result);
$customreq = $r["CustomRequest"];
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
			<script type="text/javascript">
				$(function(){
					if(<?php echo "'".$customreq."'";?>=="no"){
					$(".input-group").toggleClass("input-group");
					$(".btn-default").addClass("hidden");}
				});
			</script>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">Enter Note to Dj</a>
		<a type="button" class="btn btn-default navbar-btn pull-right" href="Dashboard.php?Username=<?echo $username;?>&Contact=<?echo $contact;?>">Back</a>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;">
		<form action="SendRequest.php" method=get>
			<input type="hidden" class="form-control" name="DJ" id="DJ" value="<?echo $dj;?>">
		<div class="row">
			<div class="col-xs-12">
				<p class="text-muted"><b>Name</b></p>
				<div class="input-group btn-margin">
					<input type="text" class="form-control" name="Username" id=Username readonly value="<?echo $username;?>">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" onClick="$('#Username').removeAttr('readonly');">Edit</button>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<p class="text-muted"><b>Contact Info</b></p>
				<div class="input-group btn-margin">
					<input type="text" class="form-control" name="Contact" id=Contact readonly value="<?echo $contact;?>">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" onClick="$('#Contact').removeAttr('readonly');">Edit</button>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<p class="text-muted"><b>Song</b></p>
				<div class="input-group btn-margin">
					<input type="text" class="form-control" name="Song" id=Song readonly value="<?echo $song;?>">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" onClick="$('#Song').removeAttr('readonly');">Edit</button>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<p class="text-muted"><b>Artist</b></p>
				<div class="input-group btn-margin">
					<input type="text" class="form-control" name="Artist" id=Artist readonly value="<?echo $artist;?>">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" onClick="$('#Artist').removeAttr('readonly');">Edit</button>
					</span>
				</div>
			</div>
		</div>
		<div class=row>
			<div class="col-xs-12">
				<textarea class="form-control" rows="3" placeholder="Notes to DJ" name="Notes"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<button type=submit class="btn btn-block btn-lg btn-boogie btn-margin" id="submitbtn">Submit Request</button>
			</div>
		</div>
		</form>
	</div>
	</body>
</html>
			
			
	