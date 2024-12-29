<?php
session_start();
$check_log=$_SESSION['loggedin'];
if (!isset($check_log) || $check_log != 1) {
    header("Location: ./../../account/login.php");  
}else{
include './../connect.php';
$book_searched=$_GET['book'];//to keep the content of the table
$book_to_update = $_GET['IdBook'];
$query = "select * from book where IdBook=$book_to_update";
$result = mysqli_query($connection, $query);
if ($result) {
  $row = mysqli_fetch_assoc($result);
   
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CNAM Library</title>

    <!-- import css -->
    <link rel="stylesheet" href="../../css/main.css" />
    <link rel="stylesheet" href="../../css/for-updatebk.css" />

    <!-- import JavaScript -->
    <script type="text/javascript" src="../../js/main.js" defer></script>
  </head>

  <body>
    <header id="home" class="level-3"></header>
    <nav id="navBar"></nav>
    <form id="searchLayer"></form>
    <aside id="menu"></aside>

    <main>
      <form action="UpdateBook2.php" name="UpdateForm" method="POST" >
        <h1 class="aTitle">Update a book</h1>
        <input type="hidden" value="<?php echo $book_searched;?>" name="book_searched">
        <label>
                book ID your changing:<input type="text" name="idbook" value="<?php echo $row['IdBook'];?>" readonly>
            </label>
            <label>
                Title:<input type="text" name="title" value="<?php echo(iconv('ISO-8859-1', 'UTF-8', $row['Title'])); ?>" required="">
            </label><br/>
            <label>
                Genre:<input type="text" value="<?php echo $row['Genre'];?>" name="genre" required="">
            </label><br/>
            <label>
                Author:<input type="text" value="<?php echo $row['Author'];?>" name="author" required="">
            </label><br/>
            <label>
                Summary:<textarea name="summary" rows="4" cols="40"required=""><?php echo $row['Summary'];?>"</textarea>
            </label><br/>
            <label>
                Publishing House:<input type="text" name="phouse" value="<?php echo $row['PublishingHouse'];?>" required="">
            </label><br/>
            <label>
                Price bought for:<input type="number" name="pbought" value="<?php echo $row['PriceBought'];?>" required="">
            </label><br/>
            <label>
                Price sold for:<input type="number" name="psold" value="<?php echo $row['PriceSold'];?>" required="">
            </label><br/>
            <label>
                Quantity:<input type="number" name="quantity" value="<?php echo $row['Quantity'];?>" required="">
            </label><br/>
            <input type="submit" name="AddBook" value="Update">
            <input type="reset" value="Clear All">
        </form>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label>
                Select image to upload(webp ONLY):
                <input type="file" name="myfile">
            </label>
                <input type="hidden" name="book_searched" value="<?php echo $book_searched; ?>">
                <input type="hidden" name="idbook" value="<?php echo $row['IdBook'];?>" readonly>
                <input type="submit" name="AddBookCover" value="CONFIRM">
                <input type="reset" value="Clear">
        </form>
        <form method="POST" action="uploadbook.php" enctype="multipart/form-data">
            <label>
                Select a pdf to upload(PDF ONLY):
                <input type="file" name="myfile2">
            </label>
            <input type="hidden" name="book_searched" value="<?php echo $book_searched; ?>">
            <input type="hidden" name="idbook" value="<?php echo $row['IdBook'];?>" readonly>
            <input type="submit" name="AddBookPDF" value="CONFIRM">
            <input type="reset" value="Clear ">
        </form>
    </main>

    <footer></footer>
  </body>

  </html>
  <?php
}
}
?>