<?php
$oldpass=$_POST['oldPassword'];
$newpass=$_POST['newPassword'];
session_start();
$id=$_SESSION['current_user'];
include('include/config.php');
if($_SESSION['account_type']=='student')
{
    $getPass=mysqli_query($conn,"SELECT student_password FROM Student_DB WHERE student_unique_id='$id'");
    $pass=mysqli_fetch_array($getPass);
    if($pass[0]==$oldpass)
    {
        $_SESSION['error']=4;
        $changePass=mysqli_query($conn,"UPDATE Student_DB set student_password='$newpass'  WHERE student_unique_id='$id'");
    }
    else
    {
         $_SESSION['error']=5;
    }
    header("Location:index.php");
}
if($_SESSION['account_type']=='donater')
{
    $getPass=mysqli_query($conn,"SELECT contributer_password FROM Contributer_DB WHERE contributer_unique_id='$id'");
    $pass=mysqli_fetch_array($getPass);
    if($pass[0]==$oldpass)
    {
        $_SESSION['error']=4;
        $changePass=mysqli_query($conn,"UPDATE Contributer_DB set contributer_password='$newpass'  WHERE contributer_unique_id='$id'");
    }
    else
    {
         $_SESSION['error']=5;
    }
    header("Location:index.php");
}
?>