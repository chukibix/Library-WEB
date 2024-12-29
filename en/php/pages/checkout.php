<?php 
  require './../functions.php'; 
  require './../checkoutProcess.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CNAM Library</title>


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../../css/extras/bootstrap.min.css" />
  <!-- Site CSS -->
  <link rel="stylesheet" href="../../css/extras/style.css" />
  <!-- Responsive CSS -->
  <link rel="stylesheet" href="../../css/extras/responsive.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../../css/extras/custom.css" />

  <!-- import css and js of main components -->
  <link rel="stylesheet" href="../../css/main.css" />
  <script src="../../js/main.js" defer></script>
</head>

<body onload="loading()">
  <header id="checkout" class="level-3"></header>
  <nav id="navBar"></nav>
  <form id="searchLayer"></form>
  <aside id="menu"></aside>

  <main>
    <form id="checkout-form" class="" action="./../checkoutProcess.php" method="post">
    <!-- Start Cart  -->
    <div class="cart-box-main">
      <div class="container">
        <div class="row">
          
          <div class="col-sm-6 col-lg-6 mb-3">
            <div class="checkout-address">
              <div class="title-left">
                <h3>Billing address</h3>
              </div>
                <form class="needs-validation" novalidate>
                <div class="mb-3">
                  <label for="address2">Address</label>
                  <input type="text" name="address" class="form-control" id="address2" placeholder="" />
                </div>

                <div class="row">
                  <div class="col-md-5 mb-3">
                    <label for="country">Country *</label>
                    <select class="wide w-100" id="country" name="country">
                      <option value="Choose..." data-display="Select" disabled>Choose...</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="France">France</option>
                      <option value="United States">United States</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid country.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="zip">Zip *</label>
                    <input type="text" name="zipCode" class="form-control" id="zip" placeholder="" required />
                    <div class="invalid-feedback">Zip code required.</div>
                  </div>
                </div>
              </form>
              <hr class="mb-4" />
              <div class="col-md-3 mb-3">
                <input id="submit" type="submit" name="submitCheckout" class="ml-auto btn hvr-hover" value="Place Order">
              </div>
                <hr class="mb-4" />
              </div>
            </div>

          <div class="col-sm-6 col-lg-6 mb-3">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="shipping-method-box">
                  <div class="title-left">
                    <h3>Shipping Method</h3>
                  </div>
                  <div class="mb-4">
                    <div>
                      <div class="custom-control custom-radio">
                        <input id="shippingOption1" type="radio" name="shipping-option" class="custom-control-input" value="Delivery" checked="checked"/>
                          <label class="custom-control-label" for="shippingOption1">Standard Delivery</label>
                        <span class="float-right font-weight-bold">$5.00</span>
                      </div>
                      <div class="ml-4 mb-2 small">(2-4 business days)</div>
                    </div>
                    <div class="custom-control custom-radio">
                      <input id="shippingOption3" type="radio" name="shipping-option" class="custom-control-input" value="Pickup" />
                      <label class="custom-control-label" for="shippingOption3">Pickup</label>
                      <span class="float-right font-weight-bold">FREE</span>
                    </div>
                  </div>
                </div>
              </div>
              <hr/>
              <div class="col-md-12 col-lg-12">
                <div class="shipping-method-box">
                  <div class="title-left">
                    <h3>Pay method</h3>
                  </div>
                  <div class="mb-4">
                    <div>
                      <div class="custom-control custom-radio">
                        <input id="payOption3" type="radio" name="pay-option" class="custom-control-input" value="Cash" checked="checked"/>
                        <label class="custom-control-label" for="payOption3">United States Dollar</label>
                        <span class="float-right font-weight-bold">USD</span>
                      </div>
                      <div class="custom-control custom-radio">
                        <input id="payOption1" type="radio" name="pay-option" class="custom-control-input" value="Coins"/>
                          <label class="custom-control-label" for="payOption1">Library Coins</label>
                        <span class="float-right font-weight-bold">LC</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php printOrderInfos() ?>
              
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
  </main>
  
  <footer></footer>
  <?php afficherNom(); ?>
</body>

</html>