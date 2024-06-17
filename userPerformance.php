<?php
require("check.php");

try{
    require('connection.php');

        $sql = "select * from quizzestaken";
        $rs = $db -> query($sql);
        $rs1 = $rs->fetchAll(PDO::FETCH_ASSOC);
  


}
catch(PDOException $e){
    die("Error: " .$e -> getMessage());
}
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$countQTakenRows=count($rs1);
$qTakenID= $countQTakenRows+1;

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Well Done!</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="userPerformance.css">   
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <header>
            <h2>You Finished the Quiz Successfully! </h2>
        </header>
        
        
        <?php
        
            if(isset($_POST["dur"])){
                $dur=$_POST["dur"];
            }
            $duration= intval($dur);
            $m = (int)($duration/60);
            $s = $duration%60;

            $visibleQuest=$_SESSION['visibleQuest'];
            $user=$_SESSION['ActiveUser'];
            $sql1="SELECT userID FROM user WHERE username='$user'";
            $userIDrs = $db -> query($sql1);
            $userIDrow = $userIDrs->fetch(PDO::FETCH_ASSOC);
            $currentUser=$userIDrow['userID'];

            $quizID=$_SESSION['quizID'];
            $sql2="SELECT quizName, topic, level FROM quiz WHERE quizId='$quizID'";
            $quizIDrs = $db -> query($sql2);
            $quizIDrow = $quizIDrs->fetch(PDO::FETCH_ASSOC);
            $currentQuiz=$quizIDrow['quizName'];
            $currentTopic=$quizIDrow['topic'];
            $currentLevel=$quizIDrow['level'];
            

            $totalPoints=0;
            $maxPoints=0;
            $counter=count($visibleQuest);
            $i=1;

            $stmt2 = $db -> prepare("INSERT INTO quizzestaken (userID,quizID,quizzestaken.date,duration,score)
            VALUES (:field1,:field2,CURRENT_DATE(),:field4,'0')" );
            $stmt2 -> execute(array(':field1' => $currentUser, ':field2' => $quizID,  ':field4' => $duration ));
            $lastID = $db -> lastinsertid();
            echo "<div class='yourAns'> <h2>Your Answers: </h2></div><br><br><br>";
            while($i<=$counter){
                $ans='-';
                $n="Q".$i;
                if(isset($_POST[$n]))
                {
                    $ans=$_POST[$n];
                }
                
                $points=0;
                $qArrayRow=explode('#',$visibleQuest[$i]);
                $question=$qArrayRow[0];
                $correctC=$qArrayRow[1];
                $correctAns=$qArrayRow[2];
                $qustID=$qArrayRow[3];
                echo "<div class='question'>";
                    echo "<div class='q'>";
                        echo "<h4>Question $i : $question<h4>";
                        if(trim($ans)==trim($correctC)){
                            echo "<div class='correct'> <h6'>your answer ($correctAns) is correct!<h6> </div> <br><br>"; 
                            $points++;
                            $totalPoints++;
                        }
                        else{
                            echo " <div class='incorrect'> <h6'>your answer is incorrect!<h6> </div>"; 
                            echo "<h6>correct answer : $correctAns <h6> <br><br>" ;
                        }
                        $maxPoints++;
                        $i++;
                    echo "</div>";
                    echo "<div class='points'>";
                        echo "points: ".$points."/1" ;
                    echo "</div>";
                echo "</div>";

                $stmt1 = $db -> prepare("INSERT INTO answers (qTakenID,questionID,userAnswer)
                VALUES (:field1,:field2,:field3)");
                $stmt1 -> execute(array(':field1' => $qTakenID, ':field2' => $qustID,  ':field3' => $ans ));

            }
       /*           
            $stmt2 = $db -> prepare("INSERT INTO quizzestaken (userID,quizID,quizzestaken.date,duration,score)
            VALUES (:field1,:field2,CURRENT_DATE(),:field4,:field5)" );
            $stmt2 -> execute(array(':field1' => $currentUser, ':field2' => $quizID,  ':field4' => $duration ,':field5' => $totalPoints));
        */
            $stmt3 = $db -> prepare("UPDATE quizzestaken SET score=? where id = '$lastID' and userId = '$currentUser' and quizId = '$quizID' " );
            $stmt3 -> execute(array($totalPoints));
            $db = null;
        ?>

        <main >
            <div class="score">
                <div class="results"><h3>Your Results:</h3></div>
                <h4>Quiz Name: <?php echo $currentQuiz; ?></h4> 
                <h4>Topic: <?php echo $currentTopic; ?></h4>
                <h4>Level: <?php echo $currentLevel; ?></h4>
                <h4>duration: <?php echo "$m minutes and $s seconds"; ?></h4>
                <h4>Score: <?php echo $totalPoints.' / '.$maxPoints ?></h4>
            </div>
            <div class="button">
                <form action="top10.php" method="POST">
                    <input type="hidden" name="viewTop10" value=<?php echo $quizID ; ?>>
                    <button>View Scoreboard</button>
                </form>
            </div>
        </main>
        
    </div>
</body>
</html>