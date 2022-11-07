
<?php
session_start();
$grandTotal = $_POST['grandTotalPrice'];
$address = $_POST['address'];

include 'database.php';
$date = date('d-m-y h:i:s');
$orderStatus = 'processing';

$payment = "cash on delivery";
$orderid = 0;
$take = "insert into order_table (orderDate,orderStatus,grandTotalPrice,userID, payment, address)"
        . "Values('$date','$orderStatus',$grandTotal, {$_SESSION['userID']}, '$payment','$address' )";
if (mysqli_query($database, $take)) {
    $sql = "SELECT * FROM order_table ORDER BY orderID DESC LIMIT 1;";
    $result = $database->query($sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $orderid = $row["orderID"];
        }
    }

    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $_SESSION['userID']) {

//            $sql = "select * from products_table where productID ='{$_SESSION['cart'][$i][1]}'";
//
//            $checkResult = $database->query($sql);
//
//            while ($row = $checkResult->fetch_assoc()) {
//                $row['name'];
//            }

            $insert = "insert into orderdetail_table (productID,quantity,price, totalPrice, orderID)"
                    . "Values({$_SESSION['cart'][$i][1]},{$_SESSION['cart'][$i][4]},{$_SESSION['cart'][$i][3]}, {$_SESSION['cart'][$i][5]}, $orderid )";
            mysqli_query($database, $insert);
        }
        $count++;
    }

    unset($_SESSION["cart"]);
    $database->close();
    header("Location:shopcart.php");
} else {
    
}
?>

</head>
<!--
<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <a href="home_page.php"><img class="d-block mx-auto mb-4" src="Bun/Logo.png" alt="" width="30%"></a>
      <h2>Checkout form</h2>
     
    </div>



      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>


        <form class="needs-validation" novalidate section="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $firstName ?>">
              <span class="error"><?php //echo $firstNameErr;               ?></span>

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $lastName ?>">
              <span class="error"><?php //echo $lastNameErr;               ?></span>

            </div>
          </div>

          <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>

              </div>
              <input type="text" class="form-control" id="username" name="userName" value='<?php echo $username ?>' disabled placeholder="">

            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email <span class="text-muted"></span></label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" placeholder="johnnysins@example.com">
            <span class="error"><?php // echo $emailErr;               ?></span>


          </div>

          <div class="mb-3">
            <label for="username">Contact Number</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">MY +60</span>

              </div>
              <input type="text" class="form-control" id="contactNum" name="contactNum" value='<?php echo $contactNum ?>' placeholder="12-1234567">

            </div>
            <span class="error"><?php //echo $contactNumErr;               ?></span>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>" placeholder="24, Jalan Langkawi">
            <span class="error"><?php //echo $addErr;               ?></span>
          </div>


          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" name="country" id="country">
                <option value="M">Malaysia</option>
              </select>
            </div>

            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" id="state" name="state">
                <option value="Ked">Kedah</option>";
              </select>
            </div>

            <div class="col-md-3 mb-3">
              <label for="zip">Postcode</label>
              <input type="text" class="form-control" id="zip" name="postcode" value="<?php echo $postcode ?>" maxlength="5" placeholder="01400">
              <span class="error"><?php //echo $postcodeErr;               ?></span>

            </div>

            <div class="col-md-3 mb-3">
              <label for="deliveryMethod">Delivery Method</label>
              <select class="custom-select d-block w-100" id="deliveryMethod" name="deliveryMethod">
                <option value="Food Panda" <?php
//if (!empty($_POST['submit'])) {
//if ($deliveryMethod == 'Food Panda') echo 'selected';
?>>Food Panda</option>
                <option value="Grab Food" <?php
//if (!empty($_POST['submit'])) {
// if ($deliveryMethod == 'Grab Food') echo 'selected';
?>>Grab Food</option>
              </select>
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="shipAdd" value="shipAdd" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">Shipping address is the same as billing address</label>
          </div>
          <hr class="mb-4">


          <h4 class="mb-3">Payment</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" value="credit" type="radio" class="custom-control-input" <?php
//if (!empty($_POST['submit'])) {
//   if ($paymentMethod == 'credit') echo 'checked';
//} else {
//  echo 'checked';
// } 
?>>
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" value="debit" type="radio" class="custom-control-input" <?php
//if (!empty($_POST['submit'])) {
//   if ($paymentMethod == 'debit') echo 'checked';
//   } 
?>>
              <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" value="cash" type="radio" class="custom-control-input" <?php
// if (!empty($_POST['submit'])) {
//    if ($paymentMethod == 'cash') echo 'checked';
//  } 
?>>
              <label class="custom-control-label" for="paypal">Cash on Delivery</label>
            </div>
            <span class="error"><?php //echo $paymentMethodErr;              ?></span>
          </div>
          <label for="" style="font-weight: bold;">(If payment method is either credit or debit card)<span class="text-muted">(Optional)</span></label>
          <div class="row">

            <div class="col-md-6 mb-3">

              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cardName" placeholder="TAN AH GAU">
              <small class="text-muted">Full name as displayed on your debit/credit card</small><br>
              <span class="error"><?php //echo $cardNameErr;               ?></span>

            </div>
            <div class="col-md-6 mb-3">

              <label for="cc-name">Card Type</label>
              <select class="form-control" id="cc-name" name="cardType">
                <option value="visa" <?php
// if (!empty($_POST['submit'])) {
// if ($cardType == 'visa') echo 'selected';
//   } 
?>>Visa</option>
                <option value="mastercard" <?php
//if (!empty($_POST['submit'])) {
//     if ($cardType == 'mastercard') echo 'selected';
//  } 
?>>MasterCard</option>
              </select>
              <span class="error"><?php // echo $cardTypeErr;             ?></span>
            </div>

            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" name="cardNum" placeholder="1234 1234 1234 1234" maxlength="19">
              <span class="error"><?php //echo $cardNumErr;               ?></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Exp Month</label>
              <input type="text" class="form-control" id="cc-expireMon" maxlength="2" name="expireMon" placeholder="10">
              <span class="error"><?php // echo $cardExpMonthErr;               ?></span>
              <span class="error"><?php // echo $expireMsg;               ?></span>
            </div>

            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Exp Year</label>
              <input type="text" class="form-control" id="cc-expireYear" maxlength="2" name="expireYear" placeholder="20">
              <span class="error"><?php // echo $cardExpYearErr;               ?></span>

            </div>

            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV </label>
              <input type="text" class="form-control" name="cvv" maxlength="3" id="cc-cvv" placeholder="331">
              <span class="error"><?php //echo $cardCvvErr;               ?></span>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" name="submit" value="submit" type="submit">Confirm</button>
        </form>
      </div>
    </div>-->