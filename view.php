<?php
include ("sessions.php");

if (isset($_SESSION['semester'])) {
    $semester = $_SESSION['semester'];

} else {
    header('location:teacherhome.php');
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

<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post" class="w3-bar w3-white w3-row">
  <a href="teacherhome.php" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-red w3-hover-white'><i class="fa fa-home"></i></a>
  <button name="videos" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-green w3-hover-white'><i class="fa fa-youtube-play"></i></button>
  <button name="books" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-yellow w3-hover-white'><i class="fa fa-book"></i></button>
  <button name="notes" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-blue w3-hover-white'><i class="fa fa-files-o"></i></button>
  <a href="upload.php" class='w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-green w3-hover-white' title="upload"><i class="fa fa-upload"></i></a>
  <a href="logout.php" class="w3-right w3-col s2 m2 l2 w3-bar-item w3-btn w3-xlarge w3-red w3-hover-white" title="Sign out"><i class="fa fa-power-off"></i></a>
</form>
<div class="w3-row">
    <div class="w3-col w3-padding l3">
<?php
$query = "SELECT subject_code,subject_name FROM subject WHERE subject_semester =" . $semester;
$result = mysqli_query($db, $query);
$count = mysqli_num_rows($result);
if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $subject_code = $row['subject_code'];
        $subject_name = $row['subject_name'];
        echo "<form action='" . $_SERVER['REQUEST_URI'] . "' method='POST'>
            <input type='hidden' name='subject_code' value='" . $subject_code .
            "'>
            <button name='sub_name_btn' class='w3-btn w3-red w3-hover-white' style='width:100% ; '>" .
            $subject_name . "</button>
            </form>";
    }
} else {
    header('location:teacherhome.php');
}

?>    
</div>
    <div class="w3-col w3-padding l9">
<?php
if (isset($not_found_error)) {
    echo "<div class='w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'><p>" .
        $not_found_error . "<i class='fa fa-frown-o w3-xlarge'></i></p></div>";
}
include ("vbnFunctions.php");
if (isset($_POST['videos'])) {
    $_SESSION['type'] = 'videos';
    if (isset($_SESSION['sub_name'])) {
        videos();
    } else {
        select_subject_error();
    }
} elseif (isset($_POST['books'])) {
    $_SESSION['type'] = 'ebook';
    if (isset($_SESSION['sub_name'])) {
        books();
    } else {
        select_subject_error();
    }
} elseif (isset($_POST['notes'])) {
    $_SESSION['type'] = 'enotes';
    if (isset($_SESSION['sub_name'])) {
        notes();
    } else {
        select_subject_error();
    }
}

if (isset($_POST['sub_name_btn'])) {

    $_SESSION['sub_name'] = $_POST['subject_code'];

    if (isset($_SESSION['type']) && $_SESSION['type'] == 'videos') {
        videos();
    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'ebook') {
        books();
    } elseif (isset($_SESSION['type']) && $_SESSION['type'] == 'enotes') {
        notes();
    } else {
        videos();
    }
}
?>
    </div>
</div>
</body>
</html>