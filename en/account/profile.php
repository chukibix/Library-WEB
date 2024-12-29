<?php
session_start();
require './../php/connect.php';
require './../php/functions.php';

$email = "test@yopmail.com";
$fname = "First Name";
$lname = "Last Name";
$natio = "Lebanese";
$phone = "+961 00 00 00 00";
$addr = "Beyrouth";
$pw = "NaN";
$coins = 0;
$type = "client";
$bdate = "00-00-0000";

if (isset($_COOKIE['Email']) || isset($_SESSION['Email'])) {
  if(isset($_COOKIE['Email'])) $email = $_COOKIE['Email'];
  else $email = $_SESSION['Email'];
  $req_pers = "SELECT * FROM person WHERE Email = '$email'";
  $sel_pers = mysqli_query($connection, $req_pers);
  $row_pers = mysqli_fetch_row($sel_pers);

  $fname = $row_pers[1];
  $lname = $row_pers[2];
  $natio = $row_pers[3];
  $phone = $row_pers[4];
  $addr = $row_pers[5];
  $pw = $row_pers[6];

  $req_cli = "SELECT * FROM client WHERE Email = '$email'";
  $sel_cli = mysqli_query($connection, $req_cli);
  $row_cli = mysqli_fetch_row($sel_cli);

  $coins = $row_cli[1];
  $type = $row_cli[2];
  $bdate = $row_cli[3];
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
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/profile.css">

  <!-- import JavaScript -->
  <script src="../js/main.js" defer></script>
</head>

<body>
  <header id="profile" class="level-2"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <div class="container">
      <h1 class="aTitle">My Profile</h1>

      <section id="icon">
        icon
      </section>

      <section id="fullname">
        <?= $fname . " " . $lname ?>
      </section>

      <table>
        <?php
          if ($type == 'client') {
        ?>
        <tr id="balance">
          <th>Balance: </th>
          <td><img src="../../media/images/icons/coin.svg" alt="coin" />
            <input type="text" value="<?= $coins ?>" readonly />
          </td>
        </tr>

        <tr id="email">
          <th>Email: </th>
          <td><input type="text" value="<?= $email ?>" readonly /></td>
        </tr>

        <tr id="phone">
          <th>Phone: </th>
          <td><input type="text" value="<?= $phone ?>" readonly /></td>
        </tr>

        <tr id="address">
          <th>Address: </th>
          <td><input type="text" value="<?= $addr ?>" readonly /></td>
        </tr>

        <tr id="country">
          <th>Country: </th>
          <td><input type="text" value="<?= $natio ?>" readonly /></td>
        </tr>
        <?php
          }
        ?>
        <?php
          if ($type == 'admin') {
            $_SESSION['loggedin']=1;  // to start sessions if admin already logged in, try without this line to see the error
            ?>
            <tr id='admin-add'>
              <th><a href='./../php/admin/AddBook.php'>Add Book</a></th>
            </tr>
            <tr id='admin-manage'>
              <th><a href='./../php/admin/Management.php'>Manage Books</a></th>
            </tr>
            <tr id='admin-supply'>
                  <th><a href='./../php/admin/supply.php'>Manage Supplys</a></th>
              </tr>
              <tr id='admin-buy'>
                  <th><a href='./../php/admin/purchaseHistory.php'>Manage Purchase</a></th>
              </tr>
              <tr id='admin-members'>
                  <th><a href='./../php/admin/showMembers.php'>See Members</a></th>
              </tr>
            <?php
          }
        ?>
        <tr>
          <th>
            <a href='logout.php'> > Logout here < </a>
          </th>
        <tr>
      </table>
    </div>
  </main>

  <footer></footer>
  <?php afficherNom(); ?>
</body>

</html>
