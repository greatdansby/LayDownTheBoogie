
<html>
	<head>
		<title>Lay Down the Boogie - <?echo $dj;?></title>
		<!-- Bootstrap -->
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="../css/iOS.css" rel="stylesheet">
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
			<script src="../js/gatracking.js"></script>
			<script type="text/javascript">
				function setStatus(Title, Artist,Status){
					$.ajax({
						url: 'update.php',
						type: "POST",
						data: {
						'DJ' : '<?echo $dj;?>',
						'Title' : Title,
						'Artist' : Artist,
						'Status': Status},
						cache: false,
						dataType: 'html',
						error: function(errorThrown,textStatus){
					alert(errorThrown.responseText);
					},
				success: function(){document.getElementById("frm1").submit()}
				});
				}
			</script>
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">DJ Dashboard</a>
		
		<ul class="nav navbar-nav">
			<li><a href="DJDashboard.php">Requested Songs</a></li>
			<li class="active"><a href="#">Song Lists & Settings</a></li>
		</ul>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;" data-toggle="collapse">

		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Upload Custom Artwork</h1>
				<h4>Image will be displayed at http://www.laydowntheboogie.com/<?php echo $dj;?> and will be scaled to fit the screen. The following formats are supported: JPG, PNG<i>(recommended)</i>, GIF, BMP</h4>
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="artwork" id="artwork"> 
					Choose your file: <br> 
					<input type="file" id="art" name="art"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Lay Down the Boogie Song Lists</h1>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Custom Song Lists</h1>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Upload a Custom Song List</h1>
				<h4>Use the format below to put your custom song list into a CSV file, and then upload it.</h4>
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
					Name of song list: <input id=songlist name=songlist type=text>
					Choose your file: <br> 
					<input type="file" id="csv" name="csv"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Active Song List</h1>
				<h4>The song list below will be what is available for your audience to choose from. Use the toggles on the right to activate/deactivate songs from the list. Click here to enable/disable custom song requests.</h4>
			</div>
		</div>
	</div>
	</body>
</html> 
