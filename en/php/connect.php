<?php
$serv = 'localhost';
$usn = 'root';
$pw = '';
$db = 'cnam_library';
$connection = mysqli_connect($serv, $usn, $pw) or
    die(mysqli_connect_errno() . ' : ' . mysqli_connect_error());
mysqli_select_db($connection, $db) or
    die("Cannot select DataBase !");
?>