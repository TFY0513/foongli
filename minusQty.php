<?php

//Minus 1 from the shopping cart and headback, similar to a refresh of the page
          $prodName= $_REQUEST['prodName'];
          $qty=$_REQUEST['Qty'];         
          $ID=$_REQUEST['ID'];
          $price=$_REQUEST['Price'];
          $username=$_REQUEST['User'];
          $totalPrice = 0;

          $db2 = new mysqli('localhost','root','', 'assignment');   
            
          if ($db2->connect_error) {
              die("Connection failed: " . $db->connect_error);
          } 
          $sql = "select * from products where productID = '$ID'";
        
          if($qty > 1){
               $qty--;
           }
          $totalPrice = $price * $qty;  

            $updateQty = "update shopcart set prodName='$prodName', ID='$ID', Price='$price', Quantity='$qty', username='$username', totalPrice = '$totalPrice' WHERE ID='$ID'AND username='$username'";
          
          $check = $db2 ->query($updateQty);
                  if($check){
                      header('Location:shopcart.php');                  
        }
        $db2 -> close();
?>