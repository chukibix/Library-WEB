<?php
session_start();
//Include necessary files to draw line chart
require ('src/jpgraph.php');
require ('src/jpgraph_line.php');
$check_log = $_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
  header("Location: ./../../account/login.php");
} else {
require './../connect.php';
$start_date_stats = isset($_GET['start_date_stats']) ? $_GET['start_date_stats'] : '';

    $end_date_stats = isset($_GET['end_date_stats']) ? $_GET['end_date_stats'] : '';
    $query_expenses="SELECT b.PriceBought * s.Quantity_s AS TotalPriceBought FROM book b JOIN supply s ON b.IdBook = s.IdBook ";
    $query_gains="SELECT b.PriceSold * bu.Quantity_b AS TotalPriceSold FROM book b JOIN buy bu ON b.IdBook = bu.IdBook ";
    
    
    if (!empty($start_date_stats) && $start_date_stats !== '0000-00-00') {
        $query_expenses.= " WHERE Date_s >= '$start_date_stats' ";
        $query_gains.= " WHERE Date >= '$start_date_stats' ";

    }
    if (!empty($end_date_stats) && $end_date_stats !== '0000-00-00') {
        if($query_expenses ==="SELECT b.PriceBought * s.Quantity_s AS TotalPriceBought FROM book b JOIN supply s ON b.IdBook = s.IdBook "){
            $query_expenses .= " WHERE Date_s <= '$end_date_stats' ";
            $query_gains .= " WHERE Date <= '$end_date_stats' ";
        }else{
      $query_expenses .= " AND Date_s <= '$end_date_stats' ";
      $query_gains .= " AND Date <= '$end_date_stats' ";
        }
    }

     $result_gains = mysqli_query($connection, $query_gains);
    $result_expenses = mysqli_query($connection, $query_expenses);

    $data_gains=array();
    $r_gains=mysqli_num_rows($result_gains);
for($i=0;$i<$r_gains;$i++){   // get gains result
    $row_gains = mysqli_fetch_assoc($result_gains);
    $totalPriceSold = $row_gains['TotalPriceSold'];
    if ($totalPriceSold === null) {
        $totalPriceSold=0;
    }
    $data_gains[$i]=$totalPriceSold;
  }
     

    $data_expenses = array();
$r_expenses = mysqli_num_rows($result_expenses);

for ($i = 0; $i < $r_expenses; $i++) {
    // Get expenses result
    $row_expenses = mysqli_fetch_assoc($result_expenses);
    $totalPriceBought = $row_expenses['TotalPriceBought'];

    if ($totalPriceBought === null) {
        $totalPriceBought = 0;
    }

    $data_expenses[$i] = $totalPriceBought;
}
//Declare the graph object
$graph = new Graph(700, 550);
// Clear all
$graph->ClearTheme();
// Set the scale
$graph->SetScale('textlin');
// Set the linear plot
$linept1 = new LinePlot($data_gains);
$linept2 = new LinePlot($data_expenses);
// Set the line color
$linept1->SetColor('green');
$linept2->SetColor('red');
// Add the plot to create the chart
$graph->Add($linept1);
$graph->Add($linept2);
// Set y min
$graph->yscale->SetAutoMin(0);
// Display the chart
$graph->Stroke();

    }