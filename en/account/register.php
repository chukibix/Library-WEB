<?php require "./../php/functions.php"; ?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CNAM Library</title>

  <!-- import css -->
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/account.css">

  <!-- google fonts -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap">

  <!-- import JavaScript -->
  <script src="../js/main.js" defer></script>
</head>

<body onload="loading()">
  <header id="register" class="level-2"></header>
  <form id="searchLayer"></form>
  <nav id="navBar"></nav>
  <aside id="menu"></aside>

  <main>
    <form id="login-form" action="./../php/account.php" method="post"
      onsubmit="return checkpass() && PasswordSecurity() ">
      <div class="form sign-up">
        <h2 class="aTitle">SIGN UP</h2>

        <section class="take-info">
          <label id="fname-field">
            <input type="text" name="fname" pattern="[A-Za-z]+" required>
            <span>First Name</span>
          </label>

          <label id="lname-field">
            <input type="text" name="lname" pattern="[A-Za-z]+" required>
            <span>Last Name</span>
          </label>

          <section class="country-birth">
            <label class="birth">
              <input type="date" name="birthDate" required />
              <span>Date of Birth</span>
            </label>

            <label class="country">
              <select name="country">
                <option value="Lebanon">Lebanon</option>
                <option value="France">France</option>
                <option value="USA">USA</option>
              </select>
              <span>Country</span>
            </label>
          </section>

          <label class="address">
            <input type="text" name="address" required />
            <span>Address</span>
          </label>
          <label>
            <section class="phone">
              <select size="1" id="country" name="country_number" required onclick="changepattern()">
                <option value="" disabled>Country ID</option>
                <option value="France">+33(FRA)</option>
                <option value="USA">+1(USA)</option>
                <option value="Lebanon">+961(LEB)</option>
              </select>
              <label>
                <input type="tel" name="phone" id="phone" required>
                <span>Phone Number</span>
              </label>
            </section>
            <label id="email-field">
              <input type="email" name="email" required>
              <span>Email</span>
            </label>

            <label id="password-field">
              <input id="pass" type="password" name="password" required>
              <span>Password</span>
            </label>

            <label id="confirm-field">
              <input id="cpass" type="password" required>
              <span>Confirm Password</span>
            </label>
        </section>

        <section class="submit">
          <button type="submit" name="register">REGISTER</button>
        </section>

        <section class="other-option">
          <span>Already have an account? </span>
          <a class="forgot-pass" href="./login.html">login</a>
        </section>
      </div>
    </form>
  </main>

  <footer></footer>
  
  <?php afficherNom(); ?>

  <script>
    //check pass confirmation
    function checkpass() {
      var x = document.getElementById("pass").value;
      var z = document.getElementById("cpass").value;
      if (z === x) {
        return true;
      } else {
        alert("Your password confirmation is false,they do not match!Check again.");
        return false;
      }
    }
    //pass security
    function PasswordSecurity() {
      var password = document.getElementById("pass").value;
      var hasUppercase = /[A-Z]/.test(password);
      var hasLowercase = /[a-z]/.test(password);
      var hasDigit = /[0-9]/.test(password);
      var isLengthValid = (password.length >= 6);
      //return if true or fase
      if (hasUppercase && hasLowercase && hasDigit && isLengthValid) {
        return true;
      } else {
        alert("Your password do not meet our requirement,you should have at least: 1 digit,1 Uppercase and 1 lowercase letter and longer than 6 letters");
        return false;
      }
    }

    // phone number check
    function changepattern() {
      var select = document.getElementById("country");
      var pattern = "";
      //swith depend on counry
      switch (select.value) {
        case "France":
          pattern = "^0[1-9](\\d{2}){4}$";
          break;
        case "USA":
          pattern = "^\\(?([2-9][0-8][0-9])\\)?[-.\\s]?([2-9][0-9]{2})[-.\\s]?([0-9]{4})$";
          break;
        case "Lebanon":
          pattern = "^((03)|(81)|(70)|(71)|(76)|(78)|(79))\\d{6}$";
          break;
        default:
          pattern = "";
      }
      document.getElementById("phone").setAttribute("pattern", pattern);
    }

  </script>
</body>

</html>