<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
require './../connect.php';
$finalres = '<h2 class="aTitle">no search yet!</h2>';

if (isset($_GET['members']) && $_GET['members'] != '') {
  $member = $_GET['members'];
  $query = "SELECT c.*, p.FirstName, p.LastName, p.Nationality, p.Phone, p.Address FROM client c JOIN person p ON c.Email = p.Email ";
  if($member!==" "){
      $query .=" WHERE p.Email like '%$member%' ";
  }
  $result = mysqli_query($connection, $query);
  $r = mysqli_num_rows($result);
  $finalres = "";
  if ($r > 0) {
    $finalres = "";
    for ($i = 0; $i < $r; $i++) {
      $row = mysqli_fetch_assoc($result);
      $Email = $row['Email'];

      /* notice: iconv helped turn wrongly encoded character into normal like the é that was a <?> */
      $fname = iconv('ISO-8859-1', 'UTF-8', $row['FirstName']);
      $lname = $row['LastName'];
      $nation = $row['Nationality'];
      $bdate = $row['BirthDate'];
      $type = $row['Type'];
      $phone = $row['Phone'];
      $adr = $row['Address'];
      $coins = $row['CoinsCli'];
      $comp="-";
      $finalres .=
        "<tr><td>$Email</td>"
        . "<td>$fname</th>"
        . "<td>$lname</td>"
        . "<td>$phone</td>"
        . "<td>$nation</td>"
        . "<td>$adr</td>"
        . "<td>$bdate</td>"
        . "<td>$coins</td>"
        . "<td>$type</td>"
        . "<td>$comp</td>";
    }
  }
    $query = " SELECT s.*, p.FirstName, p.LastName, p.Nationality, p.Phone, p.Address FROM supplier s JOIN person p ON s.Email = p.Email ";
  if($member!==" "){
      $query .=" WHERE p.Email like '%$member%'";
  }
  $result = mysqli_query($connection, $query);
  $r = mysqli_num_rows($result);
  if ($r > 0) {
    for ($i = 0; $i < $r; $i++) {
      $row = mysqli_fetch_assoc($result);
      $Email = $row['Email'];

      /* notice: iconv helped turn wrongly encoded character into normal like the é that was a <?> */
      $fname = iconv('ISO-8859-1', 'UTF-8', $row['FirstName']);
      $lname = $row['LastName'];
      $nation = $row['Nationality'];
      $bdate ="-";
      $type = "supplyer";
      $phone = $row['Phone'];
      $adr = $row['Address'];
      $coins ="-";
      $comp=$row["CompanyName"];
      $finalres .=
        "<tr><td>$Email</td>"
        . "<td>$fname</th>"
        . "<td>$lname</td>"
        . "<td>$phone</td>"
        . "<td>$nation</td>"
        . "<td>$adr</td>"
        . "<td>$bdate</td>"
        . "<td>$coins</td>"
        . "<td>$type</td>"
        . "<td>$comp</td>";
    }
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
  <header id="home" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
  <div style="background-color: #ABB981; padding: 15px;">
    <form action="showMembers.php" method="get">
      <h1 class="aTitle">See your community!</h1>
      <input type="text" name="members"><br />
      <!-- book id or name request -->

      <input type="submit" value="search">
    </form>

    <section class='table__wrapper'>
      <table border="5">
        <tr>
          <th>Email</th>
          <th>First Name</th>
          <th>Last name</th>
          <th>Phone</th>
          <th>Nationality</th>
          <th>Address</th>
          <th>Birth Date</th>
          <th>Coins</th>
          <th>Status</th>
          <th>Company name</th>
        </tr>
        <?php
        echo "$finalres";
        ?>
      </table>
    </section>
  </div>
  </main>

  <footer></footer>
  <?php require './../functions.php'; afficherNom(); ?>
</body>

</html>
<?php
}
?>