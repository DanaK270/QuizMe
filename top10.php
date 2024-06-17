<html>
<head>
    <link rel="stylesheet" href="top10.css">
</head>
<body>

<?php
    session_start();
    if (!isset($_SESSION['ActiveUser'])) {
        die ("You need to login first - <a href='signin.php'>Click here to login</a>");
    }

    $quizID=$_POST['viewTop10'];

    try{
        require('connection.php');

        $rs2 = $db->prepare("SELECT username,duration,score FROM user,quizzestaken where user.userID=quizzestaken.userID AND quizID=? order by score DESC , duration ASC limit 10  ");
        $rs2->execute( array($quizID) );

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
    <title>Top 10</title>
</head>
<body>
    <header>
        <h1>Top 10</h1>
    </header>

    <div class="table-container">
        <table>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Score</th>
                <th>Time</th>
            </tr>
        <?php
            $j=0;
            while($row2 = $rs2->fetch(PDO::FETCH_ASSOC)){
                $j++;
                $topUser=$row2['username'];
                $topScore=$row2['score'];
                $topDur=$row2['duration'];
                $topM=(int)($topDur/60);
                $topS=(int)($topDur%60);
                
                echo "<tr>";
                    echo "<td>$j</td>";
                    echo "<td><img src='profile.png' width='50px'> <br><br> $topUser</td>";
                    echo "<td>$topScore points</td>";
                    echo "<td>$topM minutes and $topS seconds</td>";
                echo "</tr>";
            }

        ?> 
        </table>
        <div class="back"><p><a href="home.html">Back to Home</a></p></div>
    </div>

</body>
</html>