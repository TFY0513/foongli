<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
  .error {
    color: #FF0000;
  }

  .errorHeader {
    color: #FF0000;
    margin-left: 45%;

  }

  .button {
    margin-left: 45%;
  }

  .back {
    margin-left: 43%;
  }
</style>
<?php

//delete order 1 by 1 that is paid by the same customer name
$msg = $invalidOrderID  = $invalidStatus = "";
$neworderID = $newstatus = "";
$empty = 0;
$invalid = 0;
$orderID = $_REQUEST['orderID'];
$orderStatus = $_REQUEST['orderStatus'];
$grandTotalPrice = $_REQUEST['grandTotalPrice'];
$userID = $_REQUEST['userID'];
$orderDate = $_REQUEST['orderDate'];

$connect = new mysqli('localhost', 'root', '', 'foongli');
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

$takeOrder = "select * from shopcart where firstName = '$firstName' AND lastName='$lastName' AND contactNum='$contactNum' AND prodName='$prodName' AND ID='$prodID' AND totalPrice='$totalPrice' AND orderDate='$orderDate' ";
$run = $connect->query($takeOrder);

if ($run) {
  while ($row = mysqli_fetch_array($run)) {
    $orderID = $row['orderID'];
    $status = $row['status'];
  }
}
$connect->close();

if ($empty == 0) {
  $connect = new mysqli('localhost', 'root', '', 'assignment');
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  } else {
    $deleteOrderDetails = "delete from shopcart where totalPrice='$totalPrice' AND  ID='$prodID'";
    $check = $connect->query($deleteOrderDetails);
    if ($check) {
      "<script type='text/javascript'>alert('deleted!')</script>";
    } else {
      $msg = "Failed to delete order !";
    }
  }
  $connect->close();
}
?>

<form class="form-horizontal" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
  <fieldset>

    <!-- Form Name -->
    <legend style="text-align:center; font-size: 40px; "><b>DELETE ORDER DETAILS</b></legend>

    <!-- Text input-->
    <span class="errorHeader   "><?php echo $msg; ?></span>


    <div class="form-group">

      <label class="col-md-4 control-label" for="name">ORDER ID</label>
      <div class="col-md-4">
        <input type='text' name='id' value='<?php echo $orderID ?>' disabled>
      </div>
    </div>



    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="id">CUSTOMER FIRST NAME</label>

      <div class="col-md-4">
        <input type='text' name='id' value='<?php echo $firstName ?>' disabled>

      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="id">CUSTOMER LAST NAME</label>

      <div class="col-md-4">
        <input type='text' name='id' value='<?php echo $lastName ?>' disabled>

      </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="price">CONTACT NUMBER</label>
      <div class="col-md-4">
        <input id="product_price" name="price" maxlength="10" placeholder="PRODUCT PRICE" value="<?php echo $contactNum ?>" disabled class="form-control input-md" type="text">
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="quantity">PRODUCT NAME</label>
      <div class="col-md-4">
        <input id="quantity" name="quantity" value="<?php echo $prodName ?>" class="form-control input-md" disabled type="text">

      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="category">PRODUCT ID</label>
      <div class="col-md-4">
        <input id="category" name="category" maxlength="20" class="form-control" disabled value="<?php echo $prodID ?>" placeholder="Category" type="text">

      </div>
    </div>


    <!-- Textarea -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">QUANTITY</label>
      <div class="col-md-4">
        <input id="quantity" min="0" max="120" placeholder="Qty" value="<?php echo $qty ?>" disabled class="form-control input-md" type="number">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">TOTAL PRICE (RM)</label>
      <div class="col-md-4">
        <input id="quantity" value="<?php echo $totalPrice ?>" disabled class="form-control input-md" type="text">
      </div>
    </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">ORDER DATE </label>
      <div class="col-md-4">
        <input id="text" value="<?php echo $orderDate ?>" disabled class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">STATUS </label>
      <div class="col-md-4">
        <input id="text" name="status" value="<?php echo $status; ?>"  disabled class="form-control input-md" type="text">
      </div>

    </div>

    <div class="form-group">

      <div class="button">
        <input class="submit" type="submit" name="submit" value="Delete">

      </div>
    </div>

    <?php
    if ($invalid == 1) {
      echo "<span class='error' >$openFolder;</span>";
    }
    ?>
    <?php


    echo "<div class='back'>[<a  href='orderManage.php' >Back to View Order</a>] </div>";

    ?>

  </fieldset>
</form>