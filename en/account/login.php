<?php
  require './../php/functions.php';

  if(isset($_COOKIE['Email']) || isset($_SESSION['Email'])){
    header("Location: ./profile.php");
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
  <link rel="stylesheet" href="../css/main.css"/>
  <link rel="stylesheet" href="../css/account.css">

  <!-- google fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap">

  <!-- import JavaScript -->
  <script src="../js/main.js" defer></script>
</head>
<body>
  <header id="login" class="level-2"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <form id="login-form" action="./../php/account.php" method="post">
      <div class="form sign-in">
        <h2 class="aTitle">SIGN IN</h2>
        <section class="take-info">
          
          <label>
            <input type="email" name="email" required>
            <span>Email Address</span>
          </label>

          <label>
            <input type="password" name="password" required>
            <span>Password</span>
          </label>

          <!-- this error should appear when the provided infos aren't inside the database -->
          <div class="error"> <?= @$_GET['error'] ?> </div>
        </section>
        <a href="./reset-password.html" class="forgot-pass">Forgot Password?</a>
        
        <section class="submit">
          <button type="submit" name="login">LOGIN</button>
        </section>

        <section class="other-option">
          <span>Don't have an account? </span>
          <a class="forgot-pass" href="./register.html">register</a>
        </section>
      </div>
    </form>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>
</html>