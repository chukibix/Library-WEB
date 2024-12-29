<?php require './../functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CNAM Library</title>

  <!-- import css -->
  <link rel="stylesheet" href="../../css/main.css"/>
  <link rel="stylesheet" href="../../css/for-contact.css"/>

  <!-- import JavaScript -->
  <script src="../../js/main.js" defer></script>
  <script src="../../js/for-contact.js" defer></script>
</head>
<body>
<body>
  <header id="contact" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <form id="form" method="POST">
      <input id="name" type="text" name="name" placeholder="username here" required> <br/>

      <input id="email" type="email" name="email" placeholder="email@example.com" required> <br/>

      <textarea id="text-message" placeholder="Enter your message here" required></textarea> <br/>

      <input id="message" type="text" name="message" style="display: none;">

      <button type="button" onclick="copyTextAndSubmit()">Next</button>
      
      <button type="submit" id="submitEmail" style="visibility: hidden;">Send Email</button>
    </form>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>
</html>
