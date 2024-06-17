<?php
session_start();
if (isset($_SESSION['ActiveUser'])) {
    header("location: profile.php");
}

$m1 = "";
$m2 = "";
if(isset($_POST['signin'])){
    try{
        $user = $_POST['username'];
        $password = $_POST['password'];
        
        $e1 = "/^[a-zA-Z0-9_]{3,20}$/";
        $e2 = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%*-])[A-Za-z0-9_#@%*-]{8,20}$/";
        if(!preg_match($e1, $user)){
            $m1 = "Invalid Username";
        }
        else if(!preg_match($e2, $password)){
            $m2 = "Invalid Password";
        }
        else{
            require('connection.php');
            $sql = "select * from user where username = '$user'";
            $rs = $db -> query($sql);
            if($row = $rs -> fetch()){
            if(password_verify($password, $row['password'])){
                $_SESSION['ActiveUser']=$user;
                header('Location: home.html');
                die();
            }
            else 
            $m2 = "Invalid Password";
            }
            else 
            $m1 = "Invalid Username";
        }

        $db = null;
    }
    catch(PDOException $e){
        die("Error: " .$e -> getMessage());
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
    <link rel="stylesheet" href="signin.css">   

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
            <h1>Welcome to QuizMe</h1>
            <form method="post">
                <h2>Sign in</h2>
                <br>
                <div class="inputwrapper">
                    <label for="username">Username: </label><br>
                    <input id="username" type="text" name="username" placeholder="Username">
                    <p align="center" style="color:red;"> <?php echo $m1 ?> </p>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="password">Password: </label><br>
                    <input id="password" type="password" name="password" placeholder="Password">
                    <p align="center" style="color:red;"> <?php echo $m2 ?> </p>
                </div>
                <br>
                <input type="submit" value="Sign in" name="signin">
            </form>
            <h5>New to QuizMe? <a href="signup.php">Join now</a></h5>
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