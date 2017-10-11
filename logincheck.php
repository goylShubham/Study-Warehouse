<?php
include('connection.php');

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      if(isset($_POST['stu_login']))
      {
         if(!empty($_POST['stu_uid']))
         {
            $user_id = mysqli_real_escape_string($db,$_POST['stu_uid']);
            $query = "SELECT student_id FROM student WHERE student_id = '$user_id'";
            $result = mysqli_query($db,$query );
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count == 1)
            {
               session_start();
               $_SESSION['login_stu'] = $user_id;
               header("location: teacherhome.php");
            }
            else
            {
               $error_msg = 'UID is Incorrect.';
            }
         }
         else
         {
            $error_msg = 'Please enter you UID.';
         }  
      }
      else if(isset($_POST['tchr_login']))
      {
         if(!empty($_POST['tchr_uid']))
         {
            if (!empty($_POST['tchr_pwd'])) 
            {
               $user_id = mysqli_real_escape_string($db,$_POST['tchr_uid']);
               $user_pwd = mysqli_real_escape_string($db,$_POST['tchr_pwd']);
               $query = "SELECT teacher_id FROM teacher WHERE teacher_id = '$user_id'";
               $result = mysqli_query($db,$query );
               $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
               $count = mysqli_num_rows($result);
               if($count == 1)
               {
                  $query = "SELECT teacher_password FROM teacher WHERE teacher_password = '$user_pwd'";
                  $result = mysqli_query($db,$query );
                  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                  $count = mysqli_num_rows($result);
                  if($count > 0)
                  {
                     $query = "SELECT teacher_id,teacher_password FROM teacher WHERE teacher_id = '$user_id' AND teacher_password = '$user_pwd'";
                     $result = mysqli_query($db,$query );
                     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                     $count = mysqli_num_rows($result);
                     if($count == 1)
                     {
                        session_start();
                        $_SESSION['login_tchr'] = $user_id;
                        header("location: teacherhome.php");
                     }
                     else
                     {
                        $error_msg = 'Incorrect UID or Password.';
                     }
                  }
                  else
                  {
                     $error_msg = 'Incorrect Password.';
                  }  
               }
               else
               {
                  $error_msg = 'Incorrect User ID.';
               }
            }
            else
            {
               $error_msg = "Please Enter Your Password.";
            }
         }
         else
         {
            $error_msg = "Please Enter Your UID.";
         }
      }
      else
      {
         header("location: index.php");
      }
   }
?>