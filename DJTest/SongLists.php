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
$listname = $_POST['listname'];
if(isset($_POST['pw'])){
	$pw = $_POST['pw'];
	$sql = "SELECT DJ, CustomRequest FROM DJs WHERE DJ='$dj' AND PW='".$pw."'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)==1){
		$loggedin=true;
		$r = mysqli_fetch_assoc($result);
		$customreq = $r["CustomRequest"];
		$sql = "UPDATE DJs SET LastIP = '".$_SERVER['REMOTE_ADDR']."' WHERE DJ='$dj'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
	} else {
		echo "<div class='alert alert-block alert-danger fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>
			<h4>Password incorrect</h4>
			<p>Please check your password and try again.</p>
		  </div>";}
}else {
	$sql = "SELECT DJ, CustomRequest FROM DJs WHERE DJ='$dj' AND LastIP='".$_SERVER['REMOTE_ADDR']."'";
	$result = mysqli_query($con,$sql);
	if(mysqli_num_rows($result)==1){
		$loggedin=true;
		$r = mysqli_fetch_assoc($result);
		$customreq = $r["CustomRequest"];
	}else{
		echo "<div class='alert alert-block alert-info fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>
			<h4>Please enter your password above</h4>
			<p>E-mail info@LayDownTheBoogie.com if you have any issues or need to reset your password.</p>
		  </div>";
	}
}
if($loggedin==true){
	if(isset($_GET['SongList'])){
		$sql="UPDATE SongLists SET Active='False' WHERE DJ = '$dj'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
		$sql="UPDATE SongLists SET Active='True' WHERE DJ = '$dj' AND ListName='".$_GET['SongList']."'";
		if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
	}
	$sql="SELECT ListName, ShowGenre, AvailableList, SongCount, Active FROM SongLists WHERE DJ = '$dj' or DJ = 'LDTB' Order By ListName";
	$songlists = loadArray(mysqli_query($con, $sql),array('ListName', 'ShowGenre', 'AvailableList', 'SongCount', 'Active'));
	
	$sql="SELECT SongTitle, SongArtist, Status, SongID FROM CustomLists inner join SongLists on SongLists.DJ=CustomLists.DJ and ListName=SongList WHERE (CustomLists.DJ = '$dj' or CustomLists.DJ = 'LDTB') and Active='True' Order By SongArtist, SongTitle";
	$songlist = loadArray(mysqli_query($con, $sql),array('SongTitle', 'SongArtist', 'Status', 'SongID'));
}

if ($_FILES[csv][size] > 0) { 

    //echo "get the csv file"."<br>"; 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
	$sql="DELETE FROM CustomLists WHERE DJ='".$dj."' AND SongList='".$listname."'";
	if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
	$sql="DELETE FROM SongLists WHERE DJ='".$dj."' AND ListName='".$listname."'";
	if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
			//echo "1 row inserted";
            $sql=("INSERT INTO CustomLists (DJ, SongList, SongTitle, SongArtist, SongGenre, Status) VALUES 
                ( 
                    '".$dj."',
					'".$listname."',
					'".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
					'True'				
                ) 
            "); 
			//echo $sql;
			if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
        } 
    } while ($data = fgetcsv($handle,1000,',','"')); 
	$sql="INSERT INTO SongLists (ListName, DJ, AvailableList, SongCount, Active) VALUES('".$listname."', '".$dj."', 'False', ".count($data).", 'True')";
	if(!mysqli_query($con,$sql)){printf("Error: %s\n", mysqli_error($con));}
    // 
	header('Location: SongLists.php?SongList='.$listname); die; 
}
if ($_FILES["art"][size] > 0) {
	$s=move_uploaded_file($_FILES["art"][tmp_name], "../img/".$dj.".png");
	if($s==false){
		echo "<div class='alert alert-block alert-info fade in'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>
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
				function toggleCustom(){
					$.ajax({
						url: 'customrequests.php',
						type: "POST",
						data: {
						'DJ' : '<?echo $dj;?>',
						'CustomReq' : $("#custom").html()},
						cache: false,
						dataType: 'html',
						error: function(errorThrown,textStatus){
							alert(errorThrown.responseText);
						},
						success: function(data){
							$("#custom").html(data);}
						});
				}
				function setActive(SongList){
					window.location="SongLists.php?SongList="+SongList;
				}
			</script>
			<style>
				tbody,thead {
					display: block;
					overflow: auto;
				}
				tr:hover {
					cursor: hand;
					background-color: #ddd;
				}
				th{
					background-color: #aaa;
				}
			</style>
	</head>
	<body>
	<div class="navbar navbar-fixed-top">
      <div class="container nav-style">
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
		</div>
	</div>
    <div class="container" style="margin-top:40px;<?php if(!$loggedin){echo 'display: none';}?>" data-toggle="collapse">
		<?php if (!empty($_GET[success])) { echo "<div class='alert alert-block alert-info fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>
        <h4>Your file has been uploaded successfully.</h4></div>"; } //generic success notice ?> 
		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=blue>Upload Custom Artwork</h1>
				<h4>Image will be displayed at laydowntheboogie.com/<?php echo $dj;?> and will be scaled to fit the screen. The following formats are supported: PNG</h4>
				<img class="img-responsive" src="../img/<? echo $dj.".png";?>">
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="artwork" id="artwork">  
					<input type="file" id="art" name="art"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
			<div class="col-xs-12 col-md-12">
				<h1 class=blue>Song Lists</h1>
				<h4>Choose the active song list below. Use our preconfigured lists or upload your own.</h4>
				<div class="table-responsive">
					<table class="table table-condensed" width="100%">
						<tbody><tr>
							<th>List Name</th>
							<th>Song Count</th>
							<th>Active</th>
						</tr>
						<?php 
							for($r=0;$r<count($songlists);$r++){
							echo "<tr onClick=setActive('".$songlists[$r]['ListName']."')";
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
				<h1 class=blue>Upload a Custom Song List</h1>
				<h4>Use the format below to put your custom song list into a CSV file, and then upload it.</h4>
				<a href="../SampleList.csv">SampleList.CSV</a>
				<form action="SongLists.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
					Name of song list: <input id="listname" name="listname" type=text >
					<input type="file" id="csv" name="csv"> 
					<input type="submit" name="Submit" value="Upload"> 
				</form>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-12">
				<h1 class=blue>Active Song List</h1>
				<h4>The song list below will be what is available for your audience to choose from. Click the row to activate/deactivate songs from the list. <br><br>
				<a href="#" onClick="toggleCustom();">Click here</a> to <b id="custom"><?php if($customreq=="no") {echo "enable";}else{echo "disable";}?></b> custom song requests.</h4>
				<div class="table-responsive">
					<table class="table table-condensed">
						<tbody height="400px;">
							<tr>
								<th>Artist</th>
								<th>Title</th>
								<th>Visible</th>
							</tr>						
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
