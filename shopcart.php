<!DOCTYPE html>
<?php
session_start();
?>
<style>
    .add{
        float: left;
        font-size: 1.5em;
    }
    .minus{
        float: right;
        font-size: 1.5em;
    }
    h1{
        font-weight: bold;
    }
    .box{
        margin:20px;
        line-height: 2em;
    }
    .shopCart{
        width:100%;
    }
    .shopCart,td, tr th {
        border: 3px solid black;
        border-collapse: collapse;
    }
    tr, td, th {
        text-align: center;
        vertical-align: middle;
    }
    th, td {
        padding: 15px;
    }
</style>

<link href="bs/bootstrap.css" rel="stylesheet" type="text/css"/>
<script src="bs/bootstrap.bundle.js" type="text/javascript"></script>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SHOPPING CART</title>
    </head>
    <body>
        <?php include 'topnav.php'; ?>
        <div class="box">
            <center><h1><b>Shopcart</b></h1></center>
            <?php
//              $repeat=$_GET['Repeat']??'';
//              if($repeat == "Yes"){ //If the user adds the same product that the shopping cart already has
//                  echo "<script type='text/javascript'>alert('ERROR, You cannot add same product seperately !')</script>";           
//              }
            ?>
            <?php
            //-----------------Set username @ cookie----------------        
//             if(isset($_COOKIE['username'])){
//                $username = $_COOKIE['username'];  
//              }
//              else{
//                 $username="Guest";
//              } 
//             echo"<h5>@$username</h5>";            
            //-------Generate a table // formatting-------------------        
            ?>        
            <table class="shopCart">             
                <tr> 
                    <th>No.</th>
                    <th>Image</th>

                    <th>Product Name</th>
                    <th>Price(RM)</th>
                    <th>Quantity</th>                   

                    <th>Total</th>    
                    <th>Remove</th>       
                </tr>
                <?php
                //-----------------Display items in shopping cart based on the table where username = ? and confirmOrder = havent-----------------------------------
                include 'database.php';
                $grandTotal = 0.00;
                $count = 1;
                if (!empty($_SESSION['cart']) && sizeof($_SESSION['cart']) > 0) {
                    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                        if ($_SESSION['cart'][$i][0] == $_SESSION['userID']) {
                            echo "<tr>";
                            //for ($j = 0; $j < 6; $j++) {
                            $sql = "select * from products_table where productID ='{$_SESSION['cart'][$i][1]}'";

                            $checkResult = $database->query($sql);

                            echo "<td>$count</td>";

                            while ($row = $checkResult->fetch_assoc()) {
                                echo "<td><img height='100px' width='100px' src='data:image;base64," . $row['image'] . "' /></td>";
                                echo "<td> {$row['name'] }</td>";
                            }
                            echo "<td> {$_SESSION['cart'][$i][3]}</td>";
                            echo "<td> {$_SESSION['cart'][$i][4]}</td>";
                            echo "<td> {$_SESSION['cart'][$i][5]}</td>";
                            $grandTotal += (float) $_SESSION['cart'][$i][5];
                            echo "<td> <a href='removeCart.php?row={$i}'> remove </a></td>";
                            echo "</tr>";
                        }
                        $count++;
                    }
                }


//                while ($row = $checkResult->fetch_assoc()) {
//                    $count++;
//                    $totalPrice = $row['Price'] * $row['Quantity']; //calculate total Price of each item
//                    echo "<tr><td>$count</td>"
//                    . "<td><img class='image' src='images/" . $row['image'] . "' alt=''  width='120px' height='100px'/><br></td>"
//                    . "<td>{$row['prodName']}<input type='hidden' name='prodName' value='{$row['prodName']}'></td>"
//                    . "<td>{$row['ID']}<input type='hidden' name='ID' value='{$row['ID']}'></td>"
//                    . "<td>RM ";
//                    echo number_format((float) $row['Price'], 2, '.', ''); //display price in decimal place
//                    echo"<input type='hidden' name='Price' value='{$row['Price']}'></td>";
//                    echo "<td><a class='add' href='addQty.php?prodName={$row['prodName']}&ID={$row['ID']}&Price={$row['Price']}&Qty={$row['Quantity']}&User={$username}'>+</a> {$row['Quantity']} <a class='minus' href='minusQty.php?ProdName={$row['prodName']}&ID={$row['ID']}&Price={$row['Price']}&Qty={$row['Quantity']}&User={$username}'>-</a></td>"
//                    . "<td><a href='removeCart.php?ID={$row['ID']}&Username={$username}'>Remove </a></td>"
//                    . "<td>RM ";
//                    echo number_format((float) $totalPrice, 2, '.', '');
//                    echo"</td></tr>";
//                    $grandTotal += $totalPrice; // calculate grandTotal         
//                }

                $database->close();
                //----------------------------------------------------------------------
                ?>
                <tr> 
                    <th class="grand" colspan="1">Grand Total</th>
                    <td colspan="6">
                        <?php
                        echo "RM ";
                        echo number_format((float) $grandTotal, 2, '.', ''); //display price in 2 decimal place
                        ?>
                    </td>
                </tr>     
            </table>

            <br>

            <?php
            if ($count > 1) { //Continue Shopping Button, passes the value to checkout.php / Else is the checkout button.
                echo "<br>";
                echo "<br>";

                echo "<form method='post' action='checkout.php'>";
                echo "<input type='hidden' name='grandTotalPrice' value='$grandTotal'>";

                echo "Address: <input required type='text' name='address'><br>";
                echo "<input type='submit' class='btn btn-primary btn-lg' value='Proceed to checkout'>
                </form>";
            }

            include 'footer.php';
            ?></body>


            </html>
