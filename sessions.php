<?php
   include('connection.php');
   session_start();

   if (isset($_SESSION['login_stu'])) 
   {
   	$user_check = $_SESSION['login_stu'];
   	$ses_sql = mysqli_query($db,"select student_name from student where student_id = '$user_check' ");
   	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   	$login_session = $row['student_name'];
   }
   else if (isset($_SESSION['login_tchr'])) 
   {
   	$user_check = $_SESSION['login_tchr'];
   	$ses_sql = mysqli_query($db,"select teacher_name from teacher where teacher_id = '$user_check' ");
   	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   	$login_session = $row['teacher_name'];
   }
   else
   {
   	header("location:index.php");
   }
?>