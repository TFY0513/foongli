<!DOCTYPE html>
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
        <?php include 'topnav.php';?>
        <div class="box">
           <center><h1><b>Shopcart</b></h1></center>
           <?php   
              $repeat=$_GET['Repeat']??'';
              if($repeat == "Yes"){ //If the user adds the same product that the shopping cart already has
                  echo "<script type='text/javascript'>alert('ERROR, You cannot add same product seperately !')</script>";           
              }
          ?>
          <?php 
              //-----------------Set username @ cookie----------------        
             if(isset($_COOKIE['username'])){
                $username = $_COOKIE['username'];  
              }
              else{
                 $username="Guest";
              } 
             echo"<h5>@$username</h5>";            
           //-------Generate a table // formatting-------------------        
          ?>        
         <table class="shopCart">             
                <tr> 
                    <th>No.</th>
                    <th>Image</th>
                    <th>Product Desc</th>
                    <th>Product ID</th>
                    <th>Product Price</th>
                    <th>Quantity</th>                   
                    <th>Remove</th>               
                    <th>Total</th>            
                </tr>
         <?php
            //-----------------Display items in shopping cart based on the table where username = ? and confirmOrder = havent-----------------------------------
            $db = new mysqli('localhost','root','', 'assignment');   
            if ($db->connect_error) {
                     die("Connection failed: " . $db->connect_error);
             }
             $count = 0;
             $sql = "select * from shopcart where username = '$username' and confirmOrder='havent'";
             
             $checkResult = $db->query($sql);
             $grandTotal = 0;
             while($row = $checkResult -> fetch_assoc()){
                    $count++;
                    $totalPrice = $row['Price'] * $row['Quantity'];//calculate total Price of each item
                    echo "<tr><td>$count</td>"
                        . "<td><img class='image' src='images/".$row['image']."' alt=''  width='120px' height='100px'/><br></td>"
                        . "<td>{$row['prodName']}<input type='hidden' name='prodName' value='{$row['prodName']}'></td>"
                        . "<td>{$row['ID']}<input type='hidden' name='ID' value='{$row['ID']}'></td>"
                        . "<td>RM ";
                    echo number_format((float)$row['Price'], 2, '.', ''); //display price in decimal place
                    echo"<input type='hidden' name='Price' value='{$row['Price']}'></td>";
                    echo "<td><a class='add' href='addQty.php?prodName={$row['prodName']}&ID={$row['ID']}&Price={$row['Price']}&Qty={$row['Quantity']}&User={$username}'>+</a> {$row['Quantity']} <a class='minus' href='minusQty.php?ProdName={$row['prodName']}&ID={$row['ID']}&Price={$row['Price']}&Qty={$row['Quantity']}&User={$username}'>-</a></td>"
                        ."<td><a href='removeCart.php?ID={$row['ID']}&Username={$username}'>Remove </a></td>"
                        ."<td>RM ";
                    echo number_format((float)$totalPrice, 2, '.', ''); 
                    echo"</td></tr>";
                    $grandTotal += $totalPrice;// calculate grandTotal         
             }
       
            $db -> close();         
            //----------------------------------------------------------------------
            
         ?>
                <tr> 
                <th class="grand" colspan="7">Grand Total</th>
                <td>
                <?php echo "RM "; echo number_format((float)$grandTotal, 2, '.', ''); //display price in 2 decimal place?>
                </td>
                </tr>     
            </table>
            <?php 
            echo"<p><b>$count</b> product(s) selected</p>";
            ?>
            <br>
            <?php
            if($count == 0){ //If the shopping cart is empty, display the Add your first product button, head to allProd.php
             echo "<a class='btn btn-primary btn-lg' href='allProd.php'>Add your first product</a>";
             echo "<br>";
             echo "<br>";
            }
            if($count >= 1){ //Continue Shopping Button, passes the value to checkout.php / Else is the checkout button.
                echo "<a class='btn btn-primary btn-lg' href='allProd.php'>Continue Shopping</a>";
                echo "<br>";
                echo "<br>";
                echo "<a class='btn btn-primary btn-lg' href='checkout.php?Username={$username}&GrandTotal={$grandTotal}&Count={$count}'>Proceed to checkout</a>";
            }
            ?>
        </div>     
<?php include 'footer.php'; ?></body>
</html>
