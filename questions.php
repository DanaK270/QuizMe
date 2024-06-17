<?php
require("check.php");
    try{
        require('connection.php');
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
    <title>Good Luck!</title>

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="questions.css">   
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Dongle&family=Inconsolata:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c8edd320f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <header>
            <h4>Time: </h4>
            <h4 id = 'demo'></h4>
        </header>
        <main>
            <div class="content">
                
                <div class="question">
                    <?php 
                    $quizIDcat=$_POST['quizIDcat'];
                    [$cat , $quizID]=explode("#", $quizIDcat);

                /*    $rsVis = $db->prepare("SELECT visibleQuest FROM quiz WHERE  quizID=? ");
                    $rsVis->execute( array($quizID) );
                    $visibleQuestRow=$rsVis->fetch(PDO::FETCH_ASSOC);
                    $visibleQuest=(int)($visibleQuestRow['visibleQuest']);
                    print_r($visibleQuest);*/
        
                /*  $rs = $db->prepare("SELECT * FROM question,quiz WHERE question.quizID=quiz.quizID AND question.quizID=? AND quiz.category=? ORDER BY RAND() LIMIT ?");
                //    print_r($rs);
                    $rs->execute(array($quizID, $cat, (int)$visibleQuest));
                    $rs->bindParam(2, $visibleQuest, PDO::PARAM_INT);
                */
                    

                    $rs = $db->prepare("SELECT * FROM question,quiz WHERE question.quizID=quiz.quizID AND question.quizID=?  AND quiz.category=? order by rand() limit 2  ");
                    $rs->execute( array($quizID, $cat) );
   


                    $user=$_SESSION['ActiveUser'];
                    $_SESSION['quizID']=$quizID;
                    $sql1="SELECT userID FROM user WHERE username='$user'";
                    $userIDrs = $db -> query($sql1);
                    $userIDrow = $userIDrs->fetch(PDO::FETCH_ASSOC);
                    $currentUser=$userIDrow['userID'];

                    $points=0;
                    $rowsC = $rs->rowCount(); 
                    $i=0;
                    $visibleQuest=array();

                    echo "<form method='post' action='userPerformance.php' onsubmit='return openPopup();' id='myForm'>";
                    echo "<input type='hidden' name='dur' id='dur'>  <br>";
                    while($row = $rs->fetch(PDO::FETCH_ASSOC)){
                        $qustID=$row['qID'];
                        $correctC=$row['correctC'];
                        $correctAns=$row[$correctC];
                        $qNum=$i+1 ;
                        $question=$row['question'];
                        echo "<br>";
                        $qFormName= "Q".$qNum;
                        $questionText="question".$qNum;
                        
                        $type=$row['type'] ;
                        $c1=$row['c1'];
                        $c2=$row['c2'];
                        $c3=$row['c3'];
                        $c4=$row['c4'];
                        
                        echo "\n<h1>Question $qNum : $question<h1>";
                            if($type =='TF'){
                                echo "\n<input type='radio' name='$qFormName' value='c1'> True <br>";
                                echo "\n<input type='radio' name='$qFormName' value='c2'> False<br>";
                            }
                            else if ($type=='mcq'){
                                echo "\n<input type='radio' name='$qFormName' value='c1'> $c1 <br>";
                                echo "\n<input type='radio' name='$qFormName' value='c2'> $c2 <br>";
                                echo "\n<input type='radio' name='$qFormName' value='c3'> $c3 <br>";
                                echo "\n<input type='radio' name='$qFormName' value='c4'> $c4 <br>";
                            }
                        

                        
                        $visibleQuest[$qNum]="$question#$correctC#$correctAns#$qustID";
                        echo "<br>";
                        if($i!= $rowsC)
                            {echo "<hr>";}

                        $i++;
                    }
                    
                    $_SESSION['visibleQuest']=$visibleQuest;

                   

                    

                    ?>
                    
                </div>
            </div>

            <aside >
                <div class="scoreboard">
                    <div class="sbHeader"><h4>Scoreboard</h4></div>
                    <?php 
                    $rs2 = $db->prepare("SELECT username,duration,score FROM user,quizzestaken where user.userID=quizzestaken.userID AND quizID=? order by score DESC , duration ASC limit 3  ");
                    $rs2->execute( array($quizID) );
                    $j=0;
                    while($row2 = $rs2->fetch(PDO::FETCH_ASSOC)){
                        $j++;
                        $topUser=$row2['username'];
                        $topScore=$row2['score'];
                        $topDur=$row2['duration'];
                        $topM=(int)($topDur/60);
                        $topS=(int)($topDur%60);
                    ?>
                        <div class="top3">
                            <div class="img"> <img src="profile.png" alt="" width="50px" > </div>
                            <div class="topInfo"> <h5><?php echo $topUser;  ?> </h5> <h6>score: <?php echo $topScore; ?> points</h6> <h6>time: <?php echo "$topM minutes and $topS seconds" ?> </h6> </div>
                            <div class="rank"><img src='<?php echo "$j.png" ?>' alt="" width="70px" ></div>
                        </div>
                    <?php
                        }
                        $db = null;
                    ?>
                </div>
                <div class="sideButtons">
                        <button name="submit" value="submit" id="submit" >Submit</button>
                </div>
        
            </aside>
            </form>

        </main>
        

    </div>
    <script>
        let duration = 0;

        var myInterval = setInterval(myTimer, 1000);
        let s = 0;
        let m =0; 
        function myTimer() {
            document.getElementById("demo").innerHTML = m + ' minutes and  '+ s + ' seconds'; 
            s++;
            if (s==60)
            {
                s=0;
                m++;
            }
            let quizTime=m*60+s;
            duration= quizTime;
            let myForm=getElementById("myForm");
            if (m>=2){
                myForm.submit();
                window.location.replace("userPerformance.php");
            }  
        }


        function openPopup(){
           document.getElementById('dur').value=duration;
           return true;
        }

    </script>



    
</body>
</html>