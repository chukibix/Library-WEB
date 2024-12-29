<?php
require("./connect.php");
require("./functions.php");

$idBook = $_GET['idBook'];
$req = "SELECT * FROM book WHERE idBook = '$idBook'";
$req2 = "SELECT * FROM comment WHERE idBook = '$idBook'";
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>CNAM Library</title>

  <!-- import css -->
  <link rel='stylesheet' href='./../css/main.css' />
  <link rel='stylesheet' href='./../css/book-detail.css'>

  <!-- import JavaScript -->
  <script src='./../js/main.js' defer></script>
  <script src='./../js/for-details.js' defer></script>
</head>

<body>
  <header id='Book' class='level-2'></header>
  <nav id='navBar'></nav>
  <form id='searchLayer'></form>
  <aside id='menu'></aside>

  <main>
    <?php
    afficherLivre($req);
    afficherCommentaires($req2);
    ?>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>

</html>