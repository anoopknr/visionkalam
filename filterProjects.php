<!DOCTYPE html>
<html>

<head>
    <style>
        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 24%;
            overflow:hidden;
        }
        
        div.gallery:hover {
            border: 1px solid #777;
        }
        
        div.gallery img {
            width: 100%;
            height: auto;
        }
        img:hover{
             filter: grayscale(100%);
             transform: scale(1.2);
             transition: all .5s;
        }
        
        div.desc {
            padding: 15px;
            text-align: center;
        }
        div.blog
        {
            width: 100%;
            display : table;
        }
    </style>
</head>

<body>
<div class="blog">

<?php
    
// Including Files.
include_once ('include/config.php');
echo '<h2> Recent Projects</h2>';
$result = mysqli_query($conn,"SELECT * FROM Post_DB ORDER BY post_date DESC LIMIT 4");
while($row = mysqli_fetch_array($result))
{
echo '<div class="gallery">';
echo '<a target="_blank" href="http://' . $row['post_link'] . ' ">';
echo '<img src="http://' . $row['post_link'] . '/img/image.jpg" alt="' . $row['post_subject'] . ' " width="300" height="200"></a>';
echo '<div class="desc">' . $row['post_subject'] . ' </div></div>';
}
echo '<h2> Most Viewed Projects</h2>';
$most_view = mysqli_query($conn,"SELECT * FROM Post_DB ORDER BY post_views DESC LIMIT 4");
while($row2 = mysqli_fetch_array($most_view))
{
echo '<div class="gallery">';
echo '<a target="_blank" href="http://' . $row2['post_link'] . ' ">';
echo '<img src="http://' . $row2['post_link'] . '/img/image.jpg" alt="' . $row2['post_subject'] . ' " width="300" height="200"></a>';
echo '<div class="desc">' . $row2['post_subject'] . ' </div></div>';
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<content>
<h2>All Projects <h2>
</content>
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