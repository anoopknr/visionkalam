<!DOCTYPE html>
<html>

<head>
    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 23.5%;
            overflow:hidden;
        }
        
        div.gallery:hover {
            border: 1px solid #777;
        }
        
         div.imgholder
         {  
             width: 100%;
            height: 150px;
            overflow:hidden;
         }
        div.gallery img {
            width: 100%;
            height: 150px;
        }
        div.gallery img:hover{
             filter: grayscale(100%);
             transform: scale(1.2);
             transition: all .5s;
        }
        
        div.desc {
            padding: 15px;
            text-align: center;
            background:#E8EEF1;
            font-weight:800;
        }
        div.blog
        {
            width: 100%;
            display : table;
        }
        div.feeds
        {
            width: 28%;
            display : block;
            /*background-color:red;*/
            float : right;
            height : 500px;
            margin-right:1%;
            text-align:center;
        }
        div.blocks
        {
            width: 68%;
            display : block;
            background-color:#F3F3F3;
            float : left;
            margin-left:1%;
            border: 1px solid #dedede; 
            margin-top:25px;
            padding:5px 0px 10px 0px;
            box-shadow: 2px 2px 5px rgba(0,0,0,.1);
            text-align:center;
         }
    </style>
</head>

<body>
<link rel="stylesheet" href="http://localhost/vk/css/message_style.css">
<link rel="stylesheet" href="http://localhost/vk/css/form_style.css">
<div class="blog">
<div class="feeds">
<?php
 if(isset($_SESSION['current_user']))
    {
        include_once('layout/info.php');
    }
?>
<h2>Questions </h2>
<?php
    include('include/config.php');
    $result = mysqli_query($conn,"SELECT * FROM Student_DB WHERE student_id IN (SELECT student_id FROM Questions_DB WHERE question_id IN (SELECT question_id FROM Answers_DB)) LIMIT 5");
    while($row = mysqli_fetch_array($result))
    {
		$tempsid=$row['student_id'];
		$tempresult=mysqli_query($conn,"SELECT question_id FROM Questions_DB WHERE student_id=$tempsid");
		$qid=mysqli_fetch_array($tempresult);
         echo '<div class="message" style="  box-shadow: 2px 2px 5px rgba(0,0,0,.1);background-color:#F1F8EE; border: 1px solid #dedede;width:99% ; padding : 5px">
  <div class="message_body">
    <p style="color : #3C7648;"><a href ="./student-profile/?student='.$row['student_unique_id'].'">'.$row['student_name'].'</a>\'s Dream to Become <br/> '.$row['student_dream_job'].' at '.$row['student_dream_company'].' </p>
    <button style=" width : 200px; float: right;background:#527ABE; margin-right : 10px;"onclick="window.location.href=\'./questions/index.php?question_no='.$qid['question_id'].'\'"> View Replays</button>
  </div>
  </div>';
       
    }
?>
</div>

<?php
    
// Including Files.
echo '<div class="blocks">';
include('layout/search.html');

echo '</div> <div class="blocks" >';
include('include/config.php');
echo '<h2> Recent</h2>';
$result = mysqli_query($conn,"SELECT * FROM Post_DB   ORDER BY post_date DESC LIMIT 4");
while($row = mysqli_fetch_array($result))
{
echo '<div class="gallery">';
echo '<a target="_blank" href="http://' . $row['post_link'] . ' ">';
echo '<div class="imgholder"><img src="http://' . $row['post_link'] . '/img/image.jpg" alt="' . $row['post_subject'] . ' " width="300" height="200"></a></div>';
echo '<div class="desc">' . $row['post_subject'] . ' </div></div>';
}
echo '</div><div  class="blocks">';
echo '<h2> Most Viewed</h2>';
$most_view = mysqli_query($conn,"SELECT * FROM Post_DB  ORDER BY post_views DESC LIMIT 4 ");
while($row2 = mysqli_fetch_array($most_view))
{
echo '<div class="gallery">';
echo '<a target="_blank" href="http://' . $row2['post_link'] . ' ">';
echo '<div class="imgholder"><img src="http://' . $row2['post_link'] . '/img/image.jpg" alt="' . $row2['post_subject'] . ' " width="300" height="200"></a></div>';
echo '<div class="desc">' . $row2['post_subject'] . ' </div></div>';
}
echo '</div><div class="blocks">';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<content>
<h2>All Projects <h2>
</content>
</div>
<script>
// Infinity Scroll 
var count=8; // Start blocks count
var i = 1;
$(document).ready(function() {
    for (; i <= count; i++) {
        $.get("include/infinityScroll.php",{count:i}, function(data, status){
            $(data).appendTo('content');
            });
    }
    // scroll
    $(window).scroll(function() {
        var scrollH = $(window).scrollTop() + $(window).height();
        var documentH = $(document).height();
        if (scrollH == documentH) {
                 count=count+4;
            for (; i <= count; i++) {
                 $.get("include/infinityScroll.php",{count:i}, function(data, status){
                  $(data).appendTo('content');
        });
             }
        }
    });


});
</script>
</div>
</body>

</html>
