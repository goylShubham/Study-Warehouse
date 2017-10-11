<?php
include ('sessions.php');
if (isset($_SESSION['semester'])) {
    $semester = $_SESSION['semester'];
} else {
    header('location:teacherhome.php');
}
if (isset($_POST['upld_btn'])) {
    if (isset($_POST['upld_sub'])) {
        if (isset($_POST['content_type'])) {
            $upld_sub = $_POST['upld_sub'];
            $topic_name = mysqli_real_escape_string($db,$_POST['topic_name']);
            $topic_description = mysqli_real_escape_string($db,$_POST['topic_description']);
            $file_name = $_FILES['file']['name'];
            $file_temp_name = $_FILES['file']['tmp_name'];
            $content_type = $_POST['content_type'];
            if (!empty($file_name)) {
                switch ($content_type) {
                    case 'video':
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $file_temp_name);
                        if ($mime == "video/mp4") {
                            if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                                $upload_error = "Unexpected error occured, please try again later.";
                            } else {
                                if (file_exists("filerepository/videos/$file_name")) {
                                    $upload_error = $file_name . " already exists.";
                                } else {
                                    if (move_uploaded_file($file_temp_name, "filerepository/videos/$file_name")) {
                                        $url = "http://www.studywarehouse.com/studywarehouse/filerepository/videos/$file_name";
                                        $query = "INSERT INTO `video`(`video_topic`, `video_subject_code`, `video_description`, `video_url`, `video_date`, `video_time`) VALUES ('$topic_name','$upld_sub','$topic_description','$url',NOW(),NOW())";
                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        if ($result) {
                                            $upload_success = "Video uploaded successfully.";
                                        } else {
                                            $upload_error = "Unexpected error occured, please try again later.";
                                        }
                                    } else {
                                        $upload_error = "Unexpected error occured, please try again later.";

                                    }

                                }
                            }
                        } else {
                            $upload_error = "Invalid video format. Video format should be mp4 only.";
                        }

                        break;

                    case 'book':
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
                        if ($mime == "application/pdf") {
                            if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                                $upload_error = "Unexpected error occured, please try again later.";
                            } else {
                                if (file_exists("filerepository/ebooks/" . $file_name)) {
                                    $upload_error = $file_name . " already exists.";
                                } else {
                                    if (move_uploaded_file($file_temp_name, "filerepository/ebooks/" . $file_name)) {
                                        $url = "http://127.0.0.1/studywarehouse/filerepository/ebooks/$file_name";
                                        $query = "INSERT INTO `book`(`book_id`, `book_topic`, `book_subject_code`, `book_description`, `book_url`, `book_date`, `book_time`) VALUES (NULL,'$topic_name','$upld_sub','$topic_description','$url',date('d'-'m'-'Y'),date('H:ia'))";
                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        if ($result) {
                                            $upload_success = "Book uploaded successfully.";

                                        } else {
                                            $upload_error = "Unexpected error occured, please try again later.";
                                        }
                                    } else {
                                        $upload_error = "Unexpected error occured, please try again later.";
                                    }

                                }
                            }
                        } else {
                            $upload_error = "Invalid book format. Book format should be pdf only.";
                        }

                        break;

                    case 'notes':
                        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                            die("Upload failed with error " . $_FILES['file']['error']);
                        }
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);
                        if ($mime == 'application/pdf' || $mime == 'application/msword' || $mime ==
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $mime ==
                            'application/vnd.ms-powerpoint' || $mime ==
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation') {
                            if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                                $upload_error = "Unexpected error occured, please try again later.";
                            } else {
                                if (file_exists("filerepository/enotes/" . $file_name)) {
                                    $upload_error = $file_name . " already exists.";
                                } else {
                                    if (move_uploaded_file($file_temp_name, "filerepository/enotes/" . $file_name)) {
                                        $url = "http://127.0.0.1/studywarehouse/filerepository/enotes/$file_name";
                                        $query = "INSERT INTO `notes`(`notes_id`, `notes_topic`, `notes_subject_code`, `notes_description`, `notes_url`, `notes_date`, `notes_time`) VALUES (NULL,'$topic_name','$upld_sub','$topic_description','$url',date('d'-'m'-'Y'),date('H:ia'))";
                                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                        if ($result) {
                                            $upload_success = "Notes uploaded successfully.";

                                        } else {
                                            $upload_error = "Unexpected error occured, please try again later.";
                                        }
                                    } else {
                                        $upload_error = "Unexpected error occured, please try again later.";
                                    }

                                }
                            }
                        } else {
                            $upload_error = "Invalid notes format. notes format should be pdf, doc, docx, ppt and pptx only.";
                        }
                        break;

                    default:
                        $upload_error = "Please select file type.";
                        break;
                }
            } else {
                $upload_error = "Please select a file to upload.";
            }
        } else {
            $upload_error = "Please select a file type.";
        }

    } else {
        $upload_error = "Please select a subject.";
    }
}

