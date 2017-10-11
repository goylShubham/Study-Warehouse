<?php
include("sessions.php");
echo $login_session;
if (isset($_POST['select_semester'])) {
  $_SESSION['semester'] = $_POST['semester_no'];
  header("location:view.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="w3.css">
  <link rel="stylesheet" type="text/css" href="assets\font-awesome-4.7.0\css\font-awesome.min.css">
  <style type="text/css">
    form {
      margin-bottom: 0px;
    }
  </style>
</head>
<body>
<header class="">
  <h1>Study Wherehouse</h1>
</header>
<div class="w3-row w3-margine">
<?php 
  $semester_no = 1;
  while($semester_no <=7)
  {
    echo '<form method="post"><input type="hidden" name="semester_no" value="'.$semester_no.'"><button name="select_semester" class="w3-col w3-container w3-padding-32 w3-button w3-card w3-center';
    if ($semester_no == 1 || $semester_no ==5) {
      echo " w3-red";
    }elseif ($semester_no == 2 || $semester_no == 6) {
      echo " w3-green";
    }elseif ($semester_no == 3 || $semester_no == 7) {
      echo " w3-yellow";
    }else {
      echo " w3-blue";
    }
    echo ' s12 m6 l3" ><span class="w3-center" style="font-size: 5em;">'.$semester_no.'<sup>';
    if($semester_no == 1){echo "st";}
    else if($semester_no == 2){echo "nd";}
    else if($semester_no == 3){echo "rd";}
    else{echo "th";}
    echo '</sup></br></span>
    <b class="w3-center w3-padding-32" >Semester</b>
  </button>
</form>';
$semester_no++;
  }
?>
<a href="view.php?feedback=1">
<div class="w3-col w3-container w3-padding-32 w3-button w3-card w3-center w3-blue s12 m6 l3" >
  <i class="fa fa-feed w3-padding-32 w3-xxlarge"><br/>Feedback</i><br/>
</div>
</a>
</div>

</body>
</html>