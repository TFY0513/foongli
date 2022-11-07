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
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Price(RM)</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include 'inactivityDetect.php';
                    include 'database.php';
                    include 'encryption.php';

                    $sql = "select * from products_table INNER JOIN category_table ON products_table.categoryID=category_table.categoryID";        //run query
                    $result = $database->query($sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>PID000{$row['productID']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td><img height='100px' weight='100px' src='data:image;base64," . $row['image'] . "' /></td>";
                            echo "<td>{$row['categoryName']}</td>";
                            echo "<td>{$row['price']}</td>";
                            $encryp = encrpytion($row['productID']);
                            $_SESSION["encryp_iv"] = $encryp[1];
                            echo "<td><a href='edit_prod.php?productID=$encryp[0]'>Edit</a></td>";
                            echo "<td><a href='deleteProd.php?productID=$encryp[0]'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='7'><center>no results</center></td>";
                        echo "</tr>";
                    }



                    $database->close();
                    ?>

                </tbody>
            </table>
            <button class="w3-button w3-xlarge w3-circle w3-red w3-card-4" id="addProduct">+</button><- [Add product]      <!-- Incase the navigation bar doesnt shows up -->
            <script type="text/javascript">
                document.getElementById("addProduct").onclick = function () {
                    location.href = "addProd.php";
                };
            </script>
            <!--            <br></br>
                        <button class="w3-button w3-xlarge w3-circle w3-red w3-card-4" id="adminPage">+</button><- [Back to Admin Page] 
                        <script type="text/javascript">
                            document.getElementById("adminPage").onclick = function () {
                                location.href = "adminpage.php";
                            };
                        </script>    -->
    </body>


</html>