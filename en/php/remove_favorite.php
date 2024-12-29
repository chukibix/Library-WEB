<?php

$email = $_GET['email'];
$bookId = $_GET['idBook'];
require("./connect.php");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$sql = "DELETE FROM favorite WHERE Email = '$email' AND IdBook = $bookId";

if ($connection->query($sql) === TRUE) {

    echo "Favorite removed successfully";
    header("Location: displayBook.php?idBook=$bookId");
} else {

    echo "Error: " . $sql . "<br>" . $connection->error;
}

// Close the database connection
$connection->close();
?>