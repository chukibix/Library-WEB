<?php
session_start();
if (isset($_COOKIE['Email']) || isset($_SESSION['Email'])) {
  if(isset($_COOKIE['Email'])) $email = $_COOKIE['Email'];
  else $email = $_SESSION['Email'];
  require ("./../connect.php");
  require './../functions.php';
  $req = "SELECT b.* FROM favorite f JOIN book b ON f.IdBook = b.IdBook WHERE Email = '$email'";
  $result = mysqli_query($connection, $req);
  $row = mysqli_fetch_row($result);

}else{
header("Location:login.php");  
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CNAM Library</title>

  <!-- import css -->
  <link rel="stylesheet" href="./../../css/main.css"/>
  <link rel='stylesheet' href='./../../css/search-res.css'>

  <!-- import JavaScript -->
  <script src="./../../js/main.js" defer></script>
  <script src='./../../js/for-details.js' defer></script>
</head>
<body>
<body>
  <header id="favorites" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <h1>Your favorites books!</h1>
    <?php
    afficherLivresfav($req);
    ?>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>
</html>

