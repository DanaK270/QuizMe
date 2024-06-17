<?php
session_start();
if (!isset($_SESSION['ActiveUser'])) {
  header("location: signin.php");
}
?>