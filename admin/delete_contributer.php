<?php
include_once ('../include/config.php');
 session_start();
 if(!isset($_SESSION["authenticated"]))
            header('Location:./');
$id=$_GET['id'];
$query = "DELETE FROM `Contributer_DB` WHERE `Contributer_DB`.`contributer_unique_id` = '".$id."'";
$result = mysqli_query($conn,$query);
header("Location: contributer.php");
?>