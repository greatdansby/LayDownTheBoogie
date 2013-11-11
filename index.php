<?php

?>
<html>
	<head>
		<title>Lay Down the Boogie</title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="css/iOS.css" rel="stylesheet">
			<script src="js/jquery.js"></script> 
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<script src="js/gatracking.js"></script>
			<link rel="icon" href="favicon.ico" type="image/x-icon"> 
			<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
			<style>
				.splash {
					background-image: url("./img/splash.png");
					background-repeat: no-repeat;
					margin-top: 30px;
				}
			</style>
	<body>
	<div class="navbar navbar-fixed-top">
      <div class="container nav-style">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#signup">Sign-Up</a></li>
            <li><a href="#noapp">No App</a></li>
			<li><a href="#songlists">Song Lists</a></li>
			<li><a href="#branding">Branding</a></li>   
			<li><a href="#features">New Features</a></li>  			
          </ul>
          <form id="DJSignIn" name="DJSignIn" class="navbar-form navbar-right" method=POST>
            <div class="form-group">
              <input id="username" type="text" placeholder="Username" class="form-control" onChange="$('#DJSignIn').attr('action',this.value.toLowerCase()+'/djdashboard.php');">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" id="pw" name="pw">
            </div>
            <button type="submit" class="btn btn-primary">DJ Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container">
		<div class="row splash">
			<div class="col-xs-5 col-md-5">
				<img src="img/logo.png" class="img-responsive" alt="Responsive logo">
				<h3>A song request system allowing guests to request songs using their smartphone. As a DJ, you can manage your request queue, capture guest information and advertise your business.</h3>
			</div>        
		</div>	  
    </div>
    <div class="container">
		<a id="signup"></a>
		<hr class="featurette-divider">
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<form method="POST" action="AddDJ.php">
					<input id='Name' name="Name" class="form-control btn-margin" type="text" placeholder="DJ Name (no spaces)">
					<input id='Email' name="Email" class="form-control btn-margin" type="text" placeholder="E-mail">
					<input id='PW' name="PW" class="form-control btn-margin" type="password" placeholder="Password">
				<button class="btn btn-block btn-lg btn-primary btn-margin" id="submitbtn" type=submit>Create a Trial Account</button>
				<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg btn-margin btn-block">Give Feedback</a>
			</div>
			<div class="col-xs-12 col-md-5">
				<h1 class=blue>Sign Up for the Beta Test</h1>
				<h4>Create a free account today during our beta phase using the form on the left</h4>
			</div>
			<div class="col-xs-12 col-md-4">
				<h1 class=blue>Take it for a Test Drive</h1>
				<h4>Scan the QR code to see the live app on your phone. Or <a href="template/DJDashboard.php">click here</a> to see the DJ Dashboard (password is TESTDRIVE).</h4>
				<a href="http://laydowntheboogie.com/template" class=thumbnail><img data-src="holder.js/171x180" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://laydowntheboogie.com/template" alt="..."></a>
			</div>
		</div>
		<a id="noapp"></a>
		<hr class="featurette-divider">
		<div class="row">
			<div class="col-xs-12 col-md-9">
				
				<h1 class=blue>No App to Download</h1>
				<h4>Lay Down the Boogie is entirely web-based using responsive HTML5. This means it'll adapt to any smartphone, providing a great user experience.</h4>
			</div>
			<div class="col-xs-12 col-md-3">
				<img src="img/noapp.png" alt="...">
			</div>
		</div>
		<a id="songlists"></a>
		<hr class="featurette-divider">
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<img src="img/demo_songs.png" alt="...">
			</div>
			<div class="col-xs-12 col-md-9">				
				<h1 class=blue>Custom Song Lists</h1>
				<h4>Upload a custom list of songs for party-goers to choose from, or use one of our standard lists. Ensure that everyone can find the song that they're looking for.</h4>
			</div>
		</div>
		<a id="branding"></a>
		<hr class="featurette-divider">
		<div class="row">
			<div class="col-xs-12 col-md-9">				
				<h1 class=blue>Custom Branding</h1>
				<h4>Unique URL to advertise. Custom images for the event, or even a link to your personal website.</h4>
			</div>
			<div class="col-xs-12 col-md-3">
				<img src="img/demo_dashboard.png" alt="...">
			</div>
		</div>
		<a id="features"></a>
		<hr class="featurette-divider">
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<img src="img/features.png" alt="...">
			</div>
			<div class="col-xs-12 col-md-9">				
				<h1 class=blue>New Features</h1>
				<h4>We're constantly innovating to come up with new ways to improve your customer's experience. Let's us know what we can do to support your business.</h4>
			</div>
		</div>
	</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">How are we doing?</h4>
        </div>
        <div class="modal-body">
			<iframe src="feedback.php" width='100%' height='200' seamless></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
	</body>
</html>
			
			
	