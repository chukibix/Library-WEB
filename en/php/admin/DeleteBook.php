<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
require './../connect.php';
$book_searched = $_GET['book']; //to keep the content of the table
$book_to_delete = $_GET['IdBook'];
$query = "DELETE FROM book where IdBook=$book_to_delete";
if (mysqli_query($connection, $query) === FALSE) {
  die("Could not delete  the  professor");
}
header("location:Management.php?book=$book_searched");
}
?>