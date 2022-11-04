<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<style>
    .update {
        text-align: center;
        vertical-align: middle;
    }

    a {
        color: blue;
        text-decoration: none;
    }

    a:hover {
        color: white;
    }

    table {

        margin-top: 20px;
    }

    table,
    th,
    td {

        border: 3px solid black;
        border-collapse: collapse;
    }

    th {
        background-color: white;
    }

    tr {
        text-align: center;
        vertical-align: middle;
        background-color: #ffffff;
    }

    th,
    td {
        padding: 10px;
    }

    body {
        background-repeat: no-repeat;
        background-size: cover;
        font-family: Arial;
        color: #333;
        font-size: 0.95em;
    }

    .form-head {
        color: #191919;
        font-weight: normal;
        font-weight: 400;
        margin: 0;
        text-align: center;
        font-size: 1.8em;
    }
</style>

<body>
    <?php include('adminnav.php'); ?>
    <div class="form-head">
        <h1>View Order</h1>
    </div>



    <table style="width:100%">      <!-- Display table -->
        <tr>
            <th>No. </th>
            <th>Order<br> ID</th>
            <th>First<br> Name</th>
            <th>Last <br>Name</th>
            <th>Contact <br>Number</th>
            <th>Product <br>Name</th>
            <th>Product <br>ID</th>
            <th>Quantity</th>
            <th>Total<br> Price</th>
            <th>Order <br>date</th>
            <th>Address</th>
            <th>Status</th>
            <th>Update</th>
            <th>Delete<br>
        </tr>
        <?php
        $db = new mysqli('localhost', 'root', '', 'foongli'); //connect to database

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $sql = "select * from shopcart where confirmOrder='Yes'";   //Query statement and initializt variables
        $checkResult = $db->query($sql);
        $count = 0;
        $start = 0;
        $temp = "";
        $repeatorderID = 0; 
        while ($row = $checkResult->fetch_assoc()) {        //loops and display PAID orders into the table row by row

            $start++;
            if ($start == 1) {
                $count++;
            }
			$orderID = $row['orderID'];
			$orderDate = $row['orderDate'];
			$orderStatus = $row['orderStatus'];
			$grandTotalPrice = $row['grandTotalPrice'];
            $userID = $row['userID'];
            $payment = $row['payment'];
			
            if ($start == 1) {
                $temp = $orderID;
            }
            /*$firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $contactNum = $row['contactNum'];
            $status = $row['status'];
*/
            if ($start > 1) {
                if ($temp == $orderID) {
                    $repeatorderID = 1;
                } else {
                    $count++;
                    $start = 1;
                    $temp = $orderID;
                    $repeatorderID = 0;
                }
            }

            if ($repeatorderID  == 1) {  //Doest not display the count
                echo "<tr><td></td><td></td><td>$firstName</td><td>$lastName</td><td>$contactNum</td><td>$prodName</td><td>$prodID</td><td>$qty</td><td>RM $totalPrice</td><td>$orderDate</td><td>$address</td><td>$status</td><td>[<a href='updateOrder.php?orderID={$orderID}&firstName={$firstName}&lastName=$lastName&contactNum=$contactNum&prodName=$prodName&prodID=$prodID&qty=$qty&totalPrice=$totalPrice&orderDate=$orderDate&status=$status'>Update</a>]</td><td>[<a href='deleteOrder.php?orderID={$orderID}&firstName={$firstName}&lastName=$lastName&contactNum=$contactNum&prodName=$prodName&prodID=$prodID&qty=$qty&totalPrice=$totalPrice&orderDate=$orderDate&status=$status'>Delete</a>]</td></tr>";
            } else {    //Display the count only on the first orderID, the rest of the order is without the count
                echo "<tr><td>$count</td><td>$orderID</td>  <td>$firstName</td><td>$lastName</td><td>$contactNum</td><td>$prodName</td><td>$prodID</td><td>$qty</td><td>RM $totalPrice</td><td>$orderDate</td><td>$address</td><td>$status</td><td>[<a href='updateOrder.php?orderID={$orderID}&firstName={$firstName}&lastName=$lastName&contactNum=$contactNum&prodName=$prodName&prodID=$prodID&qty=$qty&totalPrice=$totalPrice&orderDate=$orderDate&status=$status'>Update</a>]</td><td>[<a href='deleteOrder.php?orderID={$orderID}&firstName={$firstName}&lastName=$lastName&contactNum=$contactNum&prodName=$prodName&prodID=$prodID&qty=$qty&totalPrice=$totalPrice&orderDate=$orderDate&status=$status'>Delete</a>]</td></tr>";
            }
        }
        $db->close();
        ?>
    </table>
    <?php echo "<p><b>$count</b> order(s) found</p>";  ?>      <!-- Shows amount of order that is paid -->
</body>

</html>