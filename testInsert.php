<html>
    <head>
        <title>adding questions</title>
        <link rel="stylesheet" href="testInsert.css">
    </head>
    <body>

<?php
require("check.php");
try{
    require('connection.php');
    $sql = "select * from quiz";
    $rs = $db -> query($sql);
    $rs1 = $rs->fetchAll(PDO::FETCH_ASSOC);
        
}
catch(PDOException $e){
    die("Error: " .$e -> getMessage());
}

if(!isset($_SESSION['quizInfo'])){
    echo "you should specify quiz information";
    echo"<a href='createQuiz.php'>go to create quiz page</a> ";
}

$quizInfoS=$_SESSION['quizInfo'];
$quizInfo=explode('#',$quizInfoS);
$Qname= $quizInfo[0];
$category=$quizInfo[1];
$topic= $quizInfo[2];
$level= $quizInfo[3];
$noMcq= $quizInfo[4];
$noTF= $quizInfo[5];
$quizID=$quizInfo[6];
(int)$noOfQ=(int)$noTF+(int)$noMcq;

$user=$_SESSION['ActiveUser'];
$sql1="SELECT userID FROM user WHERE username='$user'";
$userIDrs = $db -> query($sql1);
$userIDrow = $userIDrs->fetch(PDO::FETCH_ASSOC);
$currentUser=$userIDrow['userID'];

$Question = "";
$option1 = "";
$option2 = "";
$option3 = "";
$option4 = "";
$correct = "";

  $qCount=0;
    echo"  <form method='POST'>";
        for ($i = 0; $i < $noMcq; $i++) {
            

            $qCount++;
            echo"<label for='Q'.$qCount> Question $qCount:</label>
                <input type='text' id='input'.$qCount  name=$qCount >
                <br> <br>" ;
           
            echo"  <label for='option1'>Option 1:</label>
              <input type='text' id='option1$qCount' name='option1$qCount' >
              <br> <br>";
  
              echo"  <label for='option2'>Option 2:</label>
              <input type='text' id='option2$qCount' name='option2$qCount' >
              <br> <br>";
              
              echo"  <label for='option3'>Option 3:</label>
              <input type='text' id='option3$qCount' name='option3$qCount' >
              <br> <br>";
  
              echo"  <label for='option4'>Option 4:</label>
              <input type='text' id='option4$qCount' name='option4$qCount' >
              <br> <br>";

            echo"  <label for='correct$qCount'>Correct Answer:</label>
            <select id='correct$qCount' name='correct$qCount' required>
                <option value='0'>Select Correct Answer</option>
                <option value='c1'>Option 1</option>
                <option value='c2'>Option 2</option>
                <option value='c3'>Option 3</option>
                <option value='c4'>Option 4</option>
            </select><br><br><br><br>";
        }
 
        for ($j = 0; $j < $noTF; $j++) {
            $qCount++;
            echo"<label for='Q'.$qCount> Question $qCount:</label>
                <input type='text' id='input'.$qCount  name=$qCount >
                <br> <br>" ;
      
          echo "
          <input type='radio' id='option1$qCount' name='option1$qCount' value='c1' >
          <label for='option1$qCount'>True</label>
          <input type='radio' id='option1$qCount' name='option1$qCount' value='c2' >
          <label for='option1$qCount'>False</label>";
          echo"<br><br><br><br>";

        }
        echo "<button name='submit' value='submit'> Create Quiz </button>";
        echo "</form>";

        $count=1;
        if(isset($_POST["submit"]))
        {
            $check='valid';
            $st2 = $db-> prepare("INSERT INTO question (quizId, type, question, c1, c2, c3, c4, correctC)
                    VALUES (:field1, 'mcq' , :field2, :field3, :field4, :field5, :field6, :field7 )" );

            for($k=0; $k<$noMcq;$k++)
            {
                    $Question = $_POST[$count];
                    $option1 = $_POST['option1'.$count];
                    $option2 = $_POST['option2'.$count];
                    $option3 = $_POST['option3'.$count];
                    $option4 = $_POST['option4'.$count];
                    $correct = $_POST['correct'.$count];
                    echo"<br><br>";
                    $e = "/^[A-Za-z0-9\s!?@,.-_:()+-=*%]{1,3000}$/";
                    if(preg_match($e, $Question) && preg_match($e, $option1) && preg_match($e, $option2) && preg_match($e, $option3) && preg_match($e, $option4) ){
                        $sql2= $st2->execute(array(':field1'=>$quizID, ':field2'=>$Question, ':field3'=>$option1, ':field4'=>$option2, ':field5'=>$option3, ':field6'=>$option4,':field7'=>$correct ));
                    }
                    else {
                    $sql3 = $db -> query("delete from question where quizID = $quizID ");
                    $sql5 = $db -> query("delete from quiz where quizID = $quizID ");
                    $check='invalid';
                    return;
                    }
                
                $count++;
            }
            
            if($check=='valid')
            {
                $st3 = $db-> prepare("INSERT INTO question (quizId, type, question, c1, c2, correctC)
                VALUES (:field1, 'TF' , :field2, 'True', 'False', :field7 )" );

                for($k=0; $k<$noTF;$k++)
                {
                        $Question = $_POST[$count];
                        $correct = $_POST['option1'.$count];
                        echo"<br><br>";
                        $e = "/^[A-Za-z0-9\s!?@,.-_:()+-=*%]{1,3000}$/";
                        if(preg_match($e, $Question)){
                            $sql2= $st3->execute(array(':field1'=>$quizID, ':field2'=>$Question, ':field7'=>$correct ));
                        }
                        else {
                        $sql3 = $db -> query("delete from question where quizID = $quizID ");
                        $sql4 = $db -> query("delete from quiz where quizID = $quizID ");
                        $check='invalid';
                        return;
                        }
                    $count++;
                }
            }
            if($check=='invalid')
            {
                echo "<script>window.location.href='unsuccessfully.html'</script>";
            }
            else
            {
                echo "<script>window.location.href='successfully.html'</script>";
            }
        }

        $db=null;

?>
</body>
</html>
