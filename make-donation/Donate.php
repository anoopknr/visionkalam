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

    $post_id=$_SESSION['post_id'];
    $user=$_SESSION["current_user"];

    $Contributer_Results = mysqli_query($conn,"SELECT contributer_id FROM Contributer_DB WHERE contributer_unique_id='$user'");
    $Contributer_Details = mysqli_fetch_array($Contributer_Results);
    $contributer_id=$Contributer_Details['contributer_id'];
    
    $Project_Results = mysqli_query($conn,"SELECT student_id FROM Post_DB WHERE post_id=$post_id");
    $Project_Details = mysqli_fetch_array($Project_Results);
    $student_id=$Project_Details['student_id'];
    
    $address=$_POST['donater_address'];

     $sql="INSERT INTO Donation_Process_DB (student_id,contributer_id,post_id,donation_address) VALUES ($student_id,$contributer_id,$post_id,'$address')";
		 
     $result=mysqli_query($conn,$sql);
			if($result)
			    {
            $Lock_post = mysqli_query($conn,"UPDATE `Post_DB` SET `post_status` = 1 WHERE `Post_DB`.`post_id` = ".$post_id);
				    echo '<body>
                  <h2> Your Donation is registered :) <br> Our volunters will  contact you soon </h2>
                  </body>
                  </html> ';
			    }
			else
			   echo '<body>
               <h2> There Was a Bug :( </h2>
               </body>
               </html> ';
?>

