<?php 
require('check.php');
try{
    require('connection.php');
    $uusername=$_SESSION['ActiveUser'];
    $ui=$db->query( "SELECT * FROM user where username='$uusername'" );

    $uname="";
    $uemail="";

    foreach($ui as $u){
        extract($u);
        $uname=$name;
        $uemail=$email;
    }

    $rs = $db -> query("SELECT quizName, score, duration from user u, quizzestaken t, quiz q  
    where username='$uusername' AND q.quizID=t.quizID   AND u.userID = t.userID ");
 
    $ru=$db->query("SELECT z.quizName, z.category, count(qID) as total, z.topic, z.level 
    from question q , quiz z, user u 
    where q.quizID=z.quizID AND u.userID=z.userID AND u.userName='$uusername' GROUP BY z.quizID
    ");

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
  
    <title>Profile Page</title>

   <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">  
    <link rel="stylesheet" href="profile.css"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
 
    <style> 
        h5{margin-left:35px; font-size:35px;}
        .un{margin-top:-9px;}
        #mod{margin-left:35px;}
        #cp{margin-left:35px;} 
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
        
        <br>
        <div class="logout">
            <form action='logout.php' method='post'>
                <input type='submit' name='logout' value='Logout' id='lo'>
            </form>
            <hr>
        </div>

        <div class="p1">
        <!-- username, name and email will appear here -->
       <h1>Personal Information</h1>
       <?php 
        echo "<h5 class='un'>Username:  ".$uusername." </h5> <br> ";
        echo "<h5>Name:  ".$uname." </h5> <br> ";
        echo "<h5>Email:  ".$uemail." </h5> ";
        echo "<br>";
       ?>

        <div class='buttons'>
            <form action='modifyProfile.php' method='post'>
                 <input type='submit' name='modify' value='Edit Your Profile' id='mod'>
            </form>
            <form action='changePassword.php' method='post'>
                <input type='submit' name='changePassword' value='Change Your Password' id='cp'>
            </form>
        </div>

         </div>

     <div class="p2">
        <br><br>
        <h1> Previous Quizzes</h1>
        <table class="prevquiz" >
            <tr>
                <td>Quiz Name</td>
                <td>Score</td>
                <td>Duration</td>
            </tr>
            <?php 

            foreach($rs as $f){
                extract($f);
                echo" <tr>";
                echo"<td> $quizName </td>";
                echo"<td> $score</td>";
                echo"<td> $duration </td>";
                echo" </tr>";
            }
           ?>
        </table>
    </div>

    <div class="p3">
        <h1> Quizzes Created By YOU</h1>
        <table class="crquiz" >
            <tr>
                <td>Quiz Name</td>
                <td>Number of Questions</td>
                <td>Subject</td>              
                <td>Topic</td>
                <td>Level</td>
            </tr>
            
            <?php 
            foreach($ru as $q){
               
                extract($q);
                if($total!=0)
                {
                    echo" <tr>";
                     echo"<td> $quizName </td>";
                     echo"<td> $total </td>";
                     echo"<td> $category </td>";
                     echo"<td> $topic </td>";
                     echo"<td> $level </td>";
                     echo "</tr>";
                   
                }
             }
            ?>
                

        </table>
    </div>

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