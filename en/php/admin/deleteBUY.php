<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
  require './../connect.php';
  $buy_searched = $_GET['buy']; //to keep the content of the table
  $buy_id=$_GET['buyid'];
  $query = "DELETE FROM buy where IdBuy='$buy_id'";
  if (mysqli_query($connection, $query) === FALSE) {
    die("Could not delete  the customer order");
  }
  header("location:purchaseHistory.php?buy_searched=$buy_searched");
}
?>