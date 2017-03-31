<?php
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
  $contributer_id=$_GET['donater'];
  $contributer_Sql="SELECT contributer_name,contributer_email,contributer_job,contributer_organization FROM Contributer_DB WHERE contributer_unique_id='$contributer_id'";
  $contributer_Result=mysqli_query($conn,$contributer_Sql);
  $contributer_Details = mysqli_fetch_array($contributer_Result);
  $name=$contributer_Details['contributer_name'];
  $email=$contributer_Details['contributer_email'];
  $job=$contributer_Details['contributer_job'];
  $organization=$contributer_Details['contributer_organization'];

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
<img src="../avatars/'.$contributer_id.'.jpg" class="profile-avatar">
<div class="profile-text">
    <h1 class="profile-name">'.$name.'</h1>
    <span class="profile-data">Email <br/> '.$email.' </span>
    <br/>
    <br/>
    <span class="profile-data">Job<br/> '.$job.' </span>
    <br/>

    <br/>
    <span class="profile-data">Organization : '.$organization.' </span>
</div>
  ';
?>