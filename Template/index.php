<?php
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));
?>
<html>
	<head>
		<title>Lay Down the Boogie - <?echo $dj?></title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="css/iOS.css" rel="stylesheet">
			<script src="js/jquery.js"></script> 
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<script src="js/gatracking.js"></script>
	</head>
	<body>
    <div class="container" style="margin-top:10px;">
		<div class="row">
			<div class="col-xs-12">
				<img src="img/logo.png" class="img-responsive" alt="Responsive logo">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form method="GET" action="Dashboard.php">
					<input id='Username' name="Username" class="form-control" type="text" placeholder="Name">
					<input id='Contact' name="Contact" class="form-control" type="text" placeholder="E-mail or Phone (optional)">
				<button class="btn btn-block btn-lg btn-primary id="submitbtn" type=submit>Request a Song</button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<img src="img/<?echo $dj;?>.png" class="img-responsive" alt="Custom logo">
			</div>
		</div>
	</div>
	</body>
</html>
			
			
	