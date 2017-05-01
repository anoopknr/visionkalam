<?php
 session_start();
 if(!isset($_SESSION["authenticated"]))
            header('Location:./');
if(!isset($_GET['donation_id']))
    {
        header('Location:volunter.php');
    }
include_once ('../include/config.php');
$donation_id=$_GET['donation_id'];
$pending_projects_Sql="SELECT post_id,contributer_id,student_id FROM Donation_Process_DB WHERE donation_id=$donation_id";
$pending_projects_Result=mysqli_query($conn,$pending_projects_Sql);
$pending_projects_details = mysqli_fetch_array($pending_projects_Result);
$project_id=$pending_projects_details['post_id'];
$student_id=$pending_projects_details['student_id'];
$contributer_id=$pending_projects_details['contributer_id'];

$donate=mysqli_query($conn,"INSERT INTO Donated_Projects_DB(donation_id,contributer_id,post_id,student_id) VALUES ($donation_id,$contributer_id,$project_id,$student_id)");

$set_project_sql="UPDATE `Post_DB` SET `post_status` = 2 WHERE `Post_DB`.`post_id` = ".$project_id;
$set_project=mysqli_query($conn,$set_project_sql);

$set_donator_sql="UPDATE `Contributer_DB` SET `contributer_supported_projects` = `contributer_supported_projects`+1 WHERE `Contributer_DB`.`contributer_id` = ".$contributer_id;
$set_donator=mysqli_query($conn,$set_donator_sql);

$reset_pending_sql="DELETE FROM `Donation_Process_DB` WHERE `Donation_Process_DB`.`donation_id` = ".$donation_id;
$reset_pending=mysqli_query($conn,$reset_pending_sql);
header("Location:verification.php");
?>
