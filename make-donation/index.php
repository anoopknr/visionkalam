<?php
	
	  // Donation Process
    include_once ("../layout/head.php");
   // Checking login status.
    if(!isset($_SESSION["current_user"]) || !isset($_SESSION['post_id']) )
    {
      header("location:../");
    }
    // throw out if it is not a Student Access.
    else if($_SESSION["account_type"]!="donater")
    {
      header("location:../");
    }
     include_once ("../include/config.php");
?>
<link rel="stylesheet" href="../css/project_style.css">
<body>
<div class="project_post">
<div class="project_post-content">
<form action="Donate.php" method="post">
<h2 style="text-align:center;"> One Step Donation </h2>
<br/>
  <?php
  // Project Details
  $post_id=$_SESSION['post_id'];
  $Project_Results = mysqli_query($conn,"SELECT post_subject,student_id FROM Post_DB WHERE post_id=$post_id");
  $Project_Details = mysqli_fetch_array($Project_Results);
  $Project_name=$Project_Details['post_subject'];
  $student_id=$Project_Details['student_id'];
    // Student_Details
  $Student_Sql="SELECT student_state,student_name,student_email,student_school_address FROM Student_DB WHERE student_id='$student_id'";
  $Student_Result=mysqli_query($conn,$Student_Sql);
  $Student_Details = mysqli_fetch_array($Student_Result);
  $name=$Student_Details['student_name'];
  $email=$Student_Details['student_email'];
  $address=nl2br($Student_Details['student_school_address']);

  echo '<p><b> Project Name : '.$Project_name.'</b></p>';
  echo '<p><b> Student Name : '.$name.'</b></p>';
  echo '<p><b> Email ID     : '.$email.'</b></p>';
  echo '<p><b> Student Address <br> '. $address.'</b></p><br>';
  ?>
   <p>
    <label for="requirement"><b>Enter the address to collect product</b><br />
      <br />
    </label>
    <textarea name="donater_address" id="donater_address" style="width:100%;" rows="4" placeholder="Enter Your Address"></textarea>
  </p>
      <input type="submit" value="Make Donation :)" name="submit">
    </p>
</form>
</div>
</div>
</body>
</html>

