<?php
    $m1 = "";
    $m2 = "";
    $m3 = "";
if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['msg'];
    $e1 = "/^[A-Za-z\s]{3,25}$/";
    $e2 = "/^[A-Za-z0-9._-]+@[A-Za-z0-9-]+\.[a-zA-Z.]{2,5}$/";
    $e3 = "/^[A-Za-z0-9,.?!\s]{3,300}$/";

    if(!preg_match($e1, $name) || $name == ""){
        $m1 = "Invalid Name";
    }
    else if(!preg_match($e2, $email) || $email == ""){
        $m2 = "Invalid Email";
    }
    else if(!preg_match($e3, $message) || $message == ""){
        $m3 = "Invalid Message";
    }
    else {
        $recipient = "quizme@gmail.com";
        $subject = "Message";
        $content= $message;
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        echo "<h4 align='center' style='color:white;'>Email sent!</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="contact.css">   

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <nav>
                <div class="logo">
                    <img src="logo.png" alt="logo">
                </div>

                <div class="navigation">
                    <div class="navBtn"><a href="home.html">Home</a></div>
                    <div class="navBtn"><a href="createQuiz.php">Create</a></div>
                    <div class="navBtn"><a href="searchbox.html">Search</a></div>
                    <div class="navBtn"><a href="contact.php">Contact</a></div>
                </div>
                
                <div class="log">
                    <div class="signBtn"><a href="signup.php">Sign up</a></div>
                    <div class="signBtn"><a href="signin.php">Sign in</a></div> 
                    <div class="signBtn" onclick="location.href='profile.php';" style="cursor: pointer;"> </div>
                </div>

                <div class="tablet-wrapper">
                    <img src="burgermenu.svg" alt="tablet Menu Icon" style="width: 40px;" class="burgermenu">

                    <div class="tablet-nav">
                        <div class="tabBtn"><a href="home.html">Home</a></div>
                        <div class="tabBtn"><a href="createQuiz.php">Create</a></div>
                        <div class="tabBtn"><a href="searchbox.html">Search</a></div>
                        <div class="tabBtn"><a href="contact.php">Contact</a></div>
                        <div class="tabBtn"><a href="signin.php">Sign in</a></div>
                        <div class="tabBtn"><a href="signup.php">Sign up</a></div>
                        <div class="tabBtn"><a href="profile.php">Profile</a></div>
                    </div>
                </div>
        </nav>

        <main>
            <h1>Contact Us</h1>
            <form method="post">
                <div class="inputwrapper">
                    <label for="name">Name: </label><br>
                    <input id="name" type="text" name="name" placeholder="Name">
                    <p align="center" style="color:red;"> <?php echo $m1 ?> </p>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="email">Email: </label><br>
                    <input id="email" type="text" name="email" placeholder="Email">
                    <p align="center" style="color:red;"> <?php echo $m2 ?> </p>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="msg">Message: </label><br>
                    <input id="msg" type="text" name="msg" placeholder="Message...">
                    <p align="center" style="color:red;"> <?php echo $m3 ?> </p>
                </div>
                <br>
                <input type="submit" value="Send" name="send">
            </form>
        </main>
       
       <footer>
        <div class="footer1">
            <div class="footerLogo">
                <img src="logo.png" alt="logo">
            </div>
            <div class="footerContent">
                <h3>Quick Access</h3>
                <h4><a href="home.html">Home</a></h4>
                <h4><a href="createQuiz.php">Create Quiz</a></h4>
                <h4><a href="searchbox.html">Search</a></h4>
                <h4><a href="contact.php">Contact</a></h4>
            </div>
            <div class="footerContent">
                <h3>Join Us</h3>
                <h4><a href="signin.php">Sign in</a></h4>
                <h4><a href="signup.php">Sign Up</a></h4>
            </div>
            <div class="footerContent">
                <h3>Follow Us</h3>
                <h4>
                    <i class="fa-brands fa-square-instagram"></i>
                    <i class="fa-brands fa-square-snapchat"></i>
                    <i class="fa-brands fa-square-twitter"></i>
                    <i class="fa-brands fa-square-facebook"></i>
                </h4>
            </div>
        </div>
        <div class="footer2">
            <p>&copy; 2023 QuizMe All Rights Reserved</p>
        </div>
       </footer>
        
    </div>  

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="burgermenu.js"></script>

</body>
</html>