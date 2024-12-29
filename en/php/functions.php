<?php
require 'connect.php';

function afficherNom()
{
  global $connection;
  $name = "Login";
  if(isset($_SESSION['Email']) || isset($_COOKIE['Email'])){
    if(isset($_SESSION['Email'])) $email = $_SESSION['Email'];
    if(isset($_COOKIE['Email'])) $email = $_COOKIE['Email'];
    $req = "SELECT `FirstName` FROM `person` WHERE `Email` = '$email'";
    $sel = mysqli_query($connection, $req);
    $row = mysqli_fetch_row($sel);
    $name = $row[0];
  }
  echo ("
    <script>
      setTimeout( () => {
        // here username
        document.querySelector('#profile span').innerHTML = '$name';
        
        // here the icon of the user
        // document.querySelector('#profile img').src; 
      }, 200);
    </script>
  ");
}

function afficherLivres($query)
{
  global $connection;
  $result = mysqli_query($connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_row($result)) {
      $idBook = $row[0];
      $title = iconv('ISO-8859-1','UTF-8',$row[1]);
      $author = iconv('ISO-8859-1','UTF-8',$row[2]);
      $genre = iconv('ISO-8859-1','UTF-8',$row[3]);
      $priceSold = $row[5];
      $quantity = $row[7];
      $publishingHouse = iconv('ISO-8859-1','UTF-8',$row[10]);

      $inStock = 'In Stock';
      $color = 'green';
      if ($quantity == 0) {
        $inStock = 'Out Of Stock';
        $color = 'crimson';
      }
      echo ("
        <fieldset class='search-result'>
            <legend id='result-title'>$title</legend>

            <div class='left'>
            <section class='result-img'>
                <img src='../../media/books/$idBook.webp' alt='item'>
            </section>

            <section class='result-infos'>
                <li>Genre: $genre</li>
                <li>Author: $author</li>
                <li>Pub. House: $publishingHouse</li>
                <li>$priceSold USD</li>
                <li>Quantity: $quantity</li>
                <li style='color:$color;'>$inStock</li>
            </section>
            </div>
            
            <section class='result-details'>
            <a href='./displayBook.php?idBook=$idBook'>more ></a>
            </section>
        </fieldset>
      ");
    }
  } else {
    die('DataBase request error');
  }
}

function afficherLivre($query)
{
  global $connection;
  $result = mysqli_query($connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_row($result)) {
      $idBook = $row[0];
      $title = iconv('ISO-8859-1','UTF-8',$row[1]);
      $author = iconv('ISO-8859-1','UTF-8',$row[2]);
      $genre = iconv('ISO-8859-1','UTF-8',$row[3]);
      $priceSold = $row[5];
      $summary = iconv('ISO-8859-1','UTF-8',$row[6]);
      $quantity = $row[7];
      $likes = $row[8];
      $dislikes = $row[9];
      $publishingHouse = iconv('ISO-8859-1','UTF-8',$row[10]);
      $download = $row[11];
      if ($download === 'TRUE') {
        $link_to_download = "<a href='./admin/DownloadBook.php?book_id=$idBook'>Download(". $row[13] .")</a>";
      } else {
        $link_to_download = "";
      }
      $inStock = 'In Stock';
      $color = 'rgb(19, 204, 19)';
      if ($quantity == 0) {
        $inStock = 'Out Of Stock';
        $color = 'crimson';
      }

      $points = ($likes - $dislikes);

      $favTXT = "";
      $likeTXT = "";
      $cartTXT = "";
      if(isset($_COOKIE['Email']) || isset($_SESSION['Email'])){
        $query_fav = "SELECT * FROM favorite WHERE IdBook = '$idBook' AND Email = '" . $_COOKIE['Email'] . "'";
$result_fav = mysqli_query($connection, $query_fav);
$row_fav = mysqli_fetch_row($result_fav);
$email = $_COOKIE['Email'];

if ($row_fav) {
    $favTXT = "
        <label>Remove from favorites</label>
        <a href='remove_favorite.php?email=".urlencode($email)."&idBook=".$idBook."' >
            <svg width='24px' height='24px' viewBox='0 0 24 24' fill='none'>
                <path d='M12.62 20.81C12.28 20.93 11.72 20.93 11.38 20.81C8.48 19.82 2 15.69 2 8.68998C2 5.59998 4.49 3.09998 7.56 3.09998C9.38 3.09998 10.99 3.97998 12 5.33998C13.01 3.97998 14.63 3.09998 16.44 3.09998C19.51 3.09998 22 5.59998 22 8.68998C22 15.69 15.52 19.82 12.62 20.81Z' stroke='black' stroke-width='1' stroke-linecap='round' stroke-linejoin='round' fill='crimson'/>
            </svg>
        </a>";
} else {
    $favTXT = "
        <label>Add to favorites</label>
        <a href='add_favorite.php?email=".urlencode($email)."&idBook=".$idBook."'>
            <svg width='24px' height='24px' viewBox='0 0 24 24' fill='none'>
                <path d='M12.62 20.81C12.28 20.93 11.72 20.93 11.38 20.81C8.48 19.82 2 15.69 2 8.68998C2 5.59998 4.49 3.09998 7.56 3.09998C9.38 3.09998 10.99 3.97998 12 5.33998C13.01 3.97998 14.63 3.09998 16.44 3.09998C19.51 3.09998 22 5.59998 22 8.68998C22 15.69 15.52 19.82 12.62 20.81Z' stroke='#005257' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' fill='none'/>
            </svg>
        </a>";
}

        $likeTXT = "
          <!-- manipulate colors thru stroke and fill attributes in svg, use rgb(19, 204, 19) as green, crimson as red -->
          <form action='like-dislike.php' id='form-rate'>
            <button type='button' class='like' name='like' onclick='giveLike(this)'>
              <span>Like</span>
              <svg width='24px' height='24px' viewBox='0 0 24 24'>
                <g id='Complete'>
                  <g id='thumbs-up'>
                    <path d='M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10' fill='none' stroke='#005257' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'/>
                  </g>
                </g>
              </svg>
            </button>
            <button type='button' class='dislike' name='dislike' onclick='giveDislike(this)'>
              <span>Dislike</span>
              <svg width='24px' height='24px' viewBox='0 0 24 24'>
                <g id='Complete'><g id='thumbs-down'>

                  <path d='M7.3,12.6,10.1,21a.6.6,0,0,0,.8.3l1-.5a2.6,2.6,0,0,0,1.4-2.3V14.6h6.4a2,2,0,0,0,1.9-2.5l-2-8a2,2,0,0,0-1.9-1.5H4.3a2,2,0,0,0-2,2v6a2,2,0,0,0,2,2h3V2.6' fill='none' stroke='#005257' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'/>
                </g></g>
              </svg>
            </button>
          </form>
        ";

        $cartTXT = "
          <form action='./manageCart.php?idBook=$idBook' method='post' id='form-cart'>
            <label>
              <!-- maximum should change depending on the db, and button submit becomes disabled if its out of stock -->
              <span>Quantity: </span>
              <input name='qtity' type='number' class='quantity' min='1' max='$quantity' maxlength='4' value='1' required/>
            </label>
            <button type='submit' name='addcart'>Add to cart</button>
          </form>
        ";
      }

      echo ("
        <div class='container'>
          <h1 id='book-title' class='aTitle'>$title</h1>
    
          <article id='up'>
            <section id='book-cover'>
              <img src='./../../media/books/$idBook.webp' alt='book-cover'/>
            </section>
      
            <section id='book-infos'>
              <li><b>ID</b>: $idBook</li>
              <li><b>Author</b>: $author</li>
              <li><b>Genre</b>: $genre</li>
              <li><b>Points</b>: $points</li>
              <li><b>Publisher</b>: $publishingHouse</li>
              <li><b>Price</b>: $priceSold $</li>
              <li>$link_to_download</li>
    
              $favTXT
              $likeTXT
    
              <li style='color: $color;'>$inStock</li>
            </section>
          </article>
    
          <section id='book-preferences'>
            <p>$summary</p>
            $cartTXT
          </section>
        </div>
      ");
    }
  }
}

function afficherCommentaires($query)
{
  global $connection;
  if(isset($_COOKIE['Email']) || isset($_SESSION['Email'])){
    echo ("
      <div class='container'>
      <section id='comments'>
      <form action='' id='form-comment'>
        <textarea name='comment' id='comment-text' placeholder='Leave a comment' maxlength='400' rows='3' required></textarea>

        <button type='submit' name='addComment' id='comment-sub' title='add comment' >
          <img src='../../media/images/icons/send.svg' alt='send'>
        </button>
        </form>
    ");
  }

  $result = mysqli_query($connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_row($result)) {
      $email = iconv('ISO-8859-1','UTF-8',$row[0]);
      $comment = iconv('ISO-8859-1','UTF-8',$row[2]);
      $likes = $row[3];

      $res = mysqli_query($connection, "SELECT FirstName, LastName FROM person WHERE email = '$email'");
      $name = mysqli_fetch_row($res);
      $fullName = $name[0] . ' ' . $name[1];

      echo (
        "
            <div class='aComment'>
              <b>Comment by <span>$fullName</span></b>
              <p>
                $comment
              </p>
              <form action='like-dislike.php' id='comment-rate'>
                <button type='button' class='like' name='like-comment' onclick='giveLike(this)'>
                  <svg width='20px' height='20px' viewBox='0 0 24 24'>
                    <g id='Complete'>
                      <g id='thumbs-up'>
                        <path d='M7.3,11.4,10.1,3a.6.6,0,0,1,.8-.3l1,.5a2.6,2.6,0,0,1,1.4,2.3V9.4h6.4a2,2,0,0,1,1.9,2.5l-2,8a2,2,0,0,1-1.9,1.5H4.3a2,2,0,0,1-2-2v-6a2,2,0,0,1,2-2h3v10' fill='none' stroke='#005257' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'/>
                      </g>
                    </g>
                  </svg>
                </button>

                <strong>$likes</strong>
    
                <button type='button' class='dislike' name='dislike-comment' onclick='giveDislike(this)'>
                  <svg width='20px' height='20px' viewBox='0 0 24 24'>
                    <g id='Complete'><g id='thumbs-down'>
    
                      <path d='M7.3,12.6,10.1,21a.6.6,0,0,0,.8.3l1-.5a2.6,2.6,0,0,0,1.4-2.3V14.6h6.4a2,2,0,0,0,1.9-2.5l-2-8a2,2,0,0,0-1.9-1.5H4.3a2,2,0,0,0-2,2v6a2,2,0,0,0,2,2h3V2.6' fill='none' stroke='#005257' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5'/>
                    </g></g>
                  </svg>
                </button>
              </form>
            </div>
            </section>
            </div>
            "
      );
    }
  }
}

function afficherCart()
{
  global $connection;

  if(isset($_SESSION['cart'])){
    for($i = 0; $i <= count($_SESSION['cart']); $i++){
      if(isset($_SESSION['cart'][$i])){
        $selectedBook = $_SESSION['cart'][$i];
        $res = explode('_', $selectedBook);
        $idBook = $res[0];
        $quantity = $res[1];

        $req = mysqli_query($connection, "SELECT * FROM book WHERE idBook = '$idBook'");
        $row = mysqli_fetch_row($req);
        $title = iconv('ISO-8859-1','UTF-8',$row[1]);
        $priceSold = $row[5];
        $quantityInStock = $row[7];

        echo("
          <div id='product__wrapper'>
          <section class='item'>
            <div class='image'>
              <img
                src='./../../../media/books/$idBook.webp'
                alt='{{book_name}}'
                width='200'
                height='300'
              />
            </div>

            <article class='description'>
              <div class='labels'>$title</div>
            </article>
            <article class='one-price'>
              <div class='labels'>
                Price:
              </div>
              <div class='price'>
                $<span>$priceSold</span>
              </div>
            </article>
            <article class='quantity'>
              <div class='labels'>Quantity:</div>
              <div class='quanDesign'>
              <a id='' class='' href='./../manageCart.php?book=$selectedBook&changeQtM=$quantity'><button class='quantity__modifier'>-</button></a>

                <input
                  type='text'
                  class='currentQuantity quantity__modifier'
                  onchange='updateQuantity(this)'
                  value='$quantity'
                  pattern='[0-9]+'
                />

                <a id='' class='' href='./../manageCart.php?book=$selectedBook&changeQtP=$quantity&quantity=$quantityInStock'><button class='quantity__modifier'>+</button></a>
              </div>
            </article>
            <article class='total-price'>
              <div class='labels'>SubTotal:</div>
              <div class='price'>
                $<span>{{ subtotal }}</span>
              </div>
            </article>
            <article id='remove'><a href='./../manageCart.php?bookToRemove=$selectedBook'>Remove from cart</a></article>
          </section>
          </div>
        ");
      }
    }
  }
}


function afficherCartCheckout()
{
  if(isset($_SESSION['cart'])){
    if(!empty($_SESSION['cart'])){
      echo ("
        <script>
          // this async function injects the 'checkout' inside the navbar after 100ms
          setTimeout(() => {
            document.querySelector('nav').innerHTML += `
              <div class='forCheck'>
                <section class='goToCheckout'>
                  <a href='./checkout.php'>CHECKOUT</a>
                </section>
              </div>
            `;
          }, 100);
        </script>
      ");
    }
  }
}

//favorite book function
function afficherLivresfav($query)
{
  global $connection;
  $result = mysqli_query($connection, $query);
  if ($result) {
    while ($row = mysqli_fetch_row($result)) {
      $idBook = $row[0];
      $title = iconv('ISO-8859-1','UTF-8',$row[1]);
      $author = iconv('ISO-8859-1','UTF-8',$row[2]);
      $genre = iconv('ISO-8859-1','UTF-8',$row[3]);
      $priceSold = $row[5];
      $quantity = $row[7];
      $publishingHouse = iconv('ISO-8859-1','UTF-8',$row[10]);

      $inStock = 'In Stock';
      $color = 'green';
      if ($quantity == 0) {
        $inStock = 'Out Of Stock';
        $color = 'crimson';
      }
      echo ("
        <fieldset class='search-result'>
            <legend id='result-title'>$title</legend>

            <div class='left'>
            <section class='result-img'>
                <img src='../../../media/books/$idBook.webp' alt='item'>
            </section>

            <section class='result-infos'>
                <li>Genre: $genre</li>
                <li>Author: $author</li>
                <li>Pub. House: $publishingHouse</li>
                <li>$priceSold USD</li>
                <li>Quantity: $quantity</li>
                <li style='color:$color;'>$inStock</li>
            </section>
            </div>
            
            <section class='result-details'>
            <a href='../displayBook.php?idBook=$idBook'>more ></a>
            </section>
        </fieldset>
      ");
    }
  } else {
    die('DataBase request error');
  }
}
?>