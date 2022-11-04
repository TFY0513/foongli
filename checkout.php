<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Checkout</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

  <!-- Bootstrap core CSS -->
  <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="bs/bootstrap.bundle.js"></script>

  <style>
    .success {
      color: #339900;
    }

    .error {
      color: red;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet" type="text/css" />

  <?php
  $username = $_REQUEST['Username'];
  $grandTotal = $_REQUEST['GrandTotal'];
  $numberCart = $_REQUEST['Count'];


  $confirm = "";
  $msg = $firstNameErr = $lastNameErr = $userNameErr = $emailErr = $contactNumErr = $addErr = $postcodeErr = $paymentMethodErr = "";
  $cardNameErr = $cardTypeErr = $cardNumErr = $cardExpMonthErr = $cardExpYearErr = $cardCvvErr = $expireMsg = "";

  $firstName = $lastName = $email = $contactNum = $address = $postcode = $deliveryMethod = $paymentMethod = "";
  $cardName = $cardType = $cardNum = $expireMon = $expireYear = $cvv = "";

  $countCart = 1;
  $empty = 0;
  $invalid = 0;
  $invalidMon = 0;
  $invalidYear = 0;

  //If submit
  if (isset($_POST['submit'])) {
    //

    if (empty($_POST['firstName'])) {
      $empty = 1;
      $firstNameErr = "This field is required !";
    } else {
      $firstName = $_POST['firstName'];
      //Alphabets
      if (!preg_match("/^[a-z ,.'-]+$/i", $firstName)) {
        $invalid = 1;
        $firstNameErr = "Invalid first name";
      }
    }
    if (empty($_POST['lastName'])) {
      $empty = 1;
      $lastNameErr = "This field is required !";
    } else {
      $lastName = $_POST['lastName'];
      //Alphabets
      if (!preg_match("/^[a-z ,.'-]+$/i", $lastName)) {
        $invalid = 1;
        $lastNameErr = "Invalid last name";
      }
    }
    if (empty($_POST['email'])) {
      $empty = 1;
      $emailErr = "This field is required !";
    } else {
      $email = $_POST['email'];
      //Check email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Invalid email format';
        $invalid = 1;
      }
    }
    if (empty($_POST['contactNum'])) {
      $empty = 1;
      $contactNumErr = "This field is required !";
    } else {
      $contactNum = $_POST['contactNum'];
      if (!preg_match("/1\d-\d{7,8}/", $contactNum)) {
        $contactNumErr = 'Invalid contact number format';
        $invalid = 1;
      }
    }
    if (empty($_POST['address'])) {
      $empty = 1;
      $addErr = "This field is required !";
    } else {
      $address = $_POST['address'];
    }
    if (empty($_POST['postcode'])) {
      $empty = 1;
      $postcodeErr = "This field is required !";
    } else {
      $postcode = $_POST['postcode'];
      //Check if 5-digit & letter only
      if (!preg_match("/^\d{5}$/", $postcode)) {
        $invalid = 1;
        $postcodeErr = "Invalid postcode !";
      }
    }
    if (empty($_POST['paymentMethod'])) {
      $empty = 1;
      $paymentMethodErr = "This field is required !";
    } else {
      $paymentMethod = $_POST['paymentMethod'];
      //Check if 5-digit & letter only
      if ($paymentMethod != "credit" && $paymentMethod != "debit" && $paymentMethod != "cash") {
        $invalid = 1;
        $paymentMethodErr = "Invalid payment method !";
      }
    }

    if ($paymentMethod == "credit" || $paymentMethod == "debit") {
      if (empty($_POST['cardName'])) {
        $empty = 1;
        $cardNameErr = "This field is required !";
      } else {
        $cardName = $_POST['cardName'];
        //Check for consist alphabets only
        if (!preg_match("/^[A-Z ,.'-]+$/i", $cardName)) {
          $invalid = 1;
          $cardNameErr = "Invalid card name !";
        }
      }
      if (empty($_POST['cardType'])) {
        $empty = 1;
        $cardTypeErr = "This field is required !";
      } else {
        $cardType = $_POST['cardType'];
        //Check card type 
        if ($cardType != "visa" && $cardType != "mastercard") {
          $invalid = 1;
          $cardTypeErr = "Invalid card type !";
        }
      }

      if (empty($_POST['cardNum'])) {
        $empty = 1;
        $cardNumErr = "This field is required !";
      } else {
        $cardNum = $_POST['cardNum'];
        //Check if consist alphabets only
        if (!empty($_POST['cardType'])) {

          //check credit card number format
          if (!preg_match("/^\d{4} \d{4} \d{4} \d{4}$/", $cardNum)) {
            $invalid = 1;
            $cardNumErr = "Invalid credit card number !";
          }
        } else {
          $empty = 1;
        }
      }
      if (empty($_POST['expireMon'])) {
        $empty = 1;
        $cardExpMonthErr = "This field is required !";
      } else {
        $expireMon = $_POST['expireMon'];
        //2 digits only, check by Date function
        if (!preg_match("/^\d{2}$/", $expireMon)) {
          $invalid = 1;
          $invalidMon = 1;
          $cardExpMonthErr = "Must in 2-digit !";
        }
        //check for valid months
        if ($expireMon < 1 || $expireMon > 12) {
          $invalid = 1;
          $cardExpMonthErr = "Invalid month !";
        }
      }
      if (empty($_POST['expireYear'])) {
        $empty = 1;
        $cardExpYearErr = "This field is required !";
      } else {
        $expireYear = $_POST['expireYear'];
        //2 digits only, check by Date function
        if (!preg_match("/^\d{2}$/", $expireYear)) {
          $invalid = 1;
          $invalidYear = 1;
          $cardExpYearErr = "Must in 2-digit !";
        }
        if ($expireYear < 5) {
          $invalid = 1;
          $cardExpYearErr = "Invalid Year !";
        }
      }

      //Check for previous dates
      if (!empty($_POST['expireMon']) && !empty($_POST['expireYear'])) {
        if ($invalidMon != 1 && $invalidYear != 1) {
          //Set Date
          $expires = \DateTime::createFromFormat('m/y', $expireMon . '/' . $expireYear);
          //Get Date to parse in table
          $now     = new \DateTime();

          if ($expires < $now) {
            $invalid = 1;
            $expireMsg = "Expire already !";
          }
        }
      }

      if (empty($_POST['cvv'])) {
        $empty = 1;
        $cardCvvErr = "This field is required !";
      } else {
        $cvv = $_POST['cvv'];
        if (!preg_match("/^\d{3}$/", $cvv)) {
          $invalid = 1;
          $cardCvvErr = "Invalid cvv code !";
        }
      }
    }

    if ($empty == 1) {
      $msg = "All field are required";
    }
    if ($invalid == 0 && $empty == 0) { // If theres no error, pass the value to addOrder.php to update values in the table
      $confirm = "Yes";
      header("Location:addOrder.php?Confirm={$confirm}&Username={$username}&firstName={$firstName}&lastName={$lastName}&email={$email}&contactNum={$contactNum}&address={$address}");
    }
  }
  ?>

