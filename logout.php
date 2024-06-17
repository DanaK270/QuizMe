<?php
session_start();
unset($_SESSION['ActiveUser']);
header("location: home.html");
?>