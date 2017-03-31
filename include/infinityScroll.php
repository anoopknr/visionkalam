<?php
$skip=$_GET['count'];
// Including Files.
include_once ('config.php');
$result = mysqli_query($conn,"SELECT * FROM Post_DB ORDER BY post_date DESC");
$count = mysqli_num_rows($result);
global $blog;
for($i=1; $skip<$count && $i<$skip ;$i++)
    $row = mysqli_fetch_array($result);

$row = mysqli_fetch_array($result);
$blog='<div class="gallery">'.'<a target="_blank" href="http://' . $row['post_link'] . ' ">'.'<img src="http://' . $row['post_link'] . '/img/image.jpg" alt="' . $row['post_subject'] . ' " width="300" height="200"></a>'.'<div class="desc">' . $row['post_subject'] . ' </div></div>';
if($skip<$count)
    echo $blog;
?>