<?php
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $vName = "/^[a-zA-Z\s]{3,50}$/";
        $vEmail = "/^(([^<>()\[\]\\.,;:\s@]+(.[^<>()\[\]\\.,;:\s@]+)*)|(.+))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
        $vUsername = "/^[a-zA-Z0-9_]{3,20}$/";
        $vPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%*-])[A-Za-z0-9_#@%*-]{8,20}$/";

        $v = preg_match($vName, $name) && preg_match($vEmail, $email) 
        && preg_match($vUsername, $username) && preg_match($vPassword, $password);

        if($v){
            try{
                require('connection.php');

                $sql = "select * from user where username = '$username'";
                $rs = $db->query($sql);
                if ($r=$rs->fetch())
                    echo "<h5 align='center'>Username already exist. Try another one.</h5>";
                else{
                    $db -> beginTransaction();
    
                    $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $sql = "insert into user values (null, ?, ?, ?, ?)";
                    $stmt = $db -> prepare($sql);
                    $stmt -> execute(array($name, $email, $username, $hashPassword));
                    
                    echo "<h4 align='center';>Successful Registeration - Please Sign in </h4>";
                    echo "<h5 align='center'><a style= 'color: rgb(51, 51, 51); text-align:center;'href='signin.php'>Sign In Page</a></h5>";
                }

                $db -> commit();
                $db = null;
            }
            catch(PDOException $e){
                $db -> rollBack();
                die("Error: ".$e->getMessage());
            }
        } 
        else
         echo "<h5 align='center'>Invalid Inputs</h5>"; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">   
    <link rel="stylesheet" href="signup.css"> 

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
            <form method="post" id="form">
                <h2>Create an Account</h2>
                <br>
                <div class="inputwrapper">
                    <label for="name">Name: </label>
                    <input id="name" type="text" name="name" placeholder="Name">
                    <small>Error message</small>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="email">Email: </label>
                    <input id="email" type="text" name="email" placeholder="Email">
                    <small>Error message</small>
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="username">Username: </label>
                    <input id="username" type="text" name="username" placeholder="Username" onkeyup="checkUsername(this.value)">
                    <p><span id="unmsg"></span></p>
                    <small>Error message</small>
                </div>
                <br>
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
                <input id="submitBtn" type="submit" value="Sign up" name="btn">
                <br><br>
                <h5>Already a member? <a href="signin.php">Sign in</a></h5>
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

    <script>
    function checkUsername(str) {
        if (str.length < 3) 
         return;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = unFunction;
        xhttp.open("GET", "checkusername.php?q="+str);
        xhttp.send();
    }

    function unFunction(){
        if (this.responseText=="taken"){
            document.getElementById('unmsg').style.color="red";
            document.getElementById("unmsg").innerHTML = "Username is already taken.";
            document.getElementById("submitBtn").disabled = true;
        }
        else
        {
            document.getElementById("unmsg").innerHTML = "";
            document.getElementById("submitBtn").disabled = false;
        }
    }
    </script>

    <script src="validate.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="burgermenu.js"></script>
    
</body>
</html>