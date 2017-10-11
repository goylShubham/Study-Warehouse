<!DOCTYPE html>
<html>
<?php

if(isset($_POST['stu_btn']))
	{
		header('location:studentlogin.php');
	}
	elseif (isset($_POST['tchr_btn'])) 
	{
		header('location:teacherlogin.php');
	}
?>
<head>
	<title>index demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="w3.css">
  <link rel="stylesheet" type="text/css" href="assets\font-awesome-4.7.0\css\font-awesome.min.css">
</head>
<body>
<div class="w3-row w3-margin">
	<div class="w3-col w3-light-grey s12 m6 l3 w3-center">
		<i class="fa fa-laptop" style="font-size: 100px;" ></i>
		<form  method="POST">
			<input type="hidden" name="student" value="student">
			<button type="submit" name="stu_btn">Student login</button>
	</div>
	<div class="w3-col w3-light-grey s12 m6 l3 w3-center">
		<i class="fa fa-pencil" style="font-size: 100px;" ></i><br/>
		<input type="hidden" name="teacher" value="teacher">
		<button type="submit" name="tchr_btn">Teacher login</button>
		</form>
	</div>
	

</div>

</body>
</html>