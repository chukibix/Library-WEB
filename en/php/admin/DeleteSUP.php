<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
  require './../connect.php';
  $supply_searched = $_GET['supply']; //to keep the content of the table
  $supplyId = $_GET['supplyid'];
  $query = "DELETE FROM supply where IdSupply='$supplyId'";
  if (mysqli_query($connection, $query) === FALSE) {
    die("Could not delete  the supplier order");
  }
  header("location:supply.php?supply_searched=$supply_searched");
}
?>