if (isset($_POST['videos'])) {
    $_SESSION['type'] = 'videos';
} elseif (isset($_POST['books'])) {
    $_SESSION['type'] = 'ebook';
} elseif (isset($_POST['notes'])) {
    $_SESSION['type'] = 'enotes';
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
<?php
if (isset($upload_success)) {
    echo "<div class='w3-panel w3-pale-green w3-text-green w3-leftbar w3-border-green'><p><i class='fa fa-check w3-xlarge'></i> " .
        $upload_success . "<i class='fa fa-smile-o w3-xlarge'></i></p></div>";
} elseif (isset($upload_error)) {
    echo "<div class='w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'><p><i class='fa fa-warning w3-xlarge'></i> " .
        $upload_error . "<i class='fa fa-frown-o w3-xlarge'></i></p></div>";
}
if (isset($_SESSION['login_stu']))  {
    $unauthorized_error = "You are not authorized to access this page !";
  echo "<div class='w3-panel w3-pale-red w3-text-red w3-bottombar w3-border-red'><p><i class='fa fa-user-times w3-jumbo'></i> " .
        $unauthorized_error . "</p></div>";
} else {
    ?>
<div class="w3-row">
    <div class="w3-col w3-padding-large s12 l3">
        <div class="w3-panel w3-green w3-leftbar w3-rightbar w3-border-amber">
            <h2 class="w3-center"><i class="fa fa-info-circle"></i></h2>
            <ul>
                <li class="w3-section">Videos should be in the format of <b>mp4</b> only.</li>
                <li class="w3-section">Books should be in the format of <b>pdf</b> only.</li>
                <li class="w3-section">Notes should be in the format of <b>pdf, doc, docx, ppt</b> and<b> pptx</b> only.</li>
            </ul>
        </div>
    </div>
    <div class="w3-col w3-padding-large s12 l6">
    <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post" class="w3-container w3-round-large w3-card w3-light-grey w3-text-red" enctype="multipart/form-data">
<div class="w3-row w3-section">
  <select name="upld_sub" required class="w3-input w3-round-large w3-border w3-hover-border-green" style="outline: none;">
  <option selected disabled>Select Subject</option>
    <?php
$query = "SELECT subject_code,subject_name FROM subject WHERE subject_semester =" . $semester;
$result = mysqli_query($db, $query);
$count = mysqli_num_rows($result);
if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['subject_code'] . "'>" . $row['subject_name'] .
            "</option>";
    }
} else {
    header("location:teacherhome.php");
}
?>    
  </select>
</div>
<div class="w3-row w3-section">
  <input type="text" name="topic_name" placeholder="Enter topic/book name" maxlength="250" required class="w3-input w3-round-large w3-border w3-hover-border-green" style="outline: none;">
</div>
<div class="w3-row w3-section">
  <textarea name="topic_description" placeholder="Enter file description" rows="3" maxlength="499" required class="w3-input w3-round-large w3-border w3-hover-border-green" style="outline: none; resize: none;"></textarea>
</div>
<div class="w3-row w3-section">
  <select name="content_type" required class="w3-input w3-round-large w3-border w3-hover-border-green" style="outline: none;">
    <option selected disabled>Select Content Type</option>
    <option value="video" class="w3-input">Video</option>
    <option value="book">Book</option>
    <option value="notes">Notes</option>
  </select>
</div>
<div class="w3-rowk w3-section">
  <input type="file" name="file" required class="w3-input w3-round-large w3-border w3-hover-border-green" style="outline: none;">
</div>
<div class="w3-row w3-section">  
<button type="submit" name="upld_btn" class="w3-btn w3-block w3-section w3-green w3-round-large" style="width: 100%;">Upload</button>
</div>
</form>
        
    </div>
</div>
<?php
}
?>
</body>
</html>