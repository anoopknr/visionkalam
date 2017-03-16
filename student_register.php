<?php
	// 	connecting database
	include_once ('include/config.php');
	include_once ('include/functions.php');
	
	// 	Define $myusername and $mypassword
    $student_name=$_POST['name'];
	$student_email=$_POST['email'];
	$student_password=$_POST['password'];
	
	// 	To protect MySQL injection 
    $student_name=validate_input($student_name);
	$student_email= validate_input($student_email);
	$student_password = validate_input($student_password);
	
	
	$sql="INSERT INTO Student_DB (student_name,student_email,student_password) VALUES ('$student_name','$student_email','$student_password')";
	$result=mysqli_query($conn,$sql);
    if($result)
    {
    session_start();
    $_SESSION["current_user"] = $student_email;
    echo 'Account Created  <a href="index.php"> Continue </a>';
    }
    else
    {
        echo ' Some Error Occured. <a href="index.php"> Continue </a>';
    }
?>