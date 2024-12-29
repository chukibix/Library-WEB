<?php
require "./connect.php";
session_start();

if(isset($_POST['register'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $bDay = $_POST['birthDate'];
    $country = $_POST['country'];
    $addr = $_POST['address'];
    $countryNumb = $_POST['country_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pw = $_POST['password'];
    
    $sel = mysqli_query($connection, "SELECT * FROM person WHERE Email = '$email'");
    $row = mysqli_fetch_array($sel);
    if($row != NULL){
        die("Error, This Email is already registered");
    }
    else{
        switch ($country){
            case "Lebanon": 
                $country = "Lebanese";
                $countryNumb = "961"; break;
            case "France": 
                $country = "French";
                $countryNumb = "33"; break;
            case "USA": 
                $country = "American";
                $countryNumb = "1"; break;
        }
        $phone = $countryNumb . "" . $phone;

        $req = "
            INSERT INTO `person` (Email, FirstName, LastName, Nationality, Phone, Address, password)
            VALUES ('$email', '$fname', '$lname', '$country', '$phone', '$addr', '$pw')
        ";
        mysqli_query($connection, $req);
        $req = "
            INSERT INTO `client` (Email, BirthDate)
            VALUES ('$email', '$bDay')
        ";
        mysqli_query($connection, $req);
        header("Location: ./../account/login.php");
        die();
    }
}

if(isset($_POST['login'])){
    $error = "";
    $email = $_POST['email'];
    $pw = $_POST['password'];

    $req = "SELECT Password FROM person WHERE Email = '$email'";
    $sel = mysqli_query($connection, $req);
    $row = mysqli_fetch_row($sel);
    if($row[0] != null){
        if($pw == $row[0]){
            $expire_time = time() + (12*24*3600); // 12 days of cookies for login
            setcookie('Email', $email, $expire_time, '/');
            $_SESSION['Email'] = $email;

            $req_cli = "SELECT * FROM client WHERE Email = '$email'";
            $sel_cli = mysqli_query($connection, $req_cli);
            $row_cli = mysqli_fetch_row($sel_cli);
            $type = $row_cli[2];
            if($type == 'admin'){
                $_SESSION['loggedin']=1;
            }
            header("location: ./../account/profile.php");
            die();
        } else{
            $error = "Incorrect-Password";
            header("location: ./../account/login.php?error=$error");
            die();
        }  
    } else{
        $error = "Incorrect_Email";
        header("location: ./../account/login.php?error=$error");
        die();
    }
     
    
}
?>