<?php

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
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
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
            <li><a href="#about">Sign-Up</a></li>
            <li><a href="#noapp">No App</a></li>
			<li><a href="#noapp">Song Lists</a></li>
			<li><a href="#noapp">Branding</a></li>            
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">DJ Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
	<div class="jumbotron">
      <div class="container">
        <img src="/img/logo.png" class="img-responsive" alt="Responsive logo">
        <p>Lay Down the Boogie is a way for DJs to allow guests to request songs using their smartphone. As a DJ, you can manage your request queue, capture guest information and advertise your business in a new way.</p>
        <p><a class="btn btn-primary btn-lg">Learn more &raquo;</a></p>
      </div>
    </div>
    <div class="container" style="margin-top:10px;">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<form method="POST" action="AddDJ.php">
					<input id='Name' name="Name" class="form-control btn-margin" type="text" placeholder="DJ Name (no spaces)">
					<input id='Email' name="Email" class="form-control btn-margin" type="text" placeholder="E-mail">
					<input id='PW' name="PW" class="form-control btn-margin" type="password" placeholder="Password">
				<button class="btn btn-block btn-lg btn-primary btn-margin" id="submitbtn" type=submit>Create a Trial Account</button>
				<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg btn-margin btn-block">Give Feedback</a>
			</div>
			<div class="col-xs-12 well col-md-9">
				<h2>Sign Up for the Beta Test</h2>
				<h4>Create a free account today during our beta phase using the form on the left</h4>
			</div>
		</div>
		<div class="row">
		  <div class="col-sm-6 col-md-3 btn-margin">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180" src="/img/noapp.png" alt="..."></a>
			  <div class="caption">
				<h4>No App to Download</h4>
				<p>Lay Down the Boogie is entirely web-based using responsive HTML5. This means it'll adapt to any smartphone, providing a great user experience.</p>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-md-3 btn-margin">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180"  src="/img/list.png" alt="..."></a>
			  <div class="caption">
				<h4>Choose from a List</h4>
				<p>Upload a custom list of songs for party-goers to choose from, or use one of our standard lists. Ensure that everyone can find the song that they're looking for.</p>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-md-3 btn-margin">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180" src="/img/brand.png" alt="..."></a>
			  <div class="caption">
				<h4>Unique Branding</h4>
				<p>Unique URL to advertise. Custom images for the event, or even a link to your personal website</p>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-md-3 btn-margin">
			<div class="thumbnail">
			  <a href="#" class=thumbnail><img data-src="holder.js/171x180" src="/img/features.png" alt="..."></a>
			  <div class="caption">
				<h4>New Features</h4>
				<p>We're constantly innovating to come up with new ways to improve your customer's experience. Let's us know what we can do to support your business.</p>
			  </div>
			</div>
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
			
			
	