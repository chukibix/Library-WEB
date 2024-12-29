<?php
require("./connect.php");
require("./functions.php");

if (isset($_POST['submit'])) {
  $search = $_POST['search'];
  $genre = $_POST['category-search'];
  $query_select;
  if ($genre == 'All') {
    $query_select = "SELECT * FROM book WHERE Title LIKE '%$search%'";
  } else {
    $query_select = "SELECT * FROM book WHERE Title LIKE '%$search%' AND Genre = '$genre'";
  }
} else {
  die("Invalid Search !");
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
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/search-res.css">

  <!-- import JavaScript -->
  <script type="module" src="../js/main.js" defer></script>
</head>

<body>
  <header id="search-results" class="level-2"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <h1 class="aTitle">Search Results</h1>
    <div class='container'>
      <?php
      afficherLivres($query_select);
      ?>
    </div>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>

</html>