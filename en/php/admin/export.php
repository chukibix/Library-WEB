<?php  
session_start();
$check_log = $_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
  header("Location: ./../../account/login.php");
} else {
require './../connect.php';
$output = '';
$query=$_GET['query'];
echo $query;
$result = mysqli_query($connection, $query);
if($result){
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table  bordered="1">  
                    <tr>  
                         <th>Order ID</th>  
                         <th>Book ID</th>  
                         <th>Email of customer</th>  
                         <th>Date of purchase</th>  
                         <th>Quantity</th>  
                         
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $output .= 
    "<tr><td>" . $row['IdBuy'] . "</td>"
          . "<td>" . $row['IdBook'] . "</td>"
          . "<td>" . $row['Email'] . "</td>"
          . "<td>" . $row['Date'] . "</td>"
          . "<td>" . $row['Quantity_b'] . "</td></tr>";
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  //The Content-Type header is used to indicate the media type of the resource. The media type is a string sent
  // along with the file indicating the format of the file.
  header('Content-Disposition: attachment; filename=buyer_report.xls');
  //In a standard HTTP response, the Content-Disposition header dictates whether the content is displayed
  // in the browser or,instead, made available as an attachment to be downloaded to local storage.
  echo $output;
 }
}echo "<h2>Error: " . mysqli_error($connection) . "</h2>";
}
?>