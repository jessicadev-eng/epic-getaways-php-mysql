<!DOCTYPE html>
<html>
  <head>
    <title>Checkout</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

  <?php
    session_start();
    $total_price = $_SESSION["total_price"];
  ?>
    <div class="product-container">
      <div class="product-info-container">
        <h1>Payment</h1>
        <p>
            Test Transaction
        </p>
        <p>
         Total Amount $<?php echo number_format($total_price, 2); ?>
         
        </p>
        <input type="hidden" id="total_price" value=<?php echo $total_price; ?> />
      
        <p>*Terms and Conditions Apply</p>
        <div id="smart-button-container">
          <div style="text-align: center;">
            <div id="paypal-button-container"></div>
          </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=AcULvwo7cMXGaGjClSNw_z5Qp3xTCwJR2EOwnqmtzJd5LTlQvsRv7tuprH4u_sym80iMXd50A_FpdkE5&enable-funding=venmo&currency=AUD" data-sdk-integration-source="button-factory"></script>
        <script type="text/javascript" src="js/script.js"></script>
      </div>
    </div>
  </body>
</html>
