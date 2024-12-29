<?php
session_start();
require 'connect.php';

function printOrderInfos()
{
    global $connection;
    $result = "
        <div class='col-md-12 col-lg-12'>
        <div class='odr-box'>
        <div class='title-left'>
            <h3>Shopping cart</h3>
        </div>
        <div class='rounded p-2 bg-light'>
    ";
    if(!empty($_SESSION['cart']))
    {
        $totalPrice = 0;
        for($i = 0; $i <= count($_SESSION['cart']); $i++)
        {
            if(isset($_SESSION['cart'][$i])){
                $details = explode('_', $_SESSION['cart'][$i]);
                $idBook = $details[0];
                $quantity = $details[1];
    
                $request = "SELECT title, priceSold FROM book WHERE idBook = '$idBook'";
                $select = mysqli_query($connection, $request);
                while($row = mysqli_fetch_row($select))
                {
                    $title = iconv('ISO-8859-1','UTF-8',$row[0]);
                    $price = $row[1];
                    $subTotal = $quantity * $price;
                    $totalPrice += $subTotal;
                    $result .= "
                        <div class='media mb-2 border-bottom'>
                        <div class='media-body'>
                            <a href='./displayBook.php?idBook=$idBook'> $title</a>
                            <div class='small text-muted'>
                            Price: $$price <span class='mx-2'>|</span> Qty: $quantity
                            <span class='mx-2'>|</span> Subtotal: $$subTotal
                            </div>
                        </div>
                        </div>
                    ";
                }
            }
        }

        $result .= "</div> </div> <br/> </div>";
        $result .= "
            <div class='col-md-12 col-lg-12'>
                <div class='odr-box'>
                    <div class='title-left'>
                        <h3>Your order</h3>
                    </div>
                    <div class='d-flex'>
                        <h4>Sub Total *without shipping cost</h4>
                        <div class='ml-auto font-weight-bold'>$ $totalPrice</div>
                </div>
            </div>
        ";
    }
    echo $result;
}

if(isset($_POST['submitCheckout']))
{
    $email = "";
    $flag = false;
    if(isset($_SESSION['Email'])){
        $email = $_SESSION['Email'];
        $flag = true;
    }if(isset($_COOKIE['Email'])){
        $email = $_COOKIE['Email'];
        $flag = true;
    }
    if($flag){
        $address = $_POST['address'];
        $country = $_POST['country'];
        $zipCode = $_POST['zipCode'];
        $shippingMethod = $_POST['shipping-option'];
        $payMethod = $_POST['pay-option'];
        $date = date('Y-m-d');
        $success = true;

        for($i = 0; $i < count($_SESSION['cart']); $i++)
        {
            $details = explode("_", $_SESSION['cart'][$i]);
            $idBook = $details[0];
            $quantity = $details[1];

            $select = "SELECT `PriceSold` FROM `Book` WHERE `IdBook` = '$idBook'";
            $result = mysqli_query($connection, $select);
            $row = mysqli_fetch_row($result);
            $fees = $quantity * $row[0];

            $request = "
                INSERT INTO `buy` (`Email`, `IdBook`, `Date`, `Quantity_b`, `Address`, 
                8`Country`, `Zip`, `Method`, `Service`, `Fees`) VALUES
                ('$email', '$idBook', '$date', '$quantity', '$address', 
                '$country', '$zipCode', '$payMethod', '$shippingMethod', '$fees')
            ";
            $result = mysqli_query($connection, $request);
             
            //update the db quantity of the book bought
            $request2 ="UPDATE `book` SET `Quantity` =  `Quantity` - $quantity WHERE `IdBook` = $idBook";
            $result2 = mysqli_query($connection, $request2);
            
             if (!$result && !$result2) {
                $errorMessage = mysqli_error($connection);
                echo "Error: " . $errorMessage;
                $success = false; // Set flag to false if there is an error
            }
        }
        if ($success) {
            for($i = 0; $i < count($_SESSION['cart']); $i++){
                unset($_SESSION['cart'][$i]);
            }
            header("Location: ./../../index.php");
            die();
        }else{echo "there was an error. try again";}
    }
}

?>