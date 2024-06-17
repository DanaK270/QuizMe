<?php
try{
  $q = $_GET['q'];
  $hint = "";

  require("connection.php");
  $rs = $db -> query("SELECT * FROM quiz where quizName like '%$q%' ");

  if ($q !== "") {
    foreach($rs as $row) {
        extract($row);
        $hint = $hint . "<div class='quizInfo'>   
                            Quiz name: " . $quizName . "</br>
                            Subject: " . $category . "</br>
                            Level: " . $level . "</br>
                        </div><br><br>";
    }
  }

 echo $hint;

  $db=NULL;
}
catch (PDOException $e){
  die ($e->getMessage());
}
?>