<?php
session_start();

// Checking login status.
if(!isset($_SESSION["current_user"]))
{
		header("location:./");	
}

// Including Files.
include_once ('config.php');
include_once ('functions.php');

// Student Details From DB

$current_user=$_SESSION['current_user'];
$cur_User_Sql="SELECT student_name,student_id FROM Student_DB WHERE student_unique_id='$current_user'";
$cur_User_Result=mysqli_query($conn,$cur_User_Sql);
$cur_User_Details = mysqli_fetch_array($cur_User_Result);
$s_User_ID= $cur_User_Details['student_id'];
$s_User_Name=$cur_User_Details['student_name'];

// Getting details of Project Poster From POST Method.

$U_sub=$_POST['subject'];
$U_content=$_POST['content'];
$U_requirement=$_POST['requirement'];

// Project Directory Setting UPDATE

$U_sub=validate_input($U_sub);

$directory_name=str_replace(' ','-',$U_sub).'_'.uniqid();
$target_dir = '../post/'.$directory_name;
$target_url =$_SERVER['SERVER_NAME'].'/vk/post/'.$directory_name;
$target_file = basename($_FILES["planImage"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

mkdir($target_dir);
mkdir($target_dir.'/img');

// IMAGE UPLOAD BLOCK STARTS

if(isset($_POST["submit"])) {	
	$check = getimagesize($_FILES["planImage"]["tmp_name"]);
		if($check !== false)
		 {
			$uploadOk = 1;
		 }
		else {
			echo "File is not an image.";		
		    $uploadOk = 0;		
			}
	
	}

if ($_FILES["planImage"]["size"] > 700000)
 {	
	echo "Sorry, your file is too large.";	
	$uploadOk = 0;	
 }

// Allow certain file formats
if($imageFileType != "jpg")
 {	
	echo "Sorry, only JPG is allowed.";
	$uploadOk = 0;	
 }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1)
 {
	if (move_uploaded_file($_FILES["planImage"]["tmp_name"],$target_dir.'/img/image.jpg')) 
	{
	// 		echo "The file ". basename( $_FILES["planImage"]["name"]). " has been uploaded.";		
	}
	else {		
		echo "Sorry, there was an error uploading your file.";
		}
	
}

// Insering to DB

$sql="INSERT INTO Post_DB (post_subject,post_link,student_id) VALUES ('$U_sub','$target_url',$s_User_ID)";
$result=mysqli_query($conn,$sql);

$cur_User_Sql="SELECT post_id FROM Post_DB WHERE post_subject='$U_sub' ORDER BY post_date DESC LIMIT 1";
$cur_User_Result=mysqli_query($conn,$cur_User_Sql);
$Post_Details = mysqli_fetch_array($cur_User_Result);
$Post_Token=$Post_Details['post_id'];

// Creating Project index.php 

$writeblog=fopen($target_dir.'/index.php','w');
fwrite($writeblog,'<?php 
				    include_once ("../../layout/head.php");
				    ?>
					<h1 style="color: #e91e63;">'.$U_sub.'</h1>
					<br>
					<img src="img/image.jpg" alt="Plan Image" width="800" height="500">
					<br/>
					<h2>Explanation</h2>
					<br/>
					<h3>'.nl2br($U_content).'<br/>
					<h2>Requirements</h2>
					<br/>'.nl2br($U_requirement).'</h3>
					<br/>
					<h6> Posted by :<a href="../../student-profile/index.php?student='.$current_user.'">'.$s_User_Name.'</a></h6>
				    <?php
 				    include_once ("../../include/config.php");  
 				    $Post_token='.$Post_Token.';
 				    $result = mysqli_query($conn,"UPDATE `Post_DB` SET `post_views` = `post_views`+1 WHERE `Post_DB`.`post_id` = ".$Post_token);
 				    $Lock_post = mysqli_query($conn,"SELECT post_status FROM Post_DB WHERE post_id=$Post_token");
				    $Lock_details=mysqli_fetch_array($Lock_post);
				    $Lock=$Lock_details["post_status"];
				    if(isset($_SESSION["current_user"])&& $Lock==0)
					 {
     				 	 if($_SESSION["account_type"]=="donater")
    				 		 {
        					 echo "<link rel=\'stylesheet\' href=\'../../css/project_style.css\'>";
        					 echo "<form class=\'modal-content animate\' name=\'donation\' action=\'http://localhost/vk/make-donation\' method=\'POST\'>";
        					 $_SESSION["post_id"]=$Post_token;
        					 echo "<input type=\'submit\' value=\'Donate Now\' style=\'width : 50%;\' name=\'submit\'></form>";
    						 }
 						 }
					include_once ("../../layout/footer.php");
					 ?>');
fclose($writeblog);
header("location: ".$target_dir);

?>

