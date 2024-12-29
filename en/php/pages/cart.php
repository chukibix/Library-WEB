<?php
  session_start();
  require ("./../connect.php");
  require './../functions.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CNAM Library</title>

    <!-- import css -->
    <link rel="stylesheet" href="./../../css/main.css" />
    <link rel="stylesheet" href="./../../css/cart.css" />

    <!-- import JavaScript -->
    <script src="./../../js/main.js" defer></script>
    <script src="./../../js/for-cart.js" defer async></script>
  </head>
  <body>
    <header id="cart" class="level-3"></header>
    <nav id="navBar"></nav>
    <form id="searchLayer"></form>
    <aside id="menu"></aside>

    <main>
      <?php
        afficherCart();
      ?>
    </main>

    <footer></footer>

    <?php afficherNom(); afficherCartCheckout(); ?>
  </body>
</html>
