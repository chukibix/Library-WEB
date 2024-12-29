
<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
    if(isset($_POST['AddBook']) && !empty($_POST['AddBook'])) {
    require './../connect.php';
    
    $book_searched = $_POST['book_searched'];
    $idbook = $_POST['idbook'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $author = $_POST['author'];
    $summary = $_POST['summary'];
    $phouse = $_POST['phouse'];
    $pbought = $_POST['pbought'];
    $psold = $_POST['psold'];
    $quantity = $_POST['quantity'];
    
    $query = "UPDATE book SET Title=?, Genre=?, Author=?, Summary=?, PriceBought=?, PriceSold=?, Quantity=?, PublishingHouse=? WHERE IdBook=?";
    
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'ssssdddis', $title, $genre, $author, $summary, $pbought, $psold, $quantity, $phouse, $idbook);
    
    $result = mysqli_stmt_execute($statement);
    
    if($result) {
        header("location: Management.php?book=$book_searched");
    } else {
        $error_message = "Error: " . mysqli_error($connection);
    }
    
    mysqli_stmt_close($statement);
}
}