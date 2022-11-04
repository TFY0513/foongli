<!DOCTYPE html>

<html>
        <head>
        <title>Product Manage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bs/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        </head>
<body>
<?php
include 'adminnav.php'
?>
        <br>
        <div class="container">          
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Product Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $userdb = new mysqli('localhost','root','', 'assignment');    
                    if ($userdb->connect_error) {
                        die("Connection failed: " . $userdb->connect_error);
                    } 

                    $show = "select * from products";        //run query
                     $checkrow = $userdb ->query($show);
                    while($row = $checkrow -> fetch_assoc()){
                        echo "<tr>";
                        echo "<td>";
                        echo $row["productID"];
                        echo "</td>";
                        echo "<td>";
                         echo "<img width='100px' height='100px' src='images/".$row['productImg']."'><br>";
                        echo "</td>";
                        echo "<td>";
                        echo $row["productDesc"];
                        echo "</td>";
                        echo "<td>";
                        echo $row["productCat"];
                        echo "</td>";
                        echo "<td>";
                        echo "RM {$row['productPrice']}";
                        echo "</td>";
                        echo "<td>";
                        ?> <a href="edit_prod.php?prod_id=<?php echo $row["productID"]; ?>"><button type="button">Edit</button></a> <?php
                        echo "</td>";
                        echo "<td>";
                        ?> <a href="deleteProd.php?prod_id=<?php echo $row["productID"]; ?>"><button type="button">Delete</button></a> <?php
                    echo "</td>";
                    echo "</tr>";
                }
                $userdb -> close();
                ?>
                        
                </tbody>
            </table>
            <button class="w3-button w3-xlarge w3-circle w3-red w3-card-4" id="addProduct">+</button><- [Add product]      <!-- Incase the navigation bar doesnt shows up -->
             <script type="text/javascript">
                 document.getElementById("addProduct").onclick = function () {
                   location.href = "addProd.php";
                 };
            </script>
                <br></br>
                        <button class="w3-button w3-xlarge w3-circle w3-red w3-card-4" id="adminPage">+</button><- [Back to Admin Page] 
             <script type="text/javascript">
                 document.getElementById("adminPage").onclick = function () {
                   location.href = "adminpage.php";
                 };
            </script>    
    </body>


</html>