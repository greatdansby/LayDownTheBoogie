<?php  

//connect to the database 
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  } 
$loggedin=false;
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));
$songlist = $_POST['songlist'];
if(isset($_POST['pw'])){
	$pw = $_POST['pw'];
	$sql = "SELECT DJ FROM DJs WHERE DJ='$dj' AND PW='".$pw."'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)==1){
		$loggedin=true;
		$sql = "UPDATE DJs SET LastIP = '".$_SERVER['REMOTE_ADDR']."' WHERE DJ='$dj'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
	} else {
		echo "<div class='alert alert-block alert-danger fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<h4>Password incorrect</h4>
			<p>Please check your password and try again.</p>
		  </div>";}
}else {
	$sql = "SELECT DJ FROM DJs WHERE DJ='$dj' AND LastIP='".$_SERVER['REMOTE_ADDR']."'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)==1){
		$loggedin=true;
	}else{
		echo "<div class='alert alert-block alert-info fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<h4>Please enter your password above</h4>
			<p>E-mail info@LayDownTheBoogie.com if you have any issues or need to reset your password.</p>
		  </div>";
	}
}
if($loggedin=true){
	if(isset($_GET['SongList'])){
		$sql="UPDATE SongLists SET Active='False' WHERE DJ = '$dj'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
		$sql="UPDATE SongLists SET Active='True' WHERE DJ = '$dj' AND SongList='".$_GET['SongList']."'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
	$sql="SELECT ListName, ShowGenre, AvailableList, SongCount, Active FROM SongLists WHERE DJ = '$dj' or DJ = 'LDTB' Order By ListName";
	$songlists = loadArray(mysqli_query($con, $sql),array('ListName', 'ShowGenre', 'AvailableList', 'SongCount', 'Active'));
	
	$sql="SELECT SongTitle, SongArtist, Status, SongID FROM CustomLists inner join SongLists on SongLists.DJ=CustomLists.DJ and ListName=SongList WHERE (CustomLists.DJ = '$dj' or CustomLists.DJ = 'LDTB') and Active='True' Order By SongArtist, SongTitle";
	$songlist = loadArray(mysqli_query($con, $sql),array('SongTitle', 'SongArtist', 'Status', 'SongID'));
}

if ($_FILES[csv][size] > 0) { 

    //echo "get the csv file"."<br>"; 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
    //$data = fgetcsv($handle,1000,",","'");
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
			//echo "1 row inserted";
            $sql=("INSERT INTO CustomLists (DJ, SongList, SongTitle, SongArtist, SongGenre, Status) VALUES 
                ( 
                    '".$dj."',
					'".$songlist."',
					'".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
					'Active'				
                ) 
            "); 
			//echo $sql;
			if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 
	header('Location: SongLists.php?success=1'); die; 
}
if ($_FILES["art"][size] > 0) {
	$s=move_uploaded_file($_FILES["art"][tmp_name], "../img/".$dj.".png");
	if($s==false){
		echo "<div class='alert alert-block alert-info fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
			<h4>File Upload Failed</h4>
			<p>Please make sure your file type is .PNG. E-mail info@LayDownTheBoogie.com if you continue to have issues.</p>
		  </div>";}}

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
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
			<script src="../js/gatracking.js"></script>
			<script type="text/javascript">
				function setSongStatus(SongID, Status){
					$.ajax({
						url: 'songupdate.php',
						type: "POST",
						data: {
						'DJ' : '<?echo $dj;?>',
						'SongID' : SongID,
						'Status': Status},
						cache: false,
						dataType: 'html',
						error: function(errorThrown,textStatus){
							alert(errorThrown.responseText);
						},
						success: function(data){
							if($(data).hasClass("Danger")){
								$(data).removeClass("Danger");
								$(data).addClass("Success");
								$(data+">td:last-of-type").html("True");
							}else{
								$(data).removeClass("Success");
								$(data).addClass("Danger");
								$(data+">td:last-of-type").html("False");
							}
							}
						});
				}
			</script>
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">DJ Dashboard
		<?php if($loggedin){
		echo ': '.$dj.'</a>';
		} else {
		echo '
		</a><form class="navbar-form navbar-left" role="search" method=post action=SongLists.php id="frm1">
			<div class="form-group">
				<input type="password" name="pw" class="form-control" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-default" name="login" id="login">Login</button>
		</form>';}?>
		<ul class="nav navbar-nav">
			<li><a href="DJDashboard.php">Requested Songs</a></li>
			<li class="active"><a href="#">Song Lists & Settings</a></li>
		</ul>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;" data-toggle="collapse">
		<?php if (!empty($_GET[success])) { echo "<div class='alert alert-block alert-info fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4>Your file has been uploaded successfully.</h4></div>"; } //generic success notice ?> 
		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Upload Custom Artwork</h1>
				<h4>Image will be displayed at laydowntheboogie.com/<?php echo $dj;?> and will be scaled to fit the screen. The following formats are supported: PNG</h4>
				<img class="img-responsive" src="../img/<? echo $dj.".png";?>">
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="artwork" id="artwork">  
					<input type="file" id="art" name="art"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Song Lists</h1>
				<div class="table-responsive">
					<table class="table table-condensed table-hover">
						<thead><tr>
							<th>List Name</th>
							<th>Song Count</th>
							<th>Active</th>
						</tr></thead>
						<tbody>
						<?php 
							for($r=0;$r<count($songlists);$r++){
							echo "<tr onClick=setActive('".$songlists[$r]['ListName']."')'";
							if($songlists[$r]['Active']='True'){
								echo " class='success'";}
							echo "><td>".$songlists[$r]['ListName']."</td>";
							echo "<td>".$songlists[$r]['SongCount']."</td>";
							echo "<td>".$songlists[$r]['Active']."</td></tr>";}?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Upload a Custom Song List</h1>
				<h4>Use the format below to put your custom song list into a CSV file, and then upload it.</h4><br>
				<a href="../SampleList.csv">SampleList.CSV</a>
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
					Name of song list: <input id=songlist name=songlist type=text >
					<input type="file" id="csv" name="csv"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=white>Active Song List</h1>
				<h4>The song list below will be what is available for your audience to choose from. Use the toggles on the right to activate/deactivate songs from the list. <br>
				<a href="#" onClick="toggleCustom();">Click here</a> to enable/disable custom song requests.</h4>
				<div class="table-responsive" height="400px" style="overflow:scroll">
					<table class="table table-condensed table-hover">
						<thead><tr>
							<th>Artist</th>
							<th>Title</th>
							<th>Visible to Users</th>
						</tr></thead>
						<tbody>
						<?php 
							for($r=0;$r<count($songlist);$r++){
							echo "<tr id='Song".$songlist[$r]['SongID']."' onClick='setSongStatus(".$songlist[$r]['SongID'].",this.className)'";
							if($songlist[$r]['Status']=='True'){
								echo " class='Success'";
							} else {
								echo " class='Danger'";
							}
							echo "><td>".$songlist[$r]['SongArtist']."</td>";
							echo "<td>".$songlist[$r]['SongTitle']."</td>";
							echo "<td>".$songlist[$r]['Status']."</td></tr>";}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</body>
</html> 
