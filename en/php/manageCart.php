<?php
    session_start();
    if(isset($_POST['addcart'])){
        $idBook = $_GET['idBook'];
        $quantity = $_POST['qtity'];
        $add = true;

        if(isset($_SESSION['cart'])){
            do{
                $flag = true;
                for($i = 0; $i < count($_SESSION['cart']); $i++){
                    $rows = explode('_', $_SESSION['cart'][$i]);
                    if($rows[0] == $idBook){
                        $flag = false;
                        break;
                    }
                }
                if($flag == false) $add = false;
                break;
            }while($flag);
        }

        if($add) $_SESSION['cart'][] = $idBook."_".$quantity;
        header("Location: ./displayBook.php?idBook=$idBook");
        die();
    }

    if(isset($_GET['bookToRemove'])){
        for($i = 0; $i <= count($_SESSION['cart']); $i++){
            if($_SESSION['cart'][$i] == $_GET['bookToRemove']){
                unset($_SESSION['cart'][$i]);
                break;
            }
        }
        header("Location: ./pages/cart.php");
        die();
    }

    if(isset($_GET['changeQtM'])){
        $details = $_GET['book'];
        $qt = 1;
        $newQt = $_GET['changeQtM'];
        if($newQt > 1)
            $newQt = --$_GET['changeQtM'];
        
        $row = explode('_', $details);
        $res = $row[0]."_".$newQt;
        
        for($i = 0; $i < count($_SESSION['cart']); $i++){
            if($_SESSION['cart'][$i] == $details)
                $_SESSION['cart'][$i] = $res;
            }
        header("Location: ./pages/cart.php");
        die();
    }
    if(isset($_GET['changeQtP'])){
        $details = $_GET['book'];
        $qt = $_GET['quantity'];

        $newQt = $_GET['changeQtP'];
        if($_GET['changeQtP'] < $qt)
            $newQt = ++$_GET['changeQtP'];
        
        $row = explode('_', $details);
        $res = $row[0]."_".$newQt;
        
        for($i = 0; $i < count($_SESSION['cart']); $i++){
            if($_SESSION['cart'][$i] == $details)
                $_SESSION['cart'][$i] = $res;
            }
        header("Location: ./pages/cart.php");
        die();
    }
?>