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
?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="createQuiz.css">

</head>
<body>
<div class="name">
  <h1>Start Creating Your Quiz</h1>
    <form method="POST" >
        <label for="Qname">Quiz name:</label>
        <input type="text" id="Qname" name="Qname" ><br><br>

        <label for="category">Category:</label>
        <select id="category" name="category">
            <option  value="math" selected>Mathematics</option>
            <option  value="languages">Languages</option>
            <option  value="science">Science</option>
            <option  value="IT">IT</option>
            <option  value="geography">Geography</option>
            <option  value="history">History</option>
        </select><br><br>

        <label for="topic">Topic:</label>
        <input type="text" id="topic" name="topic" required><br><br>

        <label for="level">Level:</label>
        <select id="level" name="level" >
            <option name="easy" value="easy" selected>Easy</option>
            <option name="meduim" value="meduim">Medium</option>
            <option name="hard" value="hard">Hard</option>
        </select><br><br>
      
        <label for="mcq">Number of Multiple Choice Questions:</label>
        <input id="mcq" name="mcq" type="number" style="width: 7em ; height:2em"><br><br>
  
       
        <label for="TF">Number of True/False Questions:</label>
        <input id="TF" name="TF" type="number" style="width: 7em ; height:2em" onkeyup="sum()"> <br><br>

        <p id="msg"> </p>

        <button type="submit" id="generate" name="submit">Ganerate</button><br><br>
    </form>
    <?php
    //$quizIDCount=count($rs1);
   // $quizID= $quizIDCount+1;
     
    $user=$_SESSION['ActiveUser'];
    $sql1="SELECT userID FROM user WHERE username='$user'";
    $userIDrs = $db -> query($sql1);
    $userIDrow = $userIDrs->fetch(PDO::FETCH_ASSOC);
    $currentUser=$userIDrow['userID'];
    if(isset($_POST['submit']))
    {
    $Qname= $_POST['Qname'];
    $category=$_POST['category'];
    $topic= $_POST['topic'];
    $level= $_POST['level'];
    $noMcq= $_POST['mcq'];
    $noTF= $_POST['TF'];
    (int)$noOfQ=(int)$noTF+(int)$noMcq;

    $st3 = $db-> prepare("INSERT INTO quiz (userID, quizName, category, topic, level)
VALUES ( :field2 , :field3, :field4,:field5 ,:field6)" );
$e = "/^[A-Za-z0-9\s!?@,.-_:()+-=*%]{1,3000}$/";
if(preg_match($e, $Qname) && preg_match($e, $topic) && ((int)$noMcq >=0) &&  ((int)$noTF >=0) ){
  $sql2= $st3->execute(array( ':field2'=>$currentUser, ':field3'=>$Qname, ':field4'=>$category, ':field5'=>$topic, ':field6'=>$level ));
}
else{
  header('Location: unsuccessfully.html');
  die();
}

      $quizID= $db -> lastinsertid();
    $quizInfo=$Qname.'#'.$category.'#'.$topic.'#'.$level.'#'.$noMcq.'#'.$noTF.'#'.$quizID;
    $db=null;
    //print_r($quizInfo);
    $_SESSION['quizInfo']=$quizInfo;
    header('Location: testInsert.php');
    }
    ?>
    
</div>

<script>
    function sum(){
      let n1 = parseInt(document.getElementById('mcq').value);
      let n2 = parseInt(document.getElementById('TF').value);
      let sum = n1 + n2;
      checkNo(sum);
    }

    function checkNo(sum) { 
        const xhttp = new XMLHttpRequest();
        xhttp.onload = nFunction;
        xhttp.open("GET", "checkNumber.php?n="+sum);
        xhttp.send();
    }

  function nFunction(){
    if(this.responseText=="Invalid"){
      document.getElementById('msg').innerHTML = "Quiz must contain at least 3 questions.";
      document.getElementById('generate').disabled = true;
    }
    if(this.responseText=="Valid"){
     document.getElementById('msg').innerHTML = "";
     document.getElementById('generate').disabled = false;
    }
  }
</script>

</body>
</html>