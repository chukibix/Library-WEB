<?php
session_start();
$check_log = $_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
  header("Location: ./../../account/login.php");
} else {
  require './../connect.php';
  include 'netProfit.php';
  //second part search for info
  $finalres = '<h2>no search yet!</h2>';

  if (isset($_GET['buy_searched']) && $_GET['buy_searched'] !== '') {
    $buy_searched = $_GET['buy_searched'];
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';

    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        if($buy_searched==" "){
        $query="SELECT * from buy";
    }else{
        $query = "SELECT * FROM buy WHERE (Email LIKE '%$buy_searched%' OR IdBook = '$buy_searched' OR IdBuy='$buy_searched') ";
    }
    
    if (!empty($start_date) && $start_date !== '0000-00-00') {
        if($buy_searched==" "){
            $query .= " WHERE Date >= '$start_date' ";
        }else{ 
        $query .= " AND Date >= '$start_date' ";
        }
    }

    if (!empty($end_date) && $end_date !== '0000-00-00') {
        if($query ==="SELECT * from buy"){
            $query .= " WHERE Date <= '$end_date' ";
        }else{
      $query .= " AND Date <= '$end_date' ";
        }
    }

    $result = mysqli_query($connection, $query);
    $r = mysqli_num_rows($result);
    $finalres = "";
    if ($r > 0) {
      $finalres = "";
      for ($i = 0; $i < $r; $i++) {
        $row = mysqli_fetch_assoc($result);
        $bmail_search = $row['Email'];
        $bookid_search = $row['IdBook'];
        $quantity_search = $row['Quantity_b'];
        $date_search = $row['Date'];
        $buy_id=$row['IdBuy'];
        $finalres .= "<tr><td>$buy_id</td>"
          . "<td>$bookid_search</td>"
          . "<td>$bmail_search</th>"
          . "<td>$date_search</td>"
          . "<td>$quantity_search</td>"
          . "<td><a href='DeleteBUY.php?buyid=$buy_id&buy=$buy_searched'>Delete</a></th></tr>"; // to go to delete page
      }
      $finalres .= "<tr><th colspan=\"6\"><a href=\"export.php?query=$query\"> export to excel </a></tr>";
    } else {
      $finalres = "<h2>$buy_searched not found</h3>";
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
      <h1>See purchases</h1>
      <form action="purchaseHistory.php" method="get">
        <input type="text" name="buy_searched" placeholder="Id Book"><br /><br />

        <label>
          Starting Date:
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
            <th>Order Id</th>
          <th>Book ID</th>
          <th>Email of customer</th>
          <th>Date purchased</th>
          <th>Quantity purchaed</th>
          <th>Delete</th>
        </tr>
        <?php
        echo "$finalres";
        ?>
      </table>
      <br/><br/><br/><br/>
      <h1>See Profits / Benefits / Gains</h1>
      <form action="purchaseHistory.php" method="get">

        <label>
          Starting Date:
          <input type="date" name="start_date_stats">
        </label><br><br />

        <label>
          End date:
          <input type="date" name="end_date_stats">
        </label><br><br />

        <input type="submit" value="search" name="submit_stats">
      </form>
      <br><br/>
       <table border="5">
        <tr>
            <th>Expenses</th>
          <th>Gains form sold product</th>
          <th>Net Profit</th>
        </tr>
        <?php
        echo @$finalres_stats;
        ?>
      </table>
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