<?php
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
  <style>
    @import url(http://fonts.googleapis.com/css?family=Lato:300);
    body {
        max-width: 80em;
        margin-left: auto;
        margin-right: auto;
        padding: 2em;
        background: linear-gradient(to left, #A1FFCE, #FAFFD1);
        color: #444;
        font-family: "Lato", sans-serif;
        font-weight: 300;
        line-height: 1;
        text-align: center;
    }
    
    .profile-avatar {
        display: block;
        height: 11em;
        width : 11em;
        margin-right: auto;
        margin-left: auto;
        border: .5em solid #f2f2f2;
        border-radius: 100%;
        box-shadow: 0 1px 0 0 rgba(0, 0, 0, .1);
    }
    
    .profile-name {
        margin-right: -1em;
        margin-bottom: .75em;
        margin-left: -1em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding-bottom: .75em;
        font-size: 1.5em;
        text-transform: uppercase;
    }
    
    .profile-text {
        margin-top: -3.5em;
        padding: 5em 1.5em 1.5em 1.5em;
        background: white;
        border-radius: 3px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1)
    }
    
    .profile-data {
        color: #2F4F4F;
        font-weight: bold;
        font-size: 1.1em;
    }
</style>
<img src="../avatars/'.$student_id.'.jpg" class="profile-avatar">
<div class="profile-text">
    <h1 class="profile-name">'.$name.'</h1>
    <span class="profile-data">Email <br/> '.$email.' </span>
    <br/>
    <br/>
    <span class="profile-data">Year of birth <br/> '.$year.' </span>
    <br/>
    <br/>
    <span class="profile-data">School Address <br/> '.nl2br($address).' </span>
    <br/>
    <br/>
    <span class="profile-data">State : '.getStateName($state).' </span>
    <br/>
    <br/>
    <span class="profile-data">PIN : '.$pin.' </span>
</div>
  ';
?>