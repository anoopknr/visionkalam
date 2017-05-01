<?php
include_once ('../include/config.php');
 session_start();
 if(!isset($_SESSION["authenticated"]))
            header('Location:./');
$id=$_GET['id'];
$query = "DELETE FROM `Student_DB` WHERE `Student_DB`.`student_unique_id` = '".$id."'";
$result = mysqli_query($conn,$query);
header("Location: users.php");
?>