<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
require './../connect.php';
$finalres = '<h2 class="aTitle">no search yet!</h2>';

if (isset($_GET['book']) && $_GET['book'] != '') {
  $book = $_GET['book'];
  $query = "SELECT * from book where Title like'%$book%' OR IdBook='$book'";
  $result = mysqli_query($connection, $query);
  $r = mysqli_num_rows($result);
  $finalres = "$";
  if ($r > 0) {
    $finalres = "";
    for ($i = 0; $i < $r; $i++) {
      $row = mysqli_fetch_assoc($result);
      $id = $row['IdBook'];

      /* notice: iconv helped turn wrongly encoded character into normal like the é that was a <?> */
      $title = iconv('ISO-8859-1', 'UTF-8', $row['Title']);
      $genre = $row['Genre'];
      $author = $row['Author'];
      $phouse = $row['PublishingHouse'];
      $pbought = $row['PriceBought'];
      $psold = $row['PriceSold'];
      $quantity = $row['Quantity'];
      $finalres .=
        "<tr><td>$id</td>"
        . "<td>$title</th>"
        . "<td>$author</td>"
        . "<td>$genre</td>"
        . "<td>$pbought</td>"
        . "<td>$psold</td>"
        . "<td>$quantity</td>"
        . "<td>$phouse</td>"
         . "<td><a href='UpdateBook.php?IdBook=$id&book=$book'>Update</a></th>" //link to go to update page
         . "<td><a href='DeleteBook.php?IdBook=$id&book=$book'>Delete</a></th></tr>";// to go to delete page
      
    }
  } else {
    $finalres = "<h2 class='aTitle'>$book not found</h2>";
  }
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
  <link rel="stylesheet" href="../../css/main.css" />
  <link rel="stylesheet" href="../../css/for-manage.css" />

  <!-- import JavaScript -->
  <script type="text/javascript" src="../../js/main.js" defer></script>
</head>

<body>
  <header id="management" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <div class="manage_container">
      <h1 class="aTitle">Manage your library!</h1>
      <form action="Management.php" method="get">
      <input type="text" name="book"><br />
      <!-- book id or name request -->

      <input type="submit" value="search">
    </form>

    <section class='table__wrapper'>
      <table border="5">
        <tr>
          <th>Book ID</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>Price Bought</th>
          <th>Price Sold</th>
          <th>quantity</th>
          <th>Publishing House</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
        <?php
        echo "$finalres";
        ?>
      </table>
    </div>
  </main>

  <footer></footer>
  <?php 
    require './../functions.php';
    afficherNom(); 
  ?>
</body>

</html>
<?php
}
?>