</head>

<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <a href="home_page.php"><img class="d-block mx-auto mb-4" src="Bun/Logo.png" alt="" width="30%"></a>
      <h2>Checkout form</h2>
      <?php
      if ($empty == 1) {
        echo  "<span class='error'>";
        echo  $msg;
        echo  "</span>";
      } else {
        echo  "<span class='success'><?php echo $msg;?></span>";
      }
      ?>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>

          <span class="badge badge-secondary badge-pill"><?php echo $numberCart ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php
          $db = new mysqli('localhost', 'root', '', 'assignment');
          if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
          }

          $displayCart = "select * from shopcart where username = '$username' AND confirmOrder='havent'";

          $check = $db->query($displayCart);
          while ($row = $check->fetch_assoc()) {
            echo "<li class='list-group-item d-flex justify-content-between lh-condensed'>";
            echo " <div>";
            echo "<h6 class='my-0'>{$row['prodName']}</h6>";
            echo "   </div>";
            echo "<span class='text-muted'>RM {$row['totalPrice']}</span>";
            echo "</li>";
          }

          $db->close();

          ?>

          <li class="list-group-item d-flex justify-content-between">
            <span>Total (RM)</span>
            <strong><?php echo "RM $grandTotal" ?></strong>
          </li>
        </ul>
      </div>



      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>


        <form class="needs-validation" novalidate section="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $firstName ?>">
              <span class="error"><?php echo $firstNameErr; ?></span>

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $lastName ?>">
              <span class="error"><?php echo $lastNameErr; ?></span>

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
            <span class="error"><?php echo $emailErr; ?></span>


          </div>

          <div class="mb-3">
            <label for="username">Contact Number</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">MY +60</span>

              </div>
              <input type="text" class="form-control" id="contactNum" name="contactNum" value='<?php echo $contactNum ?>' placeholder="12-1234567">

            </div>
            <span class="error"><?php echo $contactNumErr; ?></span>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>" placeholder="24, Jalan Langkawi">
            <span class="error"><?php echo $addErr; ?></span>
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
              <span class="error"><?php echo $postcodeErr; ?></span>

            </div>

            <div class="col-md-3 mb-3">
              <label for="deliveryMethod">Delivery Method</label>
              <select class="custom-select d-block w-100" id="deliveryMethod" name="deliveryMethod">
                <option value="Food Panda" <?php if (!empty($_POST['submit'])) {
                                              if ($deliveryMethod == 'Food Panda') echo 'selected';
                                            } ?>>Food Panda</option>
                <option value="Grab Food" <?php if (!empty($_POST['submit'])) {
                                            if ($deliveryMethod == 'Grab Food') echo 'selected';
                                          } ?>>Grab Food</option>
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
              <input id="credit" name="paymentMethod" value="credit" type="radio" class="custom-control-input" <?php if (!empty($_POST['submit'])) {
                                                                                                                  if ($paymentMethod == 'credit') echo 'checked';
                                                                                                                } else {
                                                                                                                  echo 'checked';
                                                                                                                } ?>>
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" value="debit" type="radio" class="custom-control-input" <?php if (!empty($_POST['submit'])) {
                                                                                                                if ($paymentMethod == 'debit') echo 'checked';
                                                                                                              } ?>>
              <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" value="cash" type="radio" class="custom-control-input" <?php if (!empty($_POST['submit'])) {
                                                                                                                if ($paymentMethod == 'cash') echo 'checked';
                                                                                                              } ?>>
              <label class="custom-control-label" for="paypal">Cash on Delivery</label>
            </div>
            <span class="error"><?php echo $paymentMethodErr; ?></span>
          </div>
          <label for="" style="font-weight: bold;">(If payment method is either credit or debit card)<span class="text-muted">(Optional)</span></label>
          <div class="row">

            <div class="col-md-6 mb-3">

              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cardName" placeholder="TAN AH GAU">
              <small class="text-muted">Full name as displayed on your debit/credit card</small><br>
              <span class="error"><?php echo $cardNameErr; ?></span>

            </div>
            <div class="col-md-6 mb-3">

              <label for="cc-name">Card Type</label>
              <select class="form-control" id="cc-name" name="cardType">
                <option value="visa" <?php if (!empty($_POST['submit'])) {
                                        if ($cardType == 'visa') echo 'selected';
                                      } ?>>Visa</option>
                <option value="mastercard" <?php if (!empty($_POST['submit'])) {
                                              if ($cardType == 'mastercard') echo 'selected';
                                            } ?>>MasterCard</option>
              </select>
              <span class="error"><?php echo $cardTypeErr; ?></span>
            </div>

            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" name="cardNum" placeholder="1234 1234 1234 1234" maxlength="19">
              <span class="error"><?php echo $cardNumErr; ?></span>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Exp Month</label>
              <input type="text" class="form-control" id="cc-expireMon" maxlength="2" name="expireMon" placeholder="10">
              <span class="error"><?php echo $cardExpMonthErr; ?></span>
              <span class="error"><?php echo $expireMsg; ?></span>
            </div>

            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Exp Year</label>
              <input type="text" class="form-control" id="cc-expireYear" maxlength="2" name="expireYear" placeholder="20">
              <span class="error"><?php echo $cardExpYearErr; ?></span>

            </div>

            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV </label>
              <input type="text" class="form-control" name="cvv" maxlength="3" id="cc-cvv" placeholder="331">
              <span class="error"><?php echo $cardCvvErr; ?></span>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" name="submit" value="submit" type="submit">Confirm</button>
        </form>
      </div>
    </div>