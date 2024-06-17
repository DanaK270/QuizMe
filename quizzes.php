<?php
require("check.php");
try{
    require('connection.php');
 
    }

catch(PDOException $e){
    die("Error: " .$e -> getMessage());
}

if(isset($_GET['submit']))
    $category=$_GET['submit'];
$rs = $db->prepare("SELECT quizID, quizName, category, topic, level, username FROM quiz, user WHERE quiz.userID=user.userID and category=?");
$rs->execute( array($category) );
//print_r($rs);
$db=null;

//$sql="SELECT quizID, quizName, category, topic, level, username FROM quiz, user WHERE quiz.userID=user.userID and category=$category";
//$result = $db->query($sql);
//print_r($result);


$db=null;
$colors = ["math" => [211, 106, 195], "languages" => [47, 210, 115], "science" => [234, 184, 76], "IT" => [66, 214, 187], "geography" => [216, 73, 99], "history" => [84, 149, 240]];
$category_color = implode(",", $colors[$category]);

$colorsH = ["math" => [150, 54, 136], "languages" => [29, 126, 70], "science" => [164, 129, 52], "IT" => [49, 154, 134], "geography" => [140, 44, 61], "history" => [50, 89, 145]];
$category_colorH = implode(",", $colorsH[$category]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choosing Quiz</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="quizzes.css">   
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <header>
        <div class="title"><h1><?php echo $category ?> Quizzes</h1></div>
        <div class="hd2">
            <div class="back"><p><a href="home.html">Back to Home</a></p></div>
            <div class="select"> <select name="cc" id="cc">
                <option value="math">Mathematics</option>
                <option value="languages">Languages</option>
                <option value="science">Science</option>
                <option value="IT">IT</option>
                <option value="geography">Geography</option>
                <option value="history">History</option>
            </select></div>
        </div>
    </header>
    <?php
   // output 
   $i=0;
if($rs->execute()){
    while($row = $rs->fetch(PDO::FETCH_ASSOC)) {
    echo "<form action='questions.php' method='post' >";    
    $i++;
        echo "<div class='quiz'>";    
            echo "<div class='quizInfo'>";    
                echo "Quiz name : ". $row["quizName"];
                echo "</br>";
                echo "Created By user : " . $row["username"];
                echo "</br>";
                echo "Subject: ". $row["topic"];
                echo "</br>";
                echo "Level: ". $row["level"];
                echo "</br>";
                $quiuzID=$row["quizID"];
                $cat=$row["category"];
                $IDcat=($cat."#". $quiuzID);
                ?>
            </div>   
            <div class='button' >
                <button name='submit' value='submit'> Begin the Quiz </button>
            </div>
          
        </div>
        <?php
        echo "<input type='hidden' name='quizIDcat' value='$IDcat'>";
        echo " </form>";
    
    }
   
} 
else {
    return false;
}
  ?>
    <style>
                header{
                    background-image: linear-gradient(to bottom right , rgb(<?php echo $category_color; ?>),rgb(<?php echo $category_colorH; ?>));
                }
                
                button{
                    background-color: rgb(<?php echo $category_color; ?>)
                }
                button:hover {
                    background-color: rgb(<?php echo $category_colorH; ?>);
                    color: white;
                }
            </style>
 
  </div>

 
</body>
</html>