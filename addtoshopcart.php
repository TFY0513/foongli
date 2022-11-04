 <style>
   .backDesign {
     text-decoration: none;
     color: blue;
     cursor: pointer;
   }

   .size {
     font-size: 3em;
   }
 </style>

 <?php
 //Request and add values to shopcart
  $countRepeat = 0;
  $id = $_REQUEST['productID'];
  $username = $_REQUEST['username'];
  $db = new mysqli('localhost', 'root', '', 'foongli');

  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  $take = "select * from products where productID ='$id' ";
  $check = $db->query($take);
//Get Values
  if ($check) {
    while ($row = mysqli_fetch_array($check)) {
      if ($row['productID'] == $id) {
        $addName = $row['productDesc'];
        $addID = $row['productID'];
        $addPrice = $row['productPrice'];
        $addQty = 1;
        $image = $row['productImg'];
        $totalPrice = $addPrice * $addQty;
        break;
      }
    }
  }

  $db->close();
  $currentDate = date("Y/m/d");
  $userdb = new mysqli('localhost', 'root', '', 'foongli'); // connect
  if ($userdb->connect_error) {
    die("Connection failed: " . $userdb->connect_error);
  }
  //Check if there's repeated products in the shopping cart, else redirect to shopcart and pop error message
  $order = "havent";
  $validateRepeatProd = "select * from shopcart where ID='{$id}' AND username='{$username}' AND confirmOrder='$order' ";
  $checkrow = $userdb->query($validateRepeatProd);
  if ($checkrow) {
    while ($row = mysqli_fetch_array($checkrow)) {
      if ($row['ID'] == $id && $row['username'] == $username && $row['confirmOrder'] == $order) {
        $countRepeat++;
      }
    }
  }
  if ($countRepeat != 0) {
    header("Location:shopcart.php?Repeat=Yes");
  } else {
    //Insert values to the shop cart where
    $insert = "insert into shopcart(prodName, ID, Price, Quantity, username, totalPrice, confirmOrder, orderDate,image,status)Values 
    ('{$addName}','{$addID}','{$addPrice}','{$addQty}','{$username}','{$totalPrice}','{$order}','{$currentDate}','{$image}','inCart')";
    $check2 = $userdb->query($insert);
    if ($check2) {//Redirect to shopcart if successful
      echo "<script type='text/javascript'>    alert('Add to cart succesfully !')</script>";
    } else {
      echo "<script type='text/javascript'>    alert('Failed to add to cart!, make sure your last order is delivered!')</script>";
    }
    header("Location:shopcart.php");
  }
  $userdb->close();
  ?>