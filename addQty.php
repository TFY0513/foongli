 
<?php
//Request Value and +1 to the qty in the products table where productID = ? and Username = ?
$prodName = $_REQUEST['prodName'];
$qty = $_REQUEST['Qty'];
$ID = $_REQUEST['ID'];
$price = $_REQUEST['Price'];
$username = $_REQUEST['User'];
$totalPrice = 0;

$db2 = new mysqli('localhost', 'root', '', 'foongli');

if ($db2->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
$sql = "select * from products where productID = '$ID'";

if ($qty < 20) {
  $qty++;
}
$totalPrice = $price * $qty;

$updateQty = "update shopcart set prodName='$prodName', ID='$ID', Price='$price', Quantity='$qty', username='$username', totalPrice = '$totalPrice' WHERE ID='$ID'AND username='$username'";

$check = $db2->query($updateQty);
if ($check) {
  //redirect back to shoppingcart
  header('Location:shopcart.php');
}
$db2->close();
?>