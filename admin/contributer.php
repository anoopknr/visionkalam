<?php
//Step1
include_once ('../include/config.php');
?>

<html>
 <head>
 <title>Contributer</title>
 </head>
 <body>
 <h1>Contributer</h1>

<?php
$query = "SELECT * FROM Contributer_DB";
$result = mysqli_query($conn,$query);
$count = 1;
echo "<table border='1'>
<tr>
<th>No</th>
<th>Name</th>
<th>E mail</th>
<th>Unique Id</th>
</tr>";
while ($row = mysqli_fetch_array($result)) 
{
        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo '<td><a href="../donater-profile/index.php?donater='.$row[7].'">' . $row[1] . "</a></td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[7] . "</td>";
        echo "</tr>";
 $count=$count+1;
}
echo "</table>";
?>


</body>
</html>