<?php
    if ( !($_SERVER['REQUEST_METHOD'] == 'POST') )
         header("location:./");
	// 	connecting database
	
	// 	Define $myusername and $mypassword

    $new_user_name=$_POST['name'];
	$new_user_email=$_POST['email'];
	$new_user_password=$_POST['password'];
    $new_user_account_type=$_POST['acc_type'];

    // creating session variables.

    session_start();
    $_SESSION["new_user_name"] =$new_user_name;
    $_SESSION["new_user_email"] =$new_user_email;
    $_SESSION["new_user_password"] =$new_user_password;

	// 	To protect MySQL injection 
    if($new_user_account_type==2)
    {
        header("location:signup-student/");
        $_SESSION["process_code"] ="vk_#*_stu_1";
	
    }
    elseif($new_user_account_type==1)
    {
        header("location:signup-contributer/");
        $_SESSION["process_code"] ="vk_#*_con_2";
    }
?>