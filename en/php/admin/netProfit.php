<?php
$finalres_stats="";
  if (isset($_GET['submit_stats']) && $_GET['submit_stats'] !== '') {
    $start_date_stats = isset($_GET['start_date_stats']) ? $_GET['start_date_stats'] : '';

    $end_date_stats = isset($_GET['end_date_stats']) ? $_GET['end_date_stats'] : '';
    $query_expenses="SELECT SUM(b.PriceBought * s.Quantity_s) AS TotalPriceBought FROM book b JOIN supply s ON b.IdBook = s.IdBook ";
    $query_gains="SELECT SUM(b.PriceSold * bu.Quantity_b) AS TotalPriceSold FROM book b JOIN buy bu ON b.IdBook = bu.IdBook ";
    
    
    if (!empty($start_date_stats) && $start_date_stats !== '0000-00-00') {
        $query_expenses.= " WHERE Date_s >= '$start_date_stats' ";
        $query_gains.= " WHERE Date >= '$start_date_stats' ";

    }
    if (!empty($end_date_stats) && $end_date_stats !== '0000-00-00') {
        if($query_expenses ==="SELECT SUM(b.PriceBought * s.Quantity_s) AS TotalPriceBought FROM book b JOIN supply s ON b.IdBook = s.IdBook "){
            $query_expenses .= " WHERE Date_s <= '$end_date_stats' ";
            $query_gains .= " WHERE Date <= '$end_date_stats' ";
        }else{
      $query_expenses .= " AND Date_s <= '$end_date_stats' ";
      $query_gains .= " AND Date <= '$end_date_stats' ";
        }
    }
    $finalres_stats="";
    $result_gains = mysqli_query($connection, $query_gains);
    $result_expenses = mysqli_query($connection, $query_expenses);
    
    if ($result_gains) {   // get gains result
    $row_gains = mysqli_fetch_assoc($result_gains);
    $totalPriceSold = $row_gains['TotalPriceSold'];
    if ($totalPriceSold === null) {
        $totalPriceSold=0;
    }
    }
    
    if ($result_expenses) {   // get loss result
    $row_expenses = mysqli_fetch_assoc($result_expenses);
    $totalPriceBought = $row_expenses['TotalPriceBought'];
    if ($totalPriceBought === null) {
        $totalPriceBought=0;
    }
    }
    $stats= $totalPriceSold-$totalPriceBought;
    
    $finalres_stats .= "<tr><td>$totalPriceBought</td>"
          . "<td>$totalPriceSold</td>"
          . "<td>$stats</th></tr><tr><th colspan=\"3\"><a href='line-graphe.php?start_date_stats=$start_date_stats&end_date_stats=$end_date_stats'> see visual graphe </a></tr>";

          
  }
  ?>
