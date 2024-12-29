<?php

require("./connect.php");

$email = $_GET['email'];
$bookId = $_GET['idBook'];

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "INSERT INTO favorite (Email, IdBook) VALUES ('$email', $bookId)";

if ($connection->query($sql) === TRUE) {
    echo "Favorite added successfully";
    header("Location: displayBook.php?idBook=$bookId");
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}
$connection->close();
?>