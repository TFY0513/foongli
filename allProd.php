<!doctype html>
<?php
session_start();
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v4.0.1">
        <title>Product</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

        <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
        <script src="bs/bootstrap.bundle.js"></script>
    </head>

    <body>
        <?php
        // 
        include 'topnav.php';
        ?>
        <!-- Display all product -->
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">
                    <h2 class="title">All Product</h2>
                </div>
            </section>
            <div class="py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <?php
                        include 'database.php';

                        $sql = "select * from products_table INNER JOIN category_table ON products_table.categoryID=category_table.categoryID";

                        $checkResult = $database->query($sql);
                        $count = 0;

                        while ($row = $checkResult->fetch_assoc()) {
                            $productID = $row['productID'];
                            $count++;
                            echo "<div class='col-md-4'>";
                            echo " <div class='card mb-4 shadow-sm'>";
                            echo " <svg class='bd-placeholder-img card-img-top' width='100%' height='100' xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='xMidYMid slice' focusable='false' role='img' aria-label='Placeholder: '><title>Placeholder</title>";
                            echo "<img  src='data:image;base64," . $row['image'] . "' /></svg>";
                            echo "<div class='card-body'>";
                            echo "<center><h4 class='card-text'><b>{$row['name']}</b></h4></center><br>";

                            echo "<h6 class='card-text'><b>Category</b></h6>";
                            echo "<p class='card-text'>{$row['categoryName']}</p>";

                            echo "<h6 class='card-text'><b>Price</b></h6>";
                            echo "<p class='card-text'>RM {$row['price']}</p>";

                            echo " <div class='d-flex justify-content-between align-items-center'>";
                            echo "  <div class='btn-group'>";

                            echo"<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>";
                            echo " Add to cart </button>";
                            echo "</div>";
                            echo " <small class='text-muted'>$count</small>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        $database->close();
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="addtoshopcart.php">
                            Quantity: <input type="text" name="qty"><br>
                            <input type="hidden" name="productID"  value=" <?php echo $productID; ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <input type="submit" class="btn btn-sm btn-outline-secondary" value="Submit">
                        </form>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    </body>

</html>