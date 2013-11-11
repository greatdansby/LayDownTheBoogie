<?php
$con = mysqli_connect('localhost', 'boogie','boogie6', 'boogie_requests');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
$username = $_GET["Username"];
$contact = $_GET["Contact"];
$path = getcwd();
$dj =  trim(substr($path,strrpos($path,"/")-strlen($path)+1));
if(isset($_POST['pw'])){
$pw = $_POST['pw'];
$sql = "SELECT DJ, PW FROM DJs WHERE DJ='$dj' AND PW='".$pw."'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result)==1){

$sql="SELECT Title, Artist, COUNT(ID) as RequestCount FROM Requests WHERE DJ = '$dj' AND Status='Active' Group By Title, Artist Order By RequestCount Desc";
$songs = loadArray(mysqli_query($con, $sql),array('Artist','Title','RequestCount'));
$sql="SELECT Title, Artist, Notes, Username FROM Requests WHERE DJ = '$dj' AND Status='Active'";
$notes = loadArray(mysqli_query($con, $sql),array('Artist','Title','Notes','Username'));
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
			<script src="../js/jquery.js"></script> 
			<script src="../bootstrap/js/bootstrap.min.js"></script>
			<script src="../js/gatracking.js"></script>
			<script type="text/javascript">
				//$(".collapse").collapse();
				$(function(){				
					window.setTimeout(function(){document.getElementById("frm1").submit()},30000);
				});
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
	<div class="navbar navbar-fixed-top">
      <div class="container nav-style">
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
		</div>
	</div>
    <div class="container" style="margin-top:40px;" data-toggle="collapse">
		<div class="page-header">
			<h1>Requested Songs <small>Sorted by number of requests</small></h1>
		</div>
		<div class="panel-group" id="accordion">
  <?	
$index=1;
foreach($songs as $song) {
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?echo $index;?>">
          <? echo $song['Title'].' by '.$song['Artist'];?>
		  <span class="badge"><?echo $song['RequestCount'];?></span>
        </a>
      </h4>
    </div>
    <div id="collapse<?echo $index;?>" class="panel-collapse collapse">
      <div class="panel-body">
		<div class=row>
			<div class=col-xs-7>
				<h4>Notes:</h4>
				<ul class="list-group">
<?
foreach($notes as $note){
if($note['Title']==$song['Title'] && $note['Artist']==$song['Artist']){?>
					<li class="list-group-item"><?echo '"'.$note['Notes'].'" from <em>'.$note['Username'].'</em>';?></li>
<?}}?>
				</ul>
			</div>
			<div class=col-xs-3>
				<div class=row>
					<div class=col-xs-2-offset-1>
						<button class="btn btn-primary btn-large btn-margin btn-block" onClick="setStatus('<? echo $song['Title'];?>','<? echo $song['Artist'];?>','Played');">Mark as Played</button>
					</div>
				</div>
				<div class=row>
					<div class=col-xs-2-offset-1>
						<button class="btn btn-danger btn-large btn-margin btn-block" onClick="setStatus('<? echo $song['Title'];?>','<? echo $song['Artist'];?>','Skipped');">Remove from List</button>
					</div>
				</div>
			</div>				
		</div>
      </div>
    </div>
  </div>
 <?
 $index++;}?>
</div>
	</div>
	</body>
</html>
			
			
	