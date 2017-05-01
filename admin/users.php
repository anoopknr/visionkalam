<?php
//Step1
 include_once ('../include/config.php');
 include_once ('dashboard.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

 <link rel="stylesheet" href="http://localhost/vk/css/admin_style.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
    <!-- [banner] -->
    <header id="banner">
        <hgroup>
            <h1>Users</h1>
        </hgroup>        
    </header>
 <?php
 session_start();
 if(!isset($_SESSION["authenticated"]))
            header('Location:./');
$query = "SELECT * FROM Student_DB";
$result = mysqli_query($conn,$query);
$count = 1;
echo "<table border='1'>
<tr>
<th>No</th>
<th>Name</th>
<th>E mail</th>
<th>Unique Id</th>
<th>Option</th>
</tr>";
while ($row = mysqli_fetch_array($result)) 
{
        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo '<td><a href="../student-profile/index.php?student='.$row[9].'">' . $row[1] . "</a></td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[9] . "</td>";
        echo '<td><a href="delete_user.php?id='.$row[9].'">Delete</a></td>';
        echo "</tr>";
 $count=$count+1;
}
echo "</table>";
?>
</body>
</html>
