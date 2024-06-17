<?php 
require('check.php');
$update=0;
try{
    $username=$_SESSION['ActiveUser'];
    $email = "";
    $name = "";
    require('connection.php');
    $rs=$db->query ("SELECT * from user where username='$username '");

    if( isset($_POST['btn'])){  
        $update=0;

        if(isset($_POST['name']) )
           {
            $name=$_POST['name'];
            $vName = "/^[a-zA-Z\s]{3,50}$/";
            if(preg_match($vName, $name)){
                $sqlName=("UPDATE user SET name='$name' WHERE username='$username' ");
                $records1=$db->exec($sqlName);
                $update=1;
            }
            else
             echo "<h5 align='center'>Cannot change name field. Invalid input.</h5>";
           }
        if (isset($_POST['email'])) 
           { 
            $email=$_POST['email'];
            $vEmail = "/^(([^<>()\[\]\\.,;:\s@]+(.[^<>()\[\]\\.,;:\s@]+)*)|(.+))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
            if(preg_match($vEmail, $email)){
                $sqlEmail=("UPDATE user SET  email='$email' WHERE username='$username' ");
                $records2=$db->exec($sqlEmail);
                $update=1;
            }
            else 
             echo "<h5 align='center'>Cannot change email field. Invalid input.</h5>";
           }
    }
    $db=null;
}
catch(PDOException $e){
    echo"Error Occured!";
    die($e->getMessage());  
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
    <link rel="stylesheet" href="profile.css">  
    

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
<style> 
main{
    padding: 40px;
}

h1{
    font-size: 5rem;
}

#btn2{
    margin-bottom:15px;
}
 
label{
    font-size: 2.25rem;
    margin-left: 15px;
}

main .inputwrapper input[type=text]{
    width: 30%;
    padding: 12px 20px;
    margin: 5px 0;
    box-sizing: border-box;
    border: 1px solid black;
    font-size: 1.25rem;
    font-weight: 400;
}

h4{
    margin-left: 15px;
}

p{
    font-size: 1.5rem;
    margin-left: 15px;
}

@media (max-width: 768px){
    table{width:90%;}
    h1{font-size:40px;}
}

@media (max-width: 400px){
    table{width:90%;}
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

        <?php 
        foreach($rs as $row) {
            extract($row);
            if($update==0){
        ?>
        <br> <br>
            <form method="post" >
                <h1>Update Profile</h1>
                <br>
                <div class="inputwrapper">
                    <h4>Username: <?php echo $username ?></h4>
                    <p>Note: Username cannot be changed.</p>
                </div>
                <br><br><br>
                <div class="inputwrapper">
                    <label for="name">Name: </label>
                    <input id="name" type="text" name="name" value="<?php echo $name ?>">
                    
                </div>
                <br>
                <div class="inputwrapper">
                    <label for="email">Email: </label>
                    <input id="email" type="text" name="email" value="<?php echo $email ?>">
                </div>
                <br><br>
                <input type="submit" value="Update" name="btn"  >     
            </form>
        <br> <br>

        <?php } 
        if($update==1)
        echo"<h4> Profile has been updated </h4>";
        ?>
        <br><br>
        <form action='profile.php' method='post'>
         <input type="submit" value="Return" name="btn2" id="btn2">
        </form>
        <?php } ?>

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
            <p >&copy; 2023 QuizMe All Rights Reserved</p>
        </div>
       </footer>
    </div>  

<script src="modify.js"> </script>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
<script src="burgermenu.js">  </script>

</body>
</html>