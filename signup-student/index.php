<?php

include_once ('../include/functions.php');

// signup-student.

session_start();
if(isset($_SESSION["process_code"]))
    {
	if($_SESSION["process_code"]=="vk_#*_stu_1")
	        {
		// 		connecting database
			include_once ('../include/config.php');
		include_once ('../include/functions.php');
		
		// 		Extra details collection
		    if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
			// 			Defining Database Variables.
			
			$student_name=$_SESSION["new_user_name"];
			$student_email= $_SESSION["new_user_email"];
			$student_password=$_SESSION["new_user_password"];
            // Post data
            $student_birth_year=$_POST['yob'];
            $student_state=$_POST['state'];
            $student_pin=$_POST['pin'];
            $student_school_address=$_POST['schoolAddress'];
			
			// 			To protect MySQL injection 
			$student_name=validate_input($student_name);
			$student_email= validate_input($student_email);
            $student_password = validate_input($student_password);
			$student_birth_year = validate_input($student_birth_year);
            $student_state= validate_input($student_state);
            $student_pin= validate_input($student_pin);
            $student_school_address = validate_input($student_school_address);
			//          Resetting session
			    session_unset();
			// 			destroy the session
			    session_destroy();
			
            if ($_FILES["profile_avatar"]["size"] < 700000)
            {
                $imagename=uniqid();
                move_uploaded_file($_FILES["profile_avatar"]["tmp_name"],'../avatars/'.$imagename.'.jpg');
            }
			$sql="INSERT INTO Student_DB (student_name,student_email,student_password,student_birth_year,student_state,student_pin,student_school_address,student_unique_id) VALUES ('$student_name','$student_email','$student_password',$student_birth_year,$student_state,$student_pin,'$student_school_address','$imagename')";
			$result=mysqli_query($conn,$sql);
			if($result)
			    {
				session_start();
				$_SESSION["current_user"] = $imagename;
                 $_SESSION["account_type"]= "student";
				echo 'Account Created  <a href="index.php"> Continue </a>';
			    }
			else
			    {
				echo ' Some Error Occured. <a href="index.php"> Continue </a>';
			    }
		    }
            else
            {
                echo'
                <html>
                <link rel="stylesheet" href="../css/style.css">
                <body>
                    <div class="blog_post">
                        <div class="blog_post-content">
                            <form action="'.$_SERVER['PHP_SELF'].'" method="post" name="studentExtraDetails" id="studentExtraDetails" enctype="multipart/form-data">
                                <h2 style="text-align:center;"> Student Registration </h2>
                                <h4 style="text-align:center;"> Enter Additional Informations </h4>
                                <br/>
                                <p>
                                    <label for="state"><b> Which State Your are Studing :</b> </label>
                                    <select name="state" form="studentExtraDetails">
                                   '.listStates().'
                                    </select>
                                </p>
                                <p>
                                    <label for="pin"> <b> School Pin Code : </b> </label>
                                    <input type="number" name="pin">
                                </p>
                                <p>
                                    <label for="yob"><b> Your Year of birth :</b> </label>
                                    <select name="yob" form="studentExtraDetails">
                                    '.listYear().'
                                    </select>
                                </p>
                                <p>
                                    <label for="content"><b>Select Profile Pic ( jpg image) :<b/><br /></label>
                                    <input type="file" name="profile_avatar" id="profile_avatar"  >
                                </p>
                                <p>
                                     <label for="schoolAddress"><b>School Address <b style="color:red;"> *** <b/> <b/>   </label>
                                    <textarea name="schoolAddress" id="schoolAddress" style="width:100%;" rows="6" placeholder="Enter Mailing Adress of School"></textarea>
                                </p>
                                <p>
                                    *** Very Important because Project support and other verifications are done through Your School.
                                </p>
                                <p>
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