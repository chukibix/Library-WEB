<?php require "./../php/functions.php"; ?>
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
  <script src="../js/form-validation.js" defer></script>
</head>
<body>
  <header id="password" class="level-2"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <form id="login-form" action="#" method="post" onsubmit="return validateNewPassword()">
      <div class="form reset-pass">
        <h2 class="aTitle">RESET PASSWORD</h2>
        <section class="take-info">
          
          <!-- email will be sent from 'login' page to this field -->
          <label>
            <input type="email" name="email" value="some-email@example.com">
            <span>Email Address</span>
          </label>

          <label id="password-field">
            <input type="password" id="pass" name="password" minlength="8" required onkeydown="PasswordSecurity()">
            <span>New Password</span>
          </label>
          <div class="error"></div>

          <label id="confirm-field">
            <input type="password" id="cpass" name="password" minlength="8" onkeydown="checkpass()" required>
            <span>Confirm Password</span>
          </label>
          <div class="error"></div>

        </section>
        
        <section class="submit">
          <button type="submit" name="change-pass">CONFIRM CHANGE</button>
        </section>

        <section class="other-option">
          <span>Did you remember your password? </span>
          <a class="forgot-pass" href="./login.php">login</a>
        </section>
      </div>
    </form>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>
</html>