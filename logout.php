<?php
session_start();
$_SESSION["User"]=null;
header('Location: ./homepage.php');
?>