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
  <link rel="stylesheet" href="../../css/about-us.css"/>

  <!-- import JavaScript -->
  <script src="../../js/main.js" defer></script>
</head>
<body>
  <header id="about" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <div class="writing">
      <h1 class="aTitle">ABOUT US</h1>
      <p>
        C<strong>NAM Library</strong>, based in <span>Lebanon</span>, is a world-class academic and research institution dedicated to the collection, preservation, and dissemination of knowledge.
        Our library opens up its diverse collection of books covering various genres such as self-improvement, history, comedy, romance, etc. Moreover, it provides a broad range of reading options for people of all interests and backgrounds.
      </p>
      <p>
        In addition to its traditional library services such as reading books from within the library, <strong>CNAM Library</strong> also offers innovative services that cater to the evolving needs of its users. For instance, the library provides digital copies of its books for sale, allowing users to access their favorite books on-the-go, from the comfort of their homes or offices. The library also offers book rental services, providing an affordable and flexible option for people who prefer to read physical books but do not want to commit to purchasing them.
      </p>
      <p>
        Are you a book lover? a student? or a researcher? <strong>CNAM Library</strong> is your excellent resource for your learning, inspiration, and entertainment! With its diverse collection of books, modern facilities, and innovative services, the library provides a welcoming and inclusive environment for people of all ages and backgrounds. 
        <em>Still doubting? <strong>Try it out!</strong></em>
      </p>
    </div>

    <div class="illustrations">
      <section class="img-card">
        <div>
          <img src="../../media/images/category/self-improvement/tao-of-jeet-kune-do.jpeg" alt="self-improvement">
        </div>
        <article>Self Improvement</article>
      </section>
    </div>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>
</html>