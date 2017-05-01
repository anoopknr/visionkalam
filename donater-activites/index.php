<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  include_once ("../include/functions.php");
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
            width: 68%;
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
    </style>
  <div class="blog">
  <div class="blocks">
  ';
  $contributer_id=$_GET['donater'];
  $contributer_Sql="SELECT contributer_id FROM Contributer_DB WHERE contributer_unique_id='$contributer_id'";
  $contributer_Result=mysqli_query($conn,$contributer_Sql);
  $contributer_Details = mysqli_fetch_array($contributer_Result);
  $id=$contributer_Details['contributer_id'];

  $pending_projects_Sql="SELECT post_id FROM Donation_Process_DB WHERE contributer_id='$id'";
  $pending_projects_Result=mysqli_query($conn,$pending_projects_Sql);
  $pending_projects_count = mysqli_num_rows($pending_projects_Result);
  echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
  echo '<h2 style="text-align:center">Under Process Donations </h2>';
  if($pending_projects_count==0)
    {
        echo '<div class="message">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>You have no Under process Donation </p>
  </div>
  </div>';
    }
  else
  {
      for($i=1;$i<=$pending_projects_count;$i++)
      {
          $pending_projects_details = mysqli_fetch_array($pending_projects_Result);
          $project_id=$pending_projects_details['post_id'];

          $projects_details_Sql="SELECT post_subject,post_link,student_id,post_link FROM Post_DB WHERE post_id=$project_id";
          $projects_details_Result=mysqli_query($conn,$projects_details_Sql);
          $projects_details = mysqli_fetch_array($projects_details_Result);
          $project_name=$projects_details['post_subject'];
          $project_link=$projects_details['post_link'];
          $student_id=$projects_details['student_id'];
          $link=$projects_details['post_link'];

          $student_details_Sql="SELECT student_name,student_unique_id FROM Student_DB WHERE student_id=$student_id";
          $student_details_Result=mysqli_query($conn,$student_details_Sql);
          $student_details = mysqli_fetch_array($student_details_Result);
          $student_name=$student_details['student_name'];
          $student_uid=$student_details['student_unique_id'];

            echo '<div class="message">
  <div class="message_padding" style="padding:2px; background:#EA8065;">
    <img style="overflow: hidden;display: block; width : 150px;  height : 100px;" src="http://'.$link.'/img/image.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1B9C3; color:#181818">
   <p> Donation to <a href="http://'.$project_link.'" >'.$project_name.' </a> By <a href="http://localhost/vk/student-profile/index.php?student='.$student_uid.'"> '.$student_name.'</a> is under Process</p>
  </div>
  </div>';
      }
  }
  $Donated_projects_Sql="SELECT post_id FROM Donated_Projects_DB WHERE contributer_id='$id'";
  $Donated_projects_Result=mysqli_query($conn,$Donated_projects_Sql);
  $Donated_projects_count = mysqli_num_rows($Donated_projects_Result);
  echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
    echo '<link rel="stylesheet" href="http://localhost/vk/css/form_style.css">';
  echo '<h2 style="text-align:center">Projects You Have Donated </h2>';
  if($Donated_projects_count==0)
    {
        echo '<div class="message">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>You have NO verified Donation :(</p>
  </div>
  </div>';
    }
  else
  {
      for($i=1;$i<=$Donated_projects_count;$i++)
      {
          $Donated_projects_details = mysqli_fetch_array($Donated_projects_Result);
          $project_id=$Donated_projects_details['post_id'];

          $projects_details_Sql="SELECT post_subject,post_link,student_id FROM Post_DB WHERE post_id=$project_id";
          $projects_details_Result=mysqli_query($conn,$projects_details_Sql);
          $projects_details = mysqli_fetch_array($projects_details_Result);
          $project_name=$projects_details['post_subject'];
          $project_link=$projects_details['post_link'];
          $student_id=$projects_details['student_id'];
          $link=$projects_details['post_link'];

          $student_details_Sql="SELECT student_name,student_unique_id FROM Student_DB WHERE student_id=$student_id";
          $student_details_Result=mysqli_query($conn,$student_details_Sql);
          $student_details = mysqli_fetch_array($student_details_Result);
          $student_name=$student_details['student_name'];
          $student_uid=$student_details['student_unique_id'];

            echo '<div class="message">
 <div class="message_padding" style="padding:2px; background:#EA8065;">
    <img style="overflow: hidden;display: block; width : 150px;  height : 100px;" src="http://'.$link.'/img/image.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1B9C3; color:#181818">
   <p> Donated to <a href="http://'.$project_link.'" >'.$project_name.' </a> By <a href="http://localhost/vk/student-profile/index.php?student='.$student_uid.'"> '.$student_name.'</a> Sucessfully :)</p>
  </div>
  </div>
  ';
      }
      echo '
      </div>
      <div class="feeds">
      <h2>My Answers </h2>';
    $result = mysqli_query($conn,"SELECT * FROM Student_DB WHERE student_id IN (SELECT student_id FROM Questions_DB WHERE question_id IN (SELECT question_id FROM Answers_DB WHERE contributer_id='$id')) LIMIT 5");
    while($row = mysqli_fetch_array($result))
    {
		$tempsid=$row['student_id'];
		$tempresult=mysqli_query($conn,"SELECT question_id FROM Questions_DB WHERE student_id=$tempsid");
		$qid=mysqli_fetch_array($tempresult);
         echo '<div class="message" style="  box-shadow: 2px 2px 5px rgba(0,0,0,.1);background-color:#F1F8EE; border: 1px solid #dedede;width:99% ; padding : 5px">
  <div class="message_body">
    <p style="color : #3C7648;"><a href ="../student-profile/?student='.$row['student_unique_id'].'">'.$row['student_name'].'</a>\'s Dream to Become <br/> '.$row['student_dream_job'].' at '.$row['student_dream_company'].' </p>
    <button style=" width : 200px; float: right;background:#527ABE; margin-right : 10px;"onclick="window.location.href=\'../questions/index.php?question_no='.$qid['question_id'].'\'"> View Replays</button>
  </div>
  </div>';
       
    }
      echo '
      </div>
      </div>
      ';
  }
?>