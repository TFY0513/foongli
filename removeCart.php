<?php

// remove from cary by running query based on the value passed
session_start();
$row = $_REQUEST['row'];

unset($_SESSION['cart'][$row]); // remove item at index 0
$_SESSION['cart'] = array_values($_SESSION['cart']); // 'reindex' array

header("Location: shopcart.php");
?>