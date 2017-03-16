<?php

// connecting database
include_once ('include/config.php');
include_once ('include/functions.php');

// Define $myusername and $mypassword
$student_email=$_POST['email'];
$student_password=$_POST['password'];

// To protect MySQL injection 
$student_email= validate_input($student_email);
$student_password = validate_input($student_password);


$sql="SELECT * FROM Student_DB WHERE student_email='$student_email' and student_password='$student_password'";
$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
session_start();
$_SESSION["current_user"] = $student_email;
header("location:index.php");
}
else {
echo "Wrong Username or Password";
session_start();
session_unset();
// destroy the session
session_destroy(); 
}
?>