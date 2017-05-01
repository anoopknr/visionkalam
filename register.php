<?php
    if ( !($_SERVER['REQUEST_METHOD'] == 'POST') )
         header("location:./");
	// 	connecting database
	
	$new_user_name=$_POST['name'];
	$new_user_email=$_POST['email'];
	$new_user_password=$_POST['password'];
    $new_user_account_type=$_POST['acc_type'];

    // connecting database
include_once ('include/config.php');


    $student_sql="SELECT * FROM Student_DB WHERE student_email='$new_user_email'";
    $student_result=mysqli_query($conn,$student_sql);
    $scount = mysqli_num_rows($student_result);
    $donater_sql="SELECT * FROM Contributer_DB WHERE contributer_email='$new_user_email'";
    $donater_result=mysqli_query($conn,$donater_sql);
    $dcount = mysqli_num_rows($donater_result);

    if($dcount==1||$scount==1)
    {
        session_start();
    	session_unset();
        $_SESSION['error']=2;
	    header("Location:./");
    }
    // creating session variables.
    else
    {
    session_start();
    $_SESSION["new_user_name"] =$new_user_name;
    $_SESSION["new_user_email"] =$new_user_email;
    $_SESSION["new_user_password"] =$new_user_password;

	// 	To protect MySQL injection 
    if($new_user_account_type==2)
    {
        header("location:signup-student/");
        $_SESSION["process_code"] ="vk_#*_stu_1";
	
    }
    elseif($new_user_account_type==1)
    {
        header("location:signup-contributer/");
        $_SESSION["process_code"] ="vk_#*_con_2";
    }
    }
?>