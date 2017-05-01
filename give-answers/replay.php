<?php
    if(isset($_GET['uid']))
    {
		$student=$_GET['sid'];
		$donater=$_GET['uid'];
		$answer=$_POST['replay'];
		session_start();
        if( $_SESSION['account_type']=="donater" && $_SESSION['current_user']==$donater)
        {
			include('../include/config.php');
			$getDonaterId=mysqli_query($conn,"SELECT contributer_id FROM Contributer_DB WHERE contributer_unique_id='$donater'");
			$donaterId=mysqli_fetch_array($getDonaterId);
			$id=$donaterId['contributer_id'];
			$getQuestionId=mysqli_query($conn,"SELECT question_id FROM Questions_DB WHERE student_id =(SELECT student_id FROM Student_DB WHERE student_unique_id='$student') ");
			$questionId=mysqli_fetch_array($getQuestionId);
			$qid=$questionId['question_id'];
			$submitAnswer=mysqli_query($conn,"INSERT INTO Answers_DB (question_id,contributer_id,answer) VALUES ($qid,$id,'$answer')");
			header("Location:../give-answers/index.php?donater=".$donater);
		}
    }
    else
    {
		header("Location:../");
	}
?>
