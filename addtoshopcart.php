<?php

session_start();

$productID = $_REQUEST['productID'];
$qty = $_REQUEST['qty'];
$userID = $_SESSION['userID'];

include 'database.php';

$take = "select * from products_table where productID =$productID ";
$check = $database->query($take);
//Get Values
if ($check) {

    while ($row = mysqli_fetch_array($check)) {
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // if ($row['productID'] == $id) {
        $totalPrice = (float) ($row['price'] * $qty);
        $cart = array($userID, $productID, $row['name'], $row['price'], $qty, $totalPrice);
        array_push($_SESSION['cart'], $cart);
    }
}

$database->close();
header("Location:shopcart.php");
?>