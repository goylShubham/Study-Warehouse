<?php
function videos()
{
    global $db;
    $query = "SELECT video_id,video_subject_code,video_topic,video_description,video_url FROM video WHERE video_subject_code = '" .
        $_SESSION['sub_name'] . "'";
    $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<table class='w3-table w3-bordered w3-green w3-small'>";
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        echo "<tr>
                <th colspan='3' class='w3-center' >" . $row['subject_name'] .
            "</th></tr>";
        echo "<tr class='w3-row'>
            <th class='w3-col s5 m4 l3'>Topic</th>
            <th colspan='2' class='w3-col s7 m7 l8'>Description</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='w3-row w3-card'>";
            echo "<th class='w3-col s5 m4 l3'>" . $row['video_topic'] . "</th>";
            echo "<td class='w3-col s7 m6 l7'>" . $row['video_description'] .
                "</td>";
            echo "<td class='w3-col m2 l2'><form action='video_player.php' method='post'>
                    <input type='hidden' name='vid' value='" . $row['video_id'] . "'>
                    <input type='hidden' name='subject_code' value='" . $row['video_subject_code'] .
                "'>
                    <button name='watch' class='w3-button w3-hover-green w3-transparent' title='Watch'><i class='fa fa-eye'></i></button>
                    </form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        $not_found_error = "Sorry! no videos available for " . $row['subject_name'];
        echo "<div class='w3-row w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'>
            <div class='w3-col s12 m1 l1'><i class='fa fa-frown-o w3-jumbo'></i></div>
            <div class='w3-col m11 l11'>" . $not_found_error . "</div>
            </div>";
    }
}
function books()
{
    global $db;
    $query = "SELECT book_id,book_topic,book_description,book_url FROM book WHERE book_subject_code = '" .
        $_SESSION['sub_name'] . "'";
    $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<table class='w3-table w3-bordered w3-small w3-yellow'>";
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        echo "<tr>
                <th colspan='3' class='w3-center'>" . $row['subject_name'] .
            "</th>
                </tr>";
        echo "<tr class='w3-row'>
                      <th class='w3-col s5 m4 l3'>Book Name</th>
                      <th colspan='2' class='w3-col s7 m7 l8'>Description</th>
                    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='w3-row w3-card'>";
            echo "<th class='w3-col s5 m4 l3'>" . $row['book_topic'] . "</th>";
            echo "<td class='w3-col s7 m6 l7 '>" . $row['book_description'] .
                "</td>";
            echo "<td class='w3-col m2 l2'><a href='" . $row['book_url'] .
                "' class=' w3-transparent' title='Download'><i class='fa fa-download w3-button w3-hover-yellow'></i></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        $not_found_error = "Sorry! no books available for " . $row['subject_name'];
        echo "<div class='w3-row w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'>
            <div class='w3-col s12 m1 l1'><i class='fa fa-frown-o w3-jumbo'></i></div>
            <div class='w3-col m11 l11'>" . $not_found_error . "</div>
            </div>";
    }
}
function notes()
{
    global $db;
    $query = "SELECT notes_id,notes_topic,notes_description,notes_url FROM notes WHERE notes_subject_code = '" .
        $_SESSION['sub_name'] . "'";
    $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo "<table class='w3-table w3-bordered w3-blue w3-small'>";
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        echo "<tr>
                <th colspan='3' class='w3-center'>" . $row['subject_name'] .
            "</th>
                </tr>";
        echo "<tr class='w3-row'>
                      <th class='w3-col s5 m4 l3'>Topic</th>
                      <th colspan='2' class='w3-col s7 m7 l8'>Description</th>
                    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='w3-row w3-card'>";
            echo "<th class='w3-col s5 m4 l3 '>" . $row['notes_topic'] . "</th>";
            echo "<td class='w3-col s7 m6 l7 '>" . $row['notes_description'] .
                "</td>";
            echo "<td class='w3-col m2 l2'><a href='" . $row['notes_url'] .
                "' class='w3-transparent' title='Download'><i class='fa fa-download w3-button w3-hover-blue'></i></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $sub_name = $_SESSION['sub_name'];
        $query = mysqli_query($db,
            "SELECT subject_name from subject WHERE subject_code = '$sub_name'");
        $row = mysqli_fetch_assoc($query);
        $not_found_error = "Sorry! no notes available for " . $row['subject_name'];
        echo "<div class='w3-row w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'>
            <div class='w3-col s12 m1 l1'><i class='fa fa-frown-o w3-jumbo'></i></div>
            <div class='w3-col m11 l11'>" . $not_found_error . "</div>
            </div>";
    }

}
function select_subject_error()
{
    echo "<div class='w3-row w3-panel w3-pale-red w3-text-red w3-leftbar w3-border-red'>
                <div class='w3-col s12 m1 l1'><i class='fa fa-warning w3-jumbo'></i></div>
                <div class='w3-col m11 l11'> Please select subject!</div>
                </div>";
}
