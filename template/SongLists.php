<?php  

//connect to the database 
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  } 

$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));

if(isset($_POST['pw'])){
$pw = $_POST['pw'];
$sql = "SELECT DJ, PW FROM DJs WHERE DJ='$dj' AND PW='".$pw."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)==1){
$sql="SELECT ListName, ShowGenre, AvailableList, SongCount FROM SongLists WHERE DJ = '$dj' Order By ListName";
$songlists = loadArray(mysqli_query($con, $sql),array('ListName', 'ShowGenre', 'AvailableList', 'SongCount'));
} else {
echo "<div class='alert alert-block alert-danger fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4>Password incorrect</h4>
        <p>Please check your password and try again.</p>
      </div>";}
}else {
echo "<div class='alert alert-block alert-info fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4>Please enter your password above</h4>
        <p>E-mail info@LayDownTheBoogie.com if you have any issues or need to reset your password.</p>
      </div>";
}

if ($_FILES['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r"); 
    //$data = fgetcsv($handle,1000,",","'");
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO CustomLists (DJ, SongList, SongTitle, SongArtist, SongGenre, Status) VALUES 
                ( 
                    '".$dj."',
					'".$songlist."',
					'".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
					'Active'				
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    

}

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
			<script src="../bootstrap/js/bootstrap.min.js"></script>
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
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#">DJ Dashboard</a>
		<form class="navbar-form navbar-left" role="search" method=post action=DJDashboard.php id="frm1">
			<div class="form-group">
				<input type="password" name="pw" class="form-control" placeholder="Password" value='<?echo $pw;?>'>
			</div>
			<button type="submit" class="btn btn-default" name="login" id="login">Login</button>
		</form>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Requested Songs</a></li>
			<li><a href="SongLists.php">Song Lists & Settings</a></li>
		</ul>
	  </div>
	</nav>
    <div class="container" style="margin-top:40px;" data-toggle="collapse">
		<?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

		<form action="SongLists.php" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
		  Choose your file: <br> 
		  <input type="file" id="csv"> 
		  <input type="submit" name="Submit" value="Upload"> 
		</form>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
	</body>
</html> 
