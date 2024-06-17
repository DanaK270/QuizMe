<?php
require('check.php');
$change=0;
    try{
        $uusername=$_SESSION['ActiveUser'];
        if(isset($_POST['btn'])){
            $password = $_POST['password'];
            $e2 = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%*-])[A-Za-z0-9_#@%*-]{8,20}$/";
            if(!preg_match($e2, $password)){
                echo "<h4 h4 align='center';>Invalid Password</h4>";
            }
            else if($_POST['password'] != $_POST['password2'])
                echo "<h4 h4 align='center';>Passwords do not match</h4>";
            else{
                require('connection.php');
                $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql=("UPDATE user SET password='$hashPassword' WHERE username='$uusername' " );
                $stmt = $db ->exec($sql);
                $change=1;   
            }
        }
        $db = null;
    }
    catch(PDOException $e){
        die("Error: " .$e -> getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="signin.css"> 
    <link rel="stylesheet" href="signup.css"> 
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>

<style>
input[type=submit]{
    text-decoration: none;
    color: white;
    font-size: 1 rem;
    background-color: rgb(98, 184, 189);
    border-radius: 5px;
    padding: 7px 15px;
    margin-left:10px;
    margin-top: 10px;
    border:none;
    min-width:4rem;
}

input[type=submit]:hover {
    background-color:  rgb(78, 164, 169);
    transition-duration: 0.3s;
}
</style>
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
            <?php if ($change==0){?>
            <form method="post" >
                <div class="inputwrapper">
                    <label for="password">Password: </label>
                    <input id="password" type="password" name="password" placeholder="Password">
                    <small>Error message</small>
                    <p>*Password must be at least 8 characters.</p>
                    <p>*Password must contain at least 1 uppercase, 1 lowercase, 1 digit, and 1 special character.</p>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="password2">Confirm Password: </label>
                    <input id="password2" type="password" name="password2" placeholder="Confirm Password">
                    <small>Error message</small>
                </div>
                     <br>
                <input type="submit" value="Change" name="btn" id="retbt">
                <br><br>
                
            </form>
            <?php } 
              if($change==1)
              echo "<h4> Password has been changed successfully!<h4>";
            ?>

               <form action='profile.php' method='post'>
                <input type="submit" value="Return" name="btn2" id="retbt">
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

<script src="changePassword.js"></script>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
<script src="burgermenu.js"></script>

</body>
</html>