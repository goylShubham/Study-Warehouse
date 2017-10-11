<?php
include('sessions.php');
if (isset($_SESSION['semester'])) {
	$semester = $_SESSION['semester'];
} else {
	header('location:teacherhome.php');
}

if (isset($_POST['watch'])) {
	$vid = $_POST['vid'];
	$subject_code = $_POST['subject_code'];
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="w3.css">
  <link rel="stylesheet" type="text/css" href="assets\font-awesome-4.7.0\css\font-awesome.min.css">
</head>
<body>
  <form action="view.php" method="post" class="w3-bar w3-white w3-row">
  <a href="teacherhome.php" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-red w3-hover-white'><i class="fa fa-home"></i></a>
  <button name="videos" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-green w3-hover-white'><i class="fa fa-youtube-play"></i></button>
  <button name="books" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-yellow w3-hover-white'><i class="fa fa-book"></i></button>
  <button name="notes" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-blue w3-hover-white'><i class="fa fa-files-o"></i></button>
  <a href="upload.php" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-green w3-hover-white' title="upload"><i class="fa fa-upload"></i></a>
  <a href="logout.php" class="w3-right w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-red w3-hover-white" title="Sign out"><i class="fa fa-power-off"></i></a>
</form>
<div class="w3-row">
	<div class="w3-col l8 w3-padding-large">
		<?php
if (isset($vid)) {
	$query = "SELECT video_id,video_subject_code,video_topic,video_description,video_url FROM video WHERE video_id =" . $vid;
	$result = mysqli_query($db,$query);
	while ($row = mysqli_fetch_assoc($result)) {
		$url = $row['video_url'];
	}
		 echo "<video width='100%' controls><source src='$url'></video>";
} else {
	echo "error";
}
?>
	</div>
	<div class="w3-col l4 w3-padding">
		<?php
			if (isset($subject_code)) {
				$query = "SELECT video_id,video_subject_code,video_topic,video_description,video_url FROM video WHERE video_subject_code = '$subject_code' ORDER BY video_id";
				$result = mysqli_query($db,$query);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
					echo "<form action='".$_SERVER['REQUEST_URI']."' method='post' class='w3-card'>
						<input type='hidden' name='vid' value='".$row['video_id']."'>
						<input type='hidden' name='subject_code' value='".$row['video_subject_code']."'>
						<h6>".$row['video_topic']."</h6>
						<p class='w3-small'>".$row['video_description']."</p>
						<button name='watch' class='w3-button w3-text-green w3-hover-white w3-large'><i class='fa fa-eye'></i></button></form>";
					}
				} else {
					echo "No more videos";
				}
				
			}
		?>
	</div>
</div> 

</body>
</html>