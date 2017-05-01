<?php
    
    include_once("layout/head.php");
    
    if(isset($_SESSION['account_type']))
    {
        if($_SESSION["account_type"]=="student")
        {
            include_once('include/student_functions.php');
            if(!isStudentDetailsCompleate($_SESSION["current_user"]))
                {
                     if(isset($_POST['dreamJob']) && isset($_POST['dreamCompany']))
                     {
                             include('include/config.php');
                             $dreamJob=$_POST['dreamJob'];
                             $dreamCompany=$_POST['dreamCompany'];
                             $currentStudent=$_SESSION["current_user"];
                             $setStudentDreamSql='UPDATE `Student_DB` SET `student_dream_company` = "'.$dreamCompany.'", `student_dream_job` = "'.$dreamJob.'" WHERE `Student_DB`.`student_unique_id` = "'.$currentStudent.'"'; 
                             $setStudentDream = mysqli_query($conn,$setStudentDreamSql);
                             $result = mysqli_query($conn,"SELECT student_id FROM Student_DB WHERE student_unique_id ='$currentStudent'");
                             $row = mysqli_fetch_array($result);
                             $student_id=$row['student_id'];
                             $setStudentQuestion= mysqli_query($conn,"INSERT INTO Questions_DB(student_id) VALUES($student_id)");
                             header("Location:./");
                     }
                    echo '<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">';
                    echo '<link rel="stylesheet" href="http://localhost/vk/css/form_style.css">';
                    echo '<div class="message" style="background: linear-gradient(to left, #f40e3a, #f40e19); width: 98%;">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>You Have Not Entered Your Dream Details . <a onclick="document.getElementById(\'dreamDetails\').style.display=\'block\'"> Click Here </a> To Fill Details and Activate Answers TAB</p>
  </div>
  </div>
  <div id="dreamDetails" class="modal">
                        <form class="modal-content animate" name="dreamDetails" action="" method="POST">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById(\'dreamDetails\').style.display=\'none\'" class="close" title="Close Window">&times;</span>
                            </div>
                            <div class="container">
                                <label><b>Dream Company</b></label>
                                <input type="text" placeholder="Enter Dream Company Name" name="dreamCompany" required>
                                <label><b>Dream Job</b></label>
                                <input type="text" placeholder="Enter Dream Job" name="dreamJob" required>
                                <button type="submit">Done</button>
                                <br/>
                            </div>
                        </form>
                    </div>';
                }
        }
        elseif($_SESSION['account_type']=="donater")
        {
			include('include/config.php');
			$currentDonaterId=$_SESSION['current_user'];
			$getDonaterDetails=mysqli_query($conn,"SELECT * FROM Contributer_DB WHERE contributer_unique_id='$currentDonaterId'");
			$donaterDetails=mysqli_fetch_array($getDonaterDetails);
			$id=$donaterDetails['contributer_id'];
			$job=$donaterDetails['contributer_job'];
			$company=$donaterDetails['contributer_organization'];
			$getQuestionsDetails=mysqli_query($conn,"SELECT count(*) FROM Student_DB WHERE (student_dream_job ='$job' OR student_dream_company = '$company' )AND student_id NOT IN (SELECT student_id FROM Questions_DB WHERE question_id IN ( SELECT question_id FROM Answers_DB WHERE contributer_id='$id'))");
			$getQuestions=mysqli_fetch_array($getQuestionsDetails);
			$count=$getQuestions[0];
			if($count>0)
			{
					echo '<div class="message" style="background: linear-gradient(to left, #f40e3a, #f40e19); width: 98%;">
  <div class="message_padding">
    !
  </div>
  <div class="message_body">
    <p>You Have '.$count.' Questions About '.$job.' and '.$company.' <a href="http://localhost/vk/give-answers/index.php?donater='.$currentDonaterId.'"> Click Here </a> to Replay.</p>
  </div>
  </div>
  <script>
  document.getElementById("answersNav").innerHTML = "QUESTIONS('.$count.')";
  </script>';
			}
			
		}
    }
    else
    {
		echo '<link rel="stylesheet" href="http://localhost/vk/css/UI_style.css">';
    echo '<div class=banner-image >
    <img src="images/homebanner.png"></img>
    </div>';
	}
    include_once("filterProjects.php");
    include_once("layout/footer.php");
?>
