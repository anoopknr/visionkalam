<?php
	
	// Project-creation code	
	
    session_start();
    // Checking login status.
    if(!isset($_SESSION["current_user"]))
    {
      header("location:../");
    }
    // throw out if it is not a Student Access.
    else if($_SESSION["account_type"]!="student")
    {
      header("location:../");
    }
?>
<!DOCTYPE html>
<html> 
<link rel="stylesheet" href="../css/style.css">
<body>
<div class="blog_post">
<div class="blog_post-content">
<form action="../include/makePost.php" method="post" enctype="multipart/form-data">
<h2 style="text-align:center;"> Post New Project </h2>
<br/>
 <p>
    <label for="subject"> Enter The Subject of Your Project* : </label>
  </p>
  <p>
    <input type="text" name="subject" id="subject" placeholder="Enter Your Project Subject." />
  </p>
  <p>
    <label for="content">Explain Your Project* :<br />
      <br />
    </label>
    <textarea name="content" id="content" style="width:100%;" rows="10" placeholder="Explain Your Project."></textarea>
  </p>
  <p>
    <label for="requirement">Requirements as Support* :<br />
      <br />
    </label>
    <textarea name="requirement" id="requirement" style="width:100%;" rows="4" placeholder="Enter Requirements."></textarea>
  </p>
  <p>
    <label for="content">Submit Image Plan of Your Project (800*500 jpg image)* :<br />
      <br />
    </label>
    <input type="file" name="planImage" id="planImage" >
    <input type="submit" value="Post Blog" name="submit">
    </p>
</form>
</div>
</div>
</body>
</html>

