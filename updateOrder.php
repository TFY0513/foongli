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

//Initialize variable and get the values passed from orderMange.php

$msg = $invalidOrderID  = $invalidStatus = "";
$neworderID = $newstatus = "";
$empty = 0;
$invalid = 0;
$orderID = $_REQUEST['orderID'];
$orderDate = $_REQUEST['orderDate'];
$orderStatus = $_REQUEST['orderStatus'];
$grandTotalPrice = $_REQUEST['grandTotalPrice'];
$userID = $_REQUEST['userID'];
$payment = $_REQUEST['payment'];
$address = $_REQUEST['address'];
//$qty = $_REQUEST['qty'];

$connect = new mysqli('localhost', 'root', '', 'foongli');
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}

//Display order details, by single list 
$displayOrder = "select * from order_table where orderID = '$orderID' AND orderDate='$orderDate' AND orderStatus='$orderStatus' "
  . "AND grandTotalPrice='$grandTotalPrice' AND userID='$userID' AND payment='$payment' AND address='$address' ";
$display = $connect->query($displayOrder);

if ($display) {
  while ($row = mysqli_fetch_array($display)) {
    $orderID = $row['orderID'];
    $orderStatus = $row['orderStatus'];
  }
}
$connect->close();

if (empty($_POST['orderStatus'])) { //if Status is empty
  $empty = 1;
  $invalidStatus = "This field is required !";
} else {
  $newstatus = $_POST['orderStatus'];
}

if ($empty == 1) { //if any 1 empty
  $msg = "All field is required !";
}
if ($empty == 0) {
  $connect = new mysqli('localhost', 'root', '', 'foongli'); //connect to database
  if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  } else {
    $updateOrderDetails = "update shopcart set status='$newstatus' where orderID='$orderID' AND orderStatus='$orderStatus' AND prodName='$prodName'";
    $check = $connect->query($updateOrderDetails);
    if ($check) {       //Popout message if successed
      echo "<script type='text/javascript'> alert('Updated succesfully !')</script>";
    } else {
      $msg = "Failed to update order !";
    }
  }
  $connect->close();
}
?>

<form class="form-horizontal" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
  <fieldset>

    <!-- Form Name -->
    <legend style="text-align:center; font-size: 40px; "><b>UPDATE ORDER DETAILS</b></legend>

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
        <input id="text" name="status" value="<?php if (isset($_POST['submit'])) {
                                                echo $newstatus;
                                              } else {
                                                echo $status;
                                              } ?>" maxlength="50" class="form-control input-md" type="text">
        <span class="error"><?php echo $invalidStatus; ?></span>
      </div>

    </div>

    <div class="form-group">

      <div class="button">
        <input class="submit" type="submit" name="submit" value="Update">

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