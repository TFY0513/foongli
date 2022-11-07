
<?php

include 'inactivityDetect.php';
include 'database.php';
include 'decryption.php';

//Get product ID and show the other values, productID as key value

$encryptedProductID = $_REQUEST['productID'];
$decryp = (int)decrpytion($encryptedProductID,  $_SESSION["encryp_iv"]);
//echo gettype($decryp);
$stmt = $database->prepare("delete from products_table where productID = ?");

$stmt->bind_param("i", $decryp);

$stmt->execute();


echo "<script type='text/javascript'>alert('Delete succesfully !')</script>";
header("Location:productManage.php");
$database->close();

?>

