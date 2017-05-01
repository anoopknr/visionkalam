<?php
  include_once ("../layout/head.php");
  include_once ("../include/config.php");
  if(isset($_GET['student_id']))
  {
	$suid=$_GET['student_id'];
	$getQuestionNo=mysqli_query($conn,"SELECT question_id FROM Questions_DB WHERE student_id IN (SELECT student_id FROM Student_DB WHERE student_unique_id='$suid')");
	$count=mysqli_num_rows($getQuestionNo);
  if($count<1)
    header("Location:../");
  $questionNo=mysqli_fetch_array($getQuestionNo);
	$question_id=$questionNo['question_id'];
	}
	else
	{
		$question_id=$_GET['question_no'];
	}
  
  $questionSql="SELECT * FROM Answers_DB WHERE question_id='$question_id'";
  $questionResult=mysqli_query($conn,$questionSql);
  $studentDetails=mysqli_query($conn,"SELECT student_name,student_dream_company,student_dream_job,student_unique_id FROM Student_DB WHERE student_id IN (SELECT student_id FROM Questions_DB WHERE question_id=$question_id)");
  $student=mysqli_fetch_array($studentDetails);
  if(isset($_SESSION['current_user']))
  {
	if($student['student_unique_id']==$_SESSION['current_user'])
		$sname="You";
	else
	  $sname=$student['student_name'];
  }
   else
	  $sname=$student['student_name'];
  echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
	echo '<div class="message" style="margin :20px; padding : 2px;background: #E6E2DD; width: 90%; float : left">
  <div class="message_padding" style="padding: 3px 3px 3px 51px;  background:#E3E3E3;">
    <img style="overflow: hidden;display: block; width : 100px;  height : 100px; border-radius:50%" src="../avatars/'.$student['student_unique_id'].'.jpg"></img>
  </div>
  <div class="message_body" style=" padding : 2px;">
  <p style="color:#C61931;font-weight: 600;font-size: 26px;line-height: 44px;" > '.$sname.' likes to join  '.$student['student_dream_company'].'  As '.$student['student_dream_job'].'</p>
  </div>
  </div>';
  $count=mysqli_num_rows($questionResult);
  echo '<div  style=" padding : 0px 20%;background: #fff; color: #000; width: 100%; float : left" >
  <h2> <br/>'.$count.' REPLAYS </h2>
  </div>';
  while($questionDetails = mysqli_fetch_array($questionResult))
  { 
	   $contributer_id=$questionDetails['contributer_id'];
	   $donaterDetails=mysqli_query($conn,"SELECT contributer_name,contributer_unique_id FROM Contributer_DB WHERE contributer_id=$contributer_id");
	   $donater=mysqli_fetch_array($donaterDetails);
	   echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
   
	  echo '<div class="message" style=" margin :20px;background: #f2f1f0; width: 80%; float : right">
    <div class="message_padding" style="padding:5px; background:#E3E3E3;">
    <img style="overflow: hidden;display: block; width : 150px;  height : 150px; border-radius:50%" src="../avatars/'.$donater['contributer_unique_id'].'.jpg"></img>
  </div>
  <div class="message_body" style=" padding : 2px;">
  <p style="font-family: \'Roboto\', sans-serif;font-weight: 300;font-size: 16px; color: #222;line-height: 26px;"> 
  <a href="../donater-profile/index.php?donater='.$donater['contributer_unique_id'].'" style="color: #c61931; text-decoration: none; " >'.$donater['contributer_name'].'</a> Says :
  </br>
  <large style="font-weight: 400;font-size: 20px;line-height: 34px;">
  '.nl2br($questionDetails['answer']).'
  </large>
  <br/>
  on : '.$questionDetails['answer_date'].'
  </p>
  </div>
  </div>';
}
?>
