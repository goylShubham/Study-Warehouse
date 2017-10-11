<?php
// connect to mysql
$db = mysqli_connect('localhost','root','') or
        die('Unable to connect. Check your connection.');
        
//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS studywarehouse';
mysqli_query($db,$query) or die(mysqli_error($db));

//make sure our recently created database is the active one
mysqli_select_db($db,'studywarehouse') or die(mysqli_error($db)); 

//create student table
$query = 'CREATE TABLE student (
        student_id     INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        student_name   VARCHAR(255) NOT NULL,
        student_email   VARCHAR(255) NOT NULL,
        
        PRIMARY KEY (student_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create teacher table
$query = 'CREATE TABLE teacher ( 
        teacher_id     INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        teacher_name   VARCHAR(255) NOT NULL,
        teacher_email  VARCHAR(255) NOT NULL,
        teacher_password   VARCHAR(255) NOT NULL,
        
        PRIMARY KEY (teacher_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create subject table
$query = 'CREATE TABLE subject (
        subject_id     INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        subject_name   VARCHAR(255) NOT NULL,
        subject_code   VARCHAR(255) NOT NULL UNIQUE,
        subject_semester    INTEGER UNSIGNED NOT NULL,
        subject_core  VARCHAR(255) NOT NULL,
        
        PRIMARY KEY (subject_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create video table
$query = 'CREATE TABLE video (
        video_id    INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        video_topic   VARCHAR(255) NOT NULL,
        video_subject_code     INTEGER UNSIGNED REFERENCES subject(subject_code),
        video_description   VARCHAR(255) NOT NULL,
        video_url VARCHAR(255) NOT NULL,
        video_date      DATE NOT NULL,
        video_time      TIME NOT NULL,
        
        PRIMARY KEY (video_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create book table
$query = 'CREATE TABLE book (
        book_id    INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        book_topic   VARCHAR(255) NOT NULL,
        book_subject_code     INTEGER UNSIGNED REFERENCES subject(subject_code),
        book_description   VARCHAR(255) NOT NULL,
        book_url VARCHAR(255) NOT NULL,
        book_date      DATE NOT NULL,
        book_time      TIME NOT NULL,
        
        PRIMARY KEY (book_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create notes table
$query = 'CREATE TABLE notes (
        notes_id    INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        notes_topic   VARCHAR(255) NOT NULL,
        notes_subject_code     INTEGER UNSIGNED REFERENCES subject(subject_code),
        notes_description   VARCHAR(255) NOT NULL,
        notes_url VARCHAR(255) NOT NULL,
        notes_date      DATE NOT NULL,
        notes_time      TIME NOT NULL,
        
        PRIMARY KEY (notes_id)
        )
        ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'database successfully created';
mysqli_close($db);
?>

