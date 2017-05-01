<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  include_once ("../include/functions.php");

  $student_id=$_GET['student'];
  $student_Sql="SELECT student_id FROM Student_DB WHERE student_unique_id='$student_id'";
  $student_Result=mysqli_query($conn,$student_Sql);
  $student_Details = mysqli_fetch_array($student_Result);
  $id=$student_Details['student_id'];

  $projects_Sql="SELECT post_id,post_link,post_subject,post_date,post_status FROM Post_DB WHERE student_id='$id'";
  $projects_Result=mysqli_query($conn,$projects_Sql);
  $projects_count = mysqli_num_rows($projects_Result);
  echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
              echo '<link rel="stylesheet" href="http://localhost/vk/css/form_style.css">';
      echo '<style>
   div.blog
        {
            width: 100%;
            display : table;
        }
    div.feeds
        {
            width: 28%;
            display : block;
            /*background-color:red;*/
            float : right;
            height : 500px;
            margin-right:1%;
            text-align:center;
        }
        div.blocks
        {
            width: 67%;
            display : block;
            background-color:#F3F3F3;
            float : left;
            margin-left:1%;
            border: 1px solid #dedede; 
            margin-top:25px;
            padding:5px 0px 10px 0px;
            box-shadow: 2px 2px 5px rgba(0,0,0,.1);
            text-align:center;
         }
    .blocks i {
    font-size:14px;
    font-weight: 300;
}
.blocks a {
    font-size: 24px;
    color:#0366D6;
    font-weight: 500;
    text-transform: uppercase;
}
    </style>
  <div class="blog">
  <div class="blocks">
 <h2>My Projects </h2>';
  if($projects_count==0)
    {
        echo '<div class="message">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>You have no Pojects </p>
  </div>
  </div>';
    }
  else
  {
      for($i=1;$i<=$projects_count;$i++)
      {
          $projects_details = mysqli_fetch_array($projects_Result);
          $project_name=$projects_details['post_subject'];
          $project_link=$projects_details['post_link'];
          $project_date=$projects_details['post_date'];
          $project_status=$projects_details['post_status'];

          $status="Under Review";
          if($project_status==2)
          {
            $status="Completed";
            $project_id=$projects_details['post_id'];
            $Donater_Sql="SELECT contributer_id FROM Donated_Projects_DB WHERE post_id='$project_id'";
            $Donater_Result=mysqli_query($conn,$Donater_Sql);
            $Donater_details = mysqli_fetch_array($Donater_Result);
            $donater_id=$Donater_details['contributer_id'];

            $contributer_Sql="SELECT contributer_name,contributer_unique_id FROM Contributer_DB WHERE contributer_id='$donater_id'";
            $contributer_Result=mysqli_query($conn,$contributer_Sql);
            $contributer_details = mysqli_fetch_array($contributer_Result);
            $donater_name=$contributer_details['contributer_name'];
            $donater_unique_id=$contributer_details['contributer_unique_id'];

            $status=$status.'<br/>  Donator :'.'<a style="font-size:15px;color:#31C653;"; href="http://localhost/vk/donater-profile/index.php?donater='.$donater_unique_id.'" >'.$donater_name.'</a>';
          }
          elseif($project_status==1)
            $status="Under Process";


            echo '<div class="message" style="border-radius: 3px; overflow:hidden;border: solid 1px #0366d6;">
 <div class="message_padding" style="padding:2px; background:#F1F8FF;">
    <img style="overflow: hidden;display: block; width : 180px;  height : 110px;" src="http://'.$project_link.'/img/image.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1F8FF; color:#586069">
   <p>  <a href="http://'.$project_link.'" >'.$project_name.' </a> <br/><i>  '.$project_date.'</i><br/> Status :'.$status.'
  </div>
  </div>';
      }


  } 

echo '</div><div class="feeds">
      <h2>My Donaters </h2>';
      $dSql="SELECT contributer_name,contributer_unique_id FROM Contributer_DB WHERE contributer_id IN (SELECT contributer_id FROM Donated_Projects_DB WHERE student_id='$id')";
      $dResult=mysqli_query($conn,$dSql);
      while($ddetails = mysqli_fetch_array($dResult))
      {
        echo '<div class="message" style="border-radius: 3px; overflow:hidden;border: solid 1px #0366d6 ; width:98%;">
 <div class="message_padding" style="padding:2px; background:#F1F8FF;">
    <img style="overflow: hidden;display: block; width : 100px;  height : 100px; border-radius:50%"" src="../avatars/'.$ddetails['contributer_unique_id'].'.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1F8FF; color:#586069">
   <p>  <a style="font-size:25px;color:#31C653; font-weight: 600; text-transform: uppercase;" href="../donater-profile/index.php?donater='.$ddetails['contributer_unique_id'].'" >'.$ddetails['contributer_name'].' </a>
  </div>
  </div>';
      }
?>