<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Vision Kalam</title>

    <link rel="shortcut icon" href="images/favicon.png">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="http://localhost/vk/css/head_style.css">


</head>

<body>
    <header>
        <div class="vk_title">
            <a href="http://localhost/vk">
                <h1>Vision Kalam</h1>
            </a>
        </div>
        <div class="vk_menu">
<?php
    session_start();
    if(!isset($_SESSION["current_user"]))
    {
            echo '
                    <a href="http://localhost/vk" class="vk_menu_list">Home</a>
                    <a href="#howItWorks" class="vk_menu_list">How It Works</a>
                    <a href="#aboutUs" class="vk_menu_list">About</a> 
                    <a onclick="document.getElementById(\'login_form\').style.display=\'block\'" class="vk_menu_list" style="float: right; margin-right: 50px">Login</a>
                    <a onclick="document.getElementById(\'sign_up_form\').style.display=\'block\'" class="vk_menu_list" style="float: right; margin-right: 50px">Sign Up</a>
                ';
    }
    else
    {
        $user=$_SESSION["current_user"];
        $type=$_SESSION["account_type"];
            echo '
                    <a href="http://localhost/vk" class="vk_menu_list">Home</a>
                    <a href="#howItWorks" class="vk_menu_list">How It Works</a>
                    <a href="#aboutUs" class="vk_menu_list">About</a>
                    <a href="http://localhost/vk/'.$type.'-profile/index.php?'.$type.'='. $user.'" class="vk_menu_list" > My Profile </a> 
                 ';
             if($_SESSION["account_type"]=="student")
             {
                echo '<a href="http://localhost/vk/new-project/" class="vk_menu_list">Post a Poject</a>';
             }
            echo '
                    <a href="http://localhost/vk/include/logout.php" class="vk_menu_list" style="float: right; margin-right: 50px">Log Out</a>
                ';
    }
?>            
        </div>
    </header>
<?php
    // FORMS 
    if(!isset($_SESSION["current_user"]))
    {
            echo '
                <link rel="stylesheet" href="http://localhost/vk/css/form_style.css">
                 <!- Login Form  ->

                    <div id="login_form" class="modal">

                    <form class="modal-content animate" name="login" action="http://localhost/vk/login.php" method="POST">
                         <div class="imgcontainer">
                            <span onclick="document.getElementById(\'login_form\').style.display=\'none\'" class="close" title="Close Window">&times;</span>
                        </div>

                        <div class="container">
                            <label><b>Email ID</b></label>
                            <input type="email" placeholder="Enter Email ID" name="email" id="email" required>
                            <label><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="password" id="password" required>
                            <button type="submit">Login</button>
                        </div>
                    </form>
                    </div>

                    <!- Sign Up Form  ->

                    <div id="sign_up_form" class="modal">
                        <form class="modal-content animate" name="signup" action="http://localhost/vk/register.php" onsubmit="return validateSignUp()" method="POST">
                            <div class="imgcontainer">
                                <span onclick="document.getElementById(\'sign_up_form\').style.display=\'none\'" class="close" title="Close Window">&times;</span>
                            </div>
                            <div class="container">
                                <label><b>Full Name</b></label>
                                <input type="text" placeholder="Enter Full Name" name="name" required>
                                <label><b>Email</b></label>
                                <input type="email" placeholder="Enter Email" name="email" required>
                                <label><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" required>
                                <label><b>Repeat Password</b></label>
                                <input type="password" placeholder="Repeat Password" name="re-password" required>
                                <label><b>Account Type :</b></label>
                                <input type="radio" name="acc_type" value="1"> Contributer <input type="radio" name="acc_type" value="2" checked> Student<br>
                                <p id="error"> </p>
                                <button type="submit">Sign Up</button>
                                <br/>
                                <p> By signing up you agree our terms and conditions.</p>
                            </div>
                        </form>
                    </div>

                      <!- Validate Function to validate Signup form  ->

                  <script>
                     function validateSignUp() {
                         var pass1 = document.forms["signup"]["password"].value;
                         var pass2 = document.forms["signup"]["re-password"].value;
                         if (pass1 != pass2) {
                            document.getElementById("error").innerHTML = "Password Mismatch !";
                            document.getElementById("error").style.color = "RED";
                            return false;
                        }
                    }
                  // Get the form
                    var login = document.getElementById(\'login_form\');
                    var signup = document.getElementById(\'sign_up_form\');

                  // When the user clicks anywhere outside of the form, close it
                     window.onclick = function(event) {
                        if (event.target == login || event.target == signup) {
                            login.style.display = "none";
                             signup.style.display = "none";
                          }
                      }       
                    </script>
                ';
    }
?>
</body>

</html>