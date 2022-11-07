<?php
ob_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v4.0.1">
        <title>Fixed top navbar example · Bootstrap</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">

        <!-- Bootstrap core CSS -->
        <link href="bs/bootstrap.css" rel="stylesheet" type="text/css"/>

        <style>
            .logo{
                margin-left:-10px;
            }
            .dropDown:hover .dropdown-content{
                display: block;
            }

            .dropDown .dropdown-content a:hover {
                text-decoration: none;
                background-color: #cccccc;
                color: black;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                display: block;
                text-align: left;
            }

            .dropdown-subCat1{
                margin-top:-26%;
                margin-left:185px;
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-subCat2{
                margin-top:-26%;
                margin-left:185px;
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-subCat3{
                margin-top:-26%;
                margin-left:185px;
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }
            .dropdown-subCat4{
                margin-top:-26%;
                margin-left:185px;
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>



        <link href="navbartop.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

            <a class="navbar-brand" href="index.php">Foong Li</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="AboutUs.php">About Us</a>
                    </li>

                    <div class="dropDown">
                        <li class="nav-item">
                            <a href="allProd.php" class="nav-link dropdown-toggle">Product</a>
                            <div class="dropdown-content">
                                <?php
                                include_once 'database.php';

                                $sql = "select * from products_table INNER JOIN category_table ON products_table.categoryID=category_table.categoryID";

                                $checkResult = $database->query($sql);
                          

                                while ($row = $checkResult->fetch_assoc()) {
                                    echo "<div><a href=''>{$row['name']}</a></div>";
                                }
                                $database->close();
                                ?>
                                                
                            </div>
                        </li>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="shopcart.php">Shopping Cart</a>
                    </li>

                    <div class="dropDown">
                        <li class="nav-link dropdown-toggle">Profile</li>
                        <div class="dropdown-content">
                            <a href='.php'>Edit Profile </a>
                            <a href='userLogOut.php'>Log Out</a>

                        </div> 
                    </div>

                </ul>

            </div>
        </nav>




    </body>
</html>
