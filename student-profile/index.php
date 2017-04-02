<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
  $student_id=$_GET['student'];
  $Student_Sql="SELECT student_name,student_email,student_school_address,student_birth_year,student_pin,student_state FROM Student_DB WHERE student_unique_id='$student_id'";
  $Student_Result=mysqli_query($conn,$Student_Sql);
  $Student_Details = mysqli_fetch_array($Student_Result);
  $name=$Student_Details['student_name'];
  $email=$Student_Details['student_email'];
  $address=$Student_Details['student_school_address'];
  $year=$Student_Details['student_birth_year'];
  $pin=$Student_Details['student_pin'];
  $state=$Student_Details['student_state'];
  echo'
  <link rel="stylesheet" href="http://localhost/vk/css/profile_style.css">
  <div  class="profile-avatar">
    <img src="../avatars/'.$student_id.'.jpg">
 </div>
  <div class="profile-text">
    <h1 class="profile-name">'.$name.'</h1>
    <span class="profile-data">Email : '.$email.' </span>
    <br/>
    <br/>
    <span class="profile-data">Year of birth : '.$year.' </span>
    <br/>
    <br/>
    <span class="profile-data">School Address : '.nl2br($address).' </span>
    <br/>
    <br/>
    <span class="profile-data">State : '.getStateName($state).' </span>
    <br/>
    <br/>
    <span class="profile-data">PIN : '.$pin.' </span>
</div>
  ';
?>