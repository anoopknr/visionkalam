<?php
  include_once ("include/functions.php");
?>
<link rel="stylesheet" href="http://localhost/vk/css/user_style.css">
<div class="user">
    <div class="user_avatar">
        <?php
        echo '<img src="avatars/'.$_SESSION["current_user"].'.jpg"></img>';
?>
    </div>
    <div class="user_text">
        <h1 class="user_name">
            <?php
             getName($_SESSION["current_user"]);
if($_SESSION["account_type"]=="student")
             {
	echo '<h1 class="user_name" style="padding-top: 0px;font-size: 16px;line-height: 0px;">Projects : '.getProjects($_SESSION["current_user"]).' </h1>';
}
else
             {
	echo '<h1 class="user_name" style="padding-top: 0px;font-size: 16px;line-height: 0px;">Donations : '.getDonations($_SESSION["current_user"]).' </h1>';
}
?>
        </h1>
         <button style=" width : 89% ;background:#527ABE;" onclick="document.getElementById('changePassword').style.display='block'"> Change Password</button>
    </div>
</div>
 <div id="changePassword" class="modal">
                        <form class="modal-content animate" style="text-align:left;" id="changePassword" name="changePassword" action="resetPassword.php" onsubmit="return validateSignUp()" method="POST">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById('changePassword').style.display='none'" class="close" title="Close Window">&times;</span>
                            </div>
                            <div class="container">
                                <label><b>Old Password</b></label>
                                <input type="password" placeholder="Enter Old Password"  name="oldPassword" required>
                                <label><b>New Password</b></label>
                                <input type="password" placeholder="Enter New Password" minlength="3" name="newPassword" required>
                                <label><b>Retype Password</b></label>
                                <input type="password" placeholder="Retype Password" name="rePassword" required>
                                <p id="error"></p>
                                <input type="submit" name="submit" value="Change Password">
                                <br/>
                            </div>
                        </form>
                    </div>
     <script>
                     function validateSignUp() {
                         var pass1 = document.forms["changePassword"]["newPassword"].value;
                         var pass2 = document.forms["changePassword"]["rePassword"].value;
                         if (pass1 != pass2) {
                            document.getElementById("error").innerHTML = "Password Mismatch !";
                            document.getElementById("error").style.color = "RED";
                            return false;
                        }
                        else
                        {
                            document.getElementById("error").innerHTML = " ";
                        }
                    }
    </script>