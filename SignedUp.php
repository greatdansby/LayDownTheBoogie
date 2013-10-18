<?php
$Name = $_GET["Name"];
?>
<html>
	<head>
		<title>Lay Down the Boogie</title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="/css/iOS.css" rel="stylesheet">
			<script src="/js/jquery.js"></script> 
			<script src="/bootstrap/js/bootstrap.min.js"></script>
			<script src="/js/gatracking.js"></script>
			<link rel="icon" href="favicon.ico" type="image/x-icon"> 
			<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
	</head>
	<body>
    <div class="container" style="margin-top:10px;">
		<div class="row">
			<div class="col-xs-12">
				<img src="/img/logo.png" class="img-responsive" alt="Responsive logo">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-9">
				<h2>Welcome to Lay Down the Boogie!</h2>
			</div>
		</div>
		<div class="row">
		  <div class="col-sm-6 col-md-6">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?echo urlencode("http:/.com/$Name");?>" alt="..."></a>
			  <div class="caption">
				<h3>Advertise</h3>
				<p>Use the custom QR code above to advertise your site and direct customers to request songs. Or give them your URL: <h4><a href="<?echo "http://laydowntheboogie.com/$Name";?>"><?echo "http://LayDownTheBoogie.com/$Name";?></a></h4></p>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-md-6">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180"  src="/img/list.png" alt="..."></a>
			  <div class="caption">
				<h3>DJ Dashboard</h3>
				<p>Manage your requests and change your settings via the DJ dashboard. Use your password to gain access.<h4><a href="<?echo "http://laydowntheboogie.com/$Name/DJDashboard.php";?>"><?echo "http://LayDownTheBoogie.com/$Name/DJDashboard.php";?></a></p>
			  </div>
			</div>
		  </div>
		</div>			
	</div>
  
	</body>
</html>