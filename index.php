<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Vision Kalam</h2>
<?php
    session_start();
    if(!isset($_SESSION["current_user"]))
    {
    echo ' not logged in.';
    include("layout/login_signup.html");
    include("filterBlogs.php");
    }
     else
    {
    echo ' logged in.';
    include("layout/log_out.html");
    $user=$_SESSION["current_user"];
    $type=$_SESSION["account_type"];
    echo  'Current User : '.$user;
    echo '<a href="'.$type.'-profile/index.php?'.$type.'='. $user.'"> <button style="width:auto;float: right;margin-right: 50px">My Profile</button></a>';
    include("filterBlogs.php");
    }
?>

   

</body>

</html>