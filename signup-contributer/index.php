<?php


// signup-contributer.

include_once ("../layout/head.php");
if(isset($_SESSION["process_code"]))
    {
	if($_SESSION["process_code"]=="vk_#*_con_2")
	        {
		// 		connecting database
			include_once ('../include/config.php');
		include_once ('../include/functions.php');
		
		// 		Extra details collection
		    if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
			// 			Defining Database Variables.
			
			$contributer_name=$_SESSION["new_user_name"];
			$contributer_email= $_SESSION["new_user_email"];
			$contributer_password=$_SESSION["new_user_password"];
            
            // Post data
            
            $contributer_job=$_POST['job'];
            $contributer_organization=$_POST['organization'];
			
			// 			To protect MySQL injection 
			$contributer_name=validate_input($contributer_name);
			$contributer_email= validate_input($contributer_email);
            $contributer_password = validate_input($contributer_password);
			$contributer_job = validate_input( $contributer_job);
            $contributer_organization= validate_input($contributer_organization);

			//          Resetting session
			    session_unset();
			// 			destroy the session
			    session_destroy();
			
            if ($_FILES["profile_avatar"]["size"] < 700000)
            {
                $imagename=uniqid();
                move_uploaded_file($_FILES["profile_avatar"]["tmp_name"],'../avatars/'.$imagename.'.jpg');
            }
			$sql="INSERT INTO Contributer_DB(contributer_name,contributer_email,contributer_password,contributer_job,contributer_organization,contributer_unique_id) VALUES ('$contributer_name','$contributer_email','$contributer_password','$contributer_job','$contributer_organization','$imagename')";
			$result=mysqli_query($conn,$sql);
			if($result)
			    {
				session_start();
				$_SESSION["current_user"] = $imagename;
                $_SESSION["account_type"]= "donater";
				echo 'Account Created  <a href="index.php"> Continue </a>';
			    }
			else
			    {
                    echo("Error description: " . mysqli_error($result));
				echo ' Some Error Occured. <a href="index.php"> Continue </a>';
			    }
		    }
            else
            {
                echo'
                <html>
                <link rel="stylesheet" href="../css/project_style.css">
                <body>
                    <div class="project_post">
                        <div class="project_post-content">
                            <form action="'.$_SERVER['PHP_SELF'].'" method="post" name="contributerExtraDetails" id="contributerExtraDetails" enctype="multipart/form-data">
                                <h2 style="text-align:center;"> Donater Registration </h2>
                                <h4 style="text-align:center;"> Enter Additional Informations </h4>
                                <br/>
                                <p>
                                    <label for="job"> <b> Your Profession : </b> </label>
                                    <input type="text" name="job">
                                </p>
                                <p>
                                    <label for="organization"> <b> Your Organization Name : </b> </label>
                                    <input type="text" name="organization">
                                </p>
                                <p>
                                    <label for="content"><b>Select Profile Pic ( jpg image) :<b/><br /></label>
                                    <input type="file" name="profile_avatar" id="profile_avatar"  >
                                </p>
                                    <input type="submit" value="Register Now  :)" name="submit">
                                </p>
                            </form>
                        </div>
                    </div>
                </body>

                </html>
                
                ';
            }
	}
	else
	    {
		header("location:../");
	}
}
else
    {
	header("location:../");
}

?>