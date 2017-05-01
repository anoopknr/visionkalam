<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
  $contributer_id=$_GET['donater'];
  $contributer_Sql="SELECT contributer_name,contributer_email,contributer_job,contributer_organization,contributer_supported_projects FROM Contributer_DB WHERE contributer_unique_id='$contributer_id'";
  $contributer_Result=mysqli_query($conn,$contributer_Sql);
  $contributer_Details = mysqli_fetch_array($contributer_Result);
  $name=$contributer_Details['contributer_name'];
  $email=$contributer_Details['contributer_email'];
  $job=$contributer_Details['contributer_job'];
  $organization=$contributer_Details['contributer_organization'];
  $project_counts=$contributer_Details['contributer_supported_projects'];

  echo'
   <link rel="stylesheet" href="http://localhost/vk/css/profile_style.css">
   <img src="../avatars/'.$contributer_id.'.jpg" class="profile-avatar">
   <div class="profile-text">
    <h1 class="profile-name">'.$name.'</h1>
    <table class="profile-data">
      <tr><td><l>Donated Projects  </l></td> <td><l> : </l></td> <td>'.$project_counts.'</td> </tr>
      <tr><td><l>Email </l></td> <td><l> : </l></td> <td>'.$email.'</td> </tr>
      <tr><td><l>Job  </l></td> <td><l> : </l></td> <td>'.$job.' </td></tr>
      <tr><td><l> Organization  </l></td> <td><l> : </l></td> <td>'.$organization.' </td></tr>
    </table>
</div>
  ';
?>