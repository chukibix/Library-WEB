<?php
session_start();
$check_log = $_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
  header("Location: ./../../account/login.php");
} else {
  require './../connect.php';
  if (isset($_POST['AddBook'])) {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $author = $_POST['author'];
    $summary = $_POST['summary'];
    $phouse = $_POST['phouse'];
    $pbought = $_POST['pbought'];
    $psold = $_POST['psold'];
    $quantity = $_POST['quantity'];
    $query = "
        INSERT INTO `book` (Title, Author, Genre, PriceBought, PriceSold, Summary, Quantity, Likes, Dislikes, PublishingHouse)
    VALUES ('$title', '$author', '$genre', $pbought, $psold, '$summary', $quantity, 0, 0, '$phouse')";

    if (mysqli_query($connection, $query)) {
      echo ("
    <h2>The book <b>$title</b> by <b>$author</b> was successfully added!</h2>
        ");
    } else {
      echo "<h2>it's seems you have an error:" . mysqli_error($connection) . "</h2>";
    }
  }
  ?>


  <!DOCTYPE html>
  <!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
  <html>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CNAM Library</title>

    <!-- import css -->
    <link rel="stylesheet" href="../../css/main.css" />

    <!-- import JavaScript -->
    <script type="text/javascript" src="../../js/main.js" defer></script>
    <style>
      main {
        background-color: #005257;
        font-family: Arial, sans-serif;
        font-size: 16px;
      }

      main form {
        width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ABB981;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      main form label {
        display: block;
        margin-bottom: 10px;
      }

      main input[type="text"],
      main input[type="number"],
      main input[type="url"],
      main textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
      }

      main input[type="submit"],
      main input[type="reset"] {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      main input[type="submit"]:hover,
      main input[type="reset"]:hover {
        background-color: #3e8e41;
      }

      main input[type="submit"]:focus,
      main input[type="reset"]:focus {
        outline: none;
      }

      main h1,
      main h2,
      main h3 {
        font-family: "Nunito Sans", sans-serif;
        font-weight: bold;
        margin: 0 0 20px 0;
        color: #FF4136;
        font-size: 36px;
        text-align: center;
      }

      main h1 {
        color: #006400;
        font-size: 50px;
      }
    </style>
  </head>

  <body>
    <header id="home" class="level-3"></header>
    <nav id="navBar"></nav>
    <form id="searchLayer"></form>
    <aside id="menu"></aside>

    <main>
      <form action="AddBook.php" method="POST">
        <h1>Add your book!</h1>
        <label>
          Title:<input type="text" name="title" required="">
        </label><br />
        <label>
          Genre:<input type="text" name="genre" required="">
        </label><br />
        <label>
          Author:<input type="text" name="author" required="">
        </label><br />
        <label>
          Summary:<textarea name="summary" rows="4" cols="40" required=""></textarea>
        </label><br />
        <label>
          Publishing House:<input type="text" name="phouse" required="">
        </label><br />
        <label>
          Price bought for:<input type="number" name="pbought" required="">
        </label><br />
        <label>
          Price sold for:<input type="number" name="psold" required="">
        </label><br />
        <label>
          Quantity:<input type="number" name="quantity" required="">
        </label><br />
        <input type="submit" name="AddBook" value="Add">
        <input type="reset" value="Clear All">
      </form>
    </main>

    <footer></footer>
    <?php 
      require "./../functions.php";
      afficherNom(); 
    ?>
  </body>

  </html>
  <?php
}
?>