<?php
session_start();
$check_log = $_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
  header("Location: ./../../account/login.php");
} else {
  require './../connect.php';
  if (isset($_GET['addS'])) {
    $Smail = $_GET['Smail'];
    $bookid = $_GET['bookid'];
    $quantity = $_GET['quantity'];
    $date_s = $_GET['date_s'];
    $query = "
      INSERT INTO `supply` (Email,IdBook,Date_s,Quantity_s)
      VALUES ('$Smail','$bookid', '$date_s', '$quantity')
    ";
    $query2 ="UPDATE `book` SET `Quantity` =  `Quantity` + $quantity WHERE `IdBook` = $bookid";

    if (mysqli_query($connection, $query)&& mysqli_query($connection, $query2)) {
      echo "the order by the supplier " . $Smail . "was added";
    } else {
      echo "it's seems you have an error:" . mysqli_error($connection) . "";
    }
  }

  //second part search for info
  $finalres = '<h2>no search yet!</h2>';

  if (isset($_GET['supply_searched']) && $_GET['supply_searched'] !== '') {
    $supply_searched = $_GET['supply_searched'];
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';

    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        if($supply_searched==" "){
        $query="SELECT * from supply";
    }else{
        $query = "SELECT * FROM supply WHERE (Email LIKE '%$supply_searched%' OR IdBook = '$supply_searched') ";
    }
    
    if (!empty($start_date) && $start_date !== '0000-00-00') {
        if($supply_searched==" "){
            $query .= " WHERE Date_s >= '$start_date' ";
        }else{ 
        $query .= " AND Date_s >= '$start_date' ";
        }
    }

    if (!empty($end_date) && $end_date !== '0000-00-00') {
        if($query ==="SELECT * from supply"){
            $query .= " WHERE Date_s <= '$end_date' ";
        }else{
      $query .= " AND Date_s <= '$end_date' ";
        }
    }

    $result = mysqli_query($connection, $query);
    $r = mysqli_num_rows($result);
    $finalres = "";
    if ($r > 0) {
      $finalres = "";
      for ($i = 0; $i < $r; $i++) {
        $row = mysqli_fetch_assoc($result);
        $Smail_search = $row['Email'];
        $bookid_search = $row['IdBook'];
        $quantity_search = $row['Quantity_s'];
        $date_s_search = $row['Date_s'];
        $supply_id=$row['IdSupply'];
        $finalres .= "<tr><td>$supply_id</td>"
          . "<td>$bookid_search</td>"
          . "<td>$Smail_search</th>"
          . "<td>$date_s_search</td>"
          . "<td>$quantity_search</td>"
          . "<td><a href='DeleteSUP.php?supplyid=$supply_id&supply=$supply_searched'>Delete</a></th></tr>"; // to go to delete page
      }
    } else {
      $finalres = "<h2>$supply_searched not found</h3>";
    }
  }
  ?>
  <!DOCTYPE html>
  <!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
  <html>

  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CNAM Library</title>

  <!-- import css -->
  <link rel="stylesheet" href="../../css/main.css"/>

  <!-- import JavaScript -->
  <script type="text/javascript" src="../../js/main.js" defer></script>
  </head>
  <header id="supply" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <body>
    <main>

      <h1>Add a new Supplyer</h1>
      <form action="supply.php" method="get">
        <label>
          Supplier Email
          <input type="email" name="Smail" required>
        </label><br /><br />

        <label>
          BookId
          <input type="number" name="bookid" required>
        </label><br /><br />

        <label>
          Quantity
          <input type="number" name="quantity" required>
        </label><br /><br />

        <label>
          Date
          <input type="date" name="date_s" required>
        </label><br /><br />

        <input type="submit" name="addS" value="Add supply">
        <input type="reset" value="Clear All">
      </form>
      <br /><br /><br />
      <h1>Manage supplyer</h1>
      <form action="supply.php" method="get">
        <input type="text" name="supply_searched"><br /><br />

        <label>
          Starting Date
          <input type="date" name="start_date">
        </label><br><br />

        <label>
          End date:
          <input type="date" name="end_date">
        </label><br><br />

        <input type="submit" value="search">
      </form>
      <table border="5">
        <tr>
          <th>Supply ID</th>
          <th>Book ID</th>
          <th>Email of supplyer</th>
          <th>date registred</th>
          <th>quantity received</th>
          <th>Delete</th>
        </tr>
        <?php
        echo "$finalres";
        ?>
      </table>
    </main>

    <footer></footer>
    <?php require './../functions.php'; afficherNom(); ?>
  </body>

  </html>
  <?php
}

?>