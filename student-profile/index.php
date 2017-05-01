<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
  $student_id=$_GET['student'];
  $Student_Sql="SELECT student_name,student_email,student_school_address,student_birth_year,student_pin,student_state,student_dream_job,student_dream_company FROM Student_DB WHERE student_unique_id='$student_id'";
  $Student_Result=mysqli_query($conn,$Student_Sql);
  $Student_Details = mysqli_fetch_array($Student_Result);
  $name=$Student_Details['student_name'];
  $email=$Student_Details['student_email'];
  $address=$Student_Details['student_school_address'];
  $year=$Student_Details['student_birth_year'];
  $pin=$Student_Details['student_pin'];
  $state=$Student_Details['student_state'];
  $job=$Student_Details['student_dream_job'];
  $company=$Student_Details['student_dream_company'];
  echo'
  <style>
     div.feeds
        {
            width: 28%;
            display : block;
            /*background-color:red;*/
            float : right;
            margin-right:.5%;
            text-align:center;
        }
    </style>    
  <link rel="stylesheet" href="http://localhost/vk/css/message_style.css">
  <link rel="stylesheet" href="http://localhost/vk/css/profile_style.css">
  <div  class="profile-avatar">
    <img src="../avatars/'.$student_id.'.jpg">
 </div>
  <div class="profile-text">
    <h1 class="profile-name">'.$name.'</h1>';
    if(!isset($_SESSION["account_type"])||($_SESSION["account_type"]=="donater"))
    {
    echo'
    <div class="feeds">
      <h2>'.$name.'\'s Projects </h2>';
      $dSql="SELECT post_link,post_subject FROM Post_DB WHERE student_id IN (SELECT student_id FROM Student_DB WHERE student_unique_id='$student_id') ORDER BY RAND() LIMIT 3";
      $pResult=mysqli_query($conn,$dSql);
      while($pdetails = mysqli_fetch_array($pResult))
      {
        echo '<div class="message" style="border-radius: 3px; overflow:hidden;border: solid 1px #0366d6 ; width:98%;">
 <div class="message_padding" style="padding:2px; width:72px; background:#F1F8FF;">
    <img style="overflow: hidden;display: block; width : 72px;  height : 72px; border-radius:50%"" src="http://'.$pdetails ['post_link'].'/img/image.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1F8FF; color:#586069">
   <p>  <a style="font-size:20px;color:#31C653; font-weight: 600; text-transform: uppercase;" href="http://'.$pdetails ['post_link'].'" >'.$pdetails ['post_subject'].' </a>
  </div>
  </div>
  ';
      }
    echo '
    </div>';
    }
    echo '
    <table class="profile-data">
      <tr><td><l>Projects </l></td> <td><l> : </l></td> <td>'.getProjects($student_id).'</td> </tr>
      <tr><td><l>Email </l></td> <td><l> : </l></td> <td>'.$email.'</td> </tr>
      <tr><td><l>Year of birth </l></td> <td><l> : </l></td> <td>'.$year.' </td></tr>
      <tr><td><l>School Address </l></td> <td><l> : </l></td> <td>'.nl2br($address).' </td></tr>
      <tr><td><l>State </l></td> <td><l> : </l></td> <td>'.getStateName($state).' </td></tr>
      <tr><td><l>PIN </l></td> <td><l> : </l></td> <td>'.$pin.' </td></tr>
      <tr><td><l>Dream Job </l></td> <td><l> : </l></td> <td>'.$job.' </td></tr>
      <tr><td><l>Dream Company </l></td> <td><l> : </l></td> <td>'.$company.' </td></tr>
  </table>';
  
?>