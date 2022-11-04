<style>
    .backDesign {
        font-size: 3em;
    }
</style>

<script>    //Redirect to allProd.php
    function Back() {
        history.back();
    }
</script>

<?php   //Request values
include 'topnav.php';
$orderID = $_REQUEST['orderID'];
$orderDate = $_REQUEST['orderDate'];
$orderStatus = $_REQUEST['orderStatus'];
$grandTotalPrice = $_REQUEST['grandTotalPrice'];
$userID = $_REQUEST['userID'];
$payment = $_REQUEST['payment'];
$address = $_REQUEST['address'];
//$status = "Unfinished";

$db2 = new mysqli('localhost', 'root', '', 'foongli'); //Connect database

if ($db2->connect_error) {
    die("Connection failed: ".$db2->connect_error);
}

$counting = "select * from shopcart where confirmOrder='Yes'"; //Query
$checkResult = $db2->query($counting);
while ($row = $checkResult->fetch_assoc()) {
    $countOrder++;
}
$orderID = "ID" . $countOrder;
//Update the table shopcart and set the values
$update = "update order_table set ,orderID='$orderID',orderDate='$currentDate' orderStatus='$orderStatus',grandTotalPrice='$grandTotalPrice',userID='$userID',payment='$payment',address ='$address' where userID='{$userID}' AND confirmOrder='havent'";
$checkResult2 = $db2->query($update);

if ($checkResult2) {
    echo "<script type='text/javascript'> alert('Succesfully Paid!')</script>";
}
echo "<center><div class='backDesign'>[<a href='allProd.php'  >Back to Home Page</a>]</div></center>";
$db2->close();

include 'footer.php';
?>