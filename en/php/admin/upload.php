<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
if(isset($_POST['AddBookCover'])&&!empty($_POST['AddBookCover']))
{
include'./../connect.php';
$book_searched = $_POST['book_searched'];
$idbook=$_POST['idbook'];
$filename=$_FILES['myfile']['name'];
$destination='./../../../media/books/'.$idbook.'.webp';  // PATHH TO FOLDER!!!
$extention= pathinfo($filename,PATHINFO_EXTENSION);
$file=$_FILES['myfile']['tmp_name'];
$size=$_FILES['myfile']['size'];
if(!in_array($extention,['webp','jpg']))
{
    echo"your file extention must be:['webp']";
}
 elseif($_FILES['myfile']['size']>20000000) 
 {
 echo"file is too large";   
 }
 else
 {
     if(move_uploaded_file($file,$destination))
     {
             echo"file uploaded successfully";
             header("location:Management.php?book=$book_searched");
     }
     else {"error moving file to the server";
 }
}
}
}
?>


