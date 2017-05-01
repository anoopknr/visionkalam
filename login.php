<?php

// connecting database
include_once ('include/config.php');
include_once ('include/functions.php');

// Define $myusername and $mypassword
$new_user_email=$_POST['email'];
$new_user_password=$_POST['password'];

// To protect MySQL injection 
$new_user_email= validate_input($new_user_email);
$new_user_password = validate_input($new_user_password);

// Checking if it is a STUDENT ACCOUNT

$student_sql="SELECT * FROM Student_DB WHERE student_email='$new_user_email' and student_password='$new_user_password'";
$student_result=mysqli_query($conn,$student_sql);

// Mysql_num_row is counting table row
$student_count = mysqli_num_rows($student_result);

// Checking if it is a DONATOR ACCOUNT

$donater_sql="SELECT * FROM Contributer_DB WHERE contributer_email='$new_user_email' and contributer_password='$new_user_password'";
$donater_result=mysqli_query($conn,$donater_sql);

// Mysql_num_row is counting table row
$donater_count = mysqli_num_rows($donater_result);

if($student_count==1){
	session_start();
	$User_Details = mysqli_fetch_array($student_result);
	$_SESSION["current_user"] = $User_Details['student_unique_id'];
	$_SESSION["account_type"]= "student";
	header("location:index.php");
}
else if($donater_count==1){
	session_start();
	$User_Details = mysqli_fetch_array($donater_result);
	$_SESSION["current_user"] = $User_Details['contributer_unique_id'];
	$_SESSION["account_type"]= "donater";
	header("location:index.php");
}
else {
	session_start();
	session_unset();
	$_SESSION['error']=1;
	header("Location:index.php");

}
?>
