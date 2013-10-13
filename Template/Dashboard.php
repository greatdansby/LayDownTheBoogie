<?php

$username = $_GET["Username"];
$contact = $_GET["Contact"];
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));
?>
<html>
	<head>
		<title>Lay Down the Boogie - <?echo $dj;?></title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="/laydowntheboogie/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="/laydowntheboogie/css/iOS.css" rel="stylesheet">
			<script src="/laydowntheboogie/js/jquery.js"></script> 
			<script src="/laydowntheboogie/bootstrap/js/bootstrap.min.js"></script>
			<script src="/laydowntheboogie/js/gatracking.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">Request a Song</a>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;">
		<div class="row">
			<div class="col-xs-12">
				<form action="SongsBySearch.php" method=GET>
					<input type=hidden name=Username value="<?echo $Username;?>">
					<input type=hidden name=Contact value="<?echo $Contact;?>">
				<div class="input-group">
					<input type="text" class="form-control" name=Terms>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">Search!</button>
					</span>
				</div>
			</div>
		</div>
		<div class=row></div>
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-block btn-lg btn-boogie btn-margin" id="submitbtn" href="SongsByName.php?Username=<? echo $Username?>&Contact=<?echo $contact;?>">Songs by Title<i class="icon-chevron-right pull-right"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-block btn-lg btn-boogie btn-margin" id="submitbtn" href="SongsByArtist.php?Username=<? echo $Username?>&Contact=<?echo $contact;?>">Songs by Artist<i class="icon-chevron-right pull-right"></i></a>
			</div>
		</div>
<?/*
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-block btn-lg btn-boogie btn-margin" id="submitbtn" href="SongsByGenre.php?Username=<? echo $Username?>&Contact=<?echo $contact;?>">Songs by Genre<i class="icon-chevron-right pull-right"></i></a>
			</div>
		</div>*/?>
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-block btn-lg btn-warning btn-margin" id="submitbtn" href="Queue.php?Username=<? echo $Username?>&Contact=<?echo $contact;?>">See Current Requests<i class="icon-chevron-right pull-right"></i></a>
			</div>
		</div>
	</div>
	</body>
</html>
			
			
	