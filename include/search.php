<?php
$key=$_GET['q'];
// Including Files.
include_once('config.php');
$result = mysqli_query($conn,"SELECT post_subject,post_link FROM Post_DB WHERE post_subject LIKE '%$key%' LIMIT 7");
global $sug; 
$count = mysqli_num_rows($result);
if($count == 0)
{
     $sug="<a class='search' > No Project Found </a>";
}
else{
    while($row = mysqli_fetch_array($result))
    {
        $sug=$sug.'<a class="search" href="http://'.$row[1].'">'.$row[0].'</a>';
    }
}
    echo $sug;
?>
