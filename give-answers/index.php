<?php
    if(isset($_GET['donater']))
    {
		$donater=$_GET['donater'];
		include_once("../layout/head.php");
        if($_SESSION['account_type']=="donater"&&$_SESSION['current_user']==$donater)
        {
			include('../include/config.php');
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
    </style>
  <div class="blog">
  <div class="blocks">
  <h2> Questions To You</h2>
  ';
			$currentDonaterId=$_SESSION['current_user'];
			$getDonaterDetails=mysqli_query($conn,"SELECT * FROM Contributer_DB WHERE contributer_unique_id='$currentDonaterId'");
			$donaterDetails=mysqli_fetch_array($getDonaterDetails);
			$id=$donaterDetails['contributer_id'];
			$job=$donaterDetails['contributer_job'];
			$company=$donaterDetails['contributer_organization'];
			$getQuestionsDetails=mysqli_query($conn,"SELECT * FROM Student_DB WHERE (student_dream_job ='$job' OR student_dream_company = '$company' )AND student_id NOT IN (SELECT student_id FROM Questions_DB WHERE question_id IN ( SELECT question_id FROM Answers_DB WHERE contributer_id='$id'))");
			$flag=1;
			while($getQuestions=mysqli_fetch_array($getQuestionsDetails))
			{
				$flag=0;
					echo '<div class="message" style=" padding : 1px;background:#810E0E; width: 98%;">
   <div class="message_padding" style="padding:2px; background:#EA8065;">
    <img style="overflow: hidden;display: block; width : 100px;  height : 100px; border-radius:50%" src="../avatars/'.$getQuestions['student_unique_id'].'.jpg"></img>
  </div>
  <div class="message_body" style="background:#F1B9C3; color:#181818">
   <script>
  function makeReplay(link)
  {
	document.getElementById(\'replayForm\').action = link;
	document.getElementById(\'giveReplay\').style.display=\'block\';
  }
  </script>
    <p > '.$getQuestions['student_name'].' likes to join  '.$getQuestions['student_dream_company'].'  As '.$getQuestions['student_dream_job'].'   <button style=" width : 100px; float: right; margin-right : 40px;"onclick="makeReplay(\'replay.php?sid='.$getQuestions['student_unique_id'].'&uid='.$currentDonaterId.'\')"> Replay</button></p>
  </div>
  </div>
  <div id="giveReplay" class="modal">
                        <form class="modal-content animate" id="replayForm" name="dreamDetails" action="URL" method="POST">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById(\'giveReplay\').style.display=\'none\'" class="close" title="Close Window">&times;</span>
                            </div>
                            <div class="container">
                                <label><b>Your Replay</b></label>
                                <textarea name="replay" id="replay" style="width:100%;" rows="6" placeholder="Enter Your Relpay ." required></textarea>
                                <button type="submit">Done</button>
                                <br/>
                            </div>
                        </form>
                    </div>';
			}
			if($flag)
			{
				echo '<div class="message" style="background: linear-gradient(to left, #f40e3a, #f40e19); width: 98%;">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p> No Questions Found In Your Domain.</p>
  </div>
  </div>';
			}						
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
    else
    {
		header("Location:../");
	}
?>
