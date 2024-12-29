<?php

if(isset($_GET['book_id'])&&!empty($_GET['book_id']))
{
    require './../connect.php';
   $idbook_b=$_GET['book_id'];
   $sqlq="select * from book where IdBook=$idbook_b";
   $resq= mysqli_query($connection,$sqlq);
   $book_d= mysqli_fetch_assoc($resq);
   $filepath='./../../../media/uploaded/books/'.$idbook_b.'.pdf';
   if(file_exists($filepath))
   {
       header('Content-Type:application/octet-stream');
       header('Content-Description:File-Transfer');
       header('Content-Disposition:attachment; filename='. basename($filepath));
       header('Expire:0');
       header('Catch-Control:must-revalidate');
       header('prgma:public');
       header('Content-Length:' . filesize('./../../../media/uploaded/books/'.$idbook_b.'.pdf'));
       readfile('./../../../media/uploaded/books/'.$idbook_b.'.pdf');
       $newcount=$book_d['Downloads']+1;
       $updatequery="update book set Downloads=$newcount where IdBook=$idbook_b";
       $resu= mysqli_query($connection, $updatequery);
       exit;
   }
   //}
}
header("location:'../displayBook.php'");
?>

