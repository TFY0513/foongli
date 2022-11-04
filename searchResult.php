<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Product</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">
  <!-- Bootstrap core -->
  <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
  </style>
  <?php
  //display searchresult on the nav bar
  $result = $_REQUEST['search']
  ?>

</head>

<body>
  <?php include 'topnav.php'; ?>

  <main role="main">
    <section class="jumbotron text-center">
      <div class="container">
        <h1><b>SEARCH RESULT</b></h1><br>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <?php
          if (isset($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
          } else {
            $username = "Guest";
          }

          $db = new mysqli('localhost', 'root', '', 'assignment');

          if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
          }
          $sql = "select * from products where productDesc like '%" . $result . "%'";   //run query to display products based on keyword

          $checkResult = $db->query($sql);
          $count = 0;

          while ($row = $checkResult->fetch_assoc()) {
            $count++;
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4 shadow-sm'>";
            echo "<svg class='bd-placeholder-img card-img-top' width='100%' height='220' xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='xMidYMid slice' focusable='false' role='img' aria-label='Placeholder: '><title>Placeholder</title>";
            echo "<img class='image' src='images/" . $row['productImg'] . "' alt=''  width='100%' height='250px'/></svg>";
            echo "<div class='card-body'>";
            echo "<center><h4 class='card-text'><b>{$row['productDesc']}</b></h4></center><br>";
            echo "<h6 class='card-text'><b>Product ID</b></h6>";
            echo "<p class='card-text'>{$row['productID']}</p>";
            echo "<h6 class='card-text'><b>Category</b></h6>";
            if ($row['productCat'] == 'Bao Zi') {
              echo "<p class='card-text'>Bao Zi</p>";
            } else {
              echo "<p class='card-text'>Dim Sum</p>";
            }

            echo "<h6 class='card-text'><b>Description</b></h6>";
            echo "<p class='card-text'>{$row['productDesc']}</p>";
            echo "<h6 class='card-text'><b>Price</b></h6>";
            echo "<p class='card-text'>RM {$row['productPrice']}</p>";

            echo "<div class='d-flex justify-content-between align-items-center'>";
            echo "<div class='btn-group'>";
            echo "<a href='addToCart.php?ID={$row['productID']}&username=$username' class='btn btn-sm btn-outline-secondary'>Add to Cart</a>";
            echo "</div>";
            echo "<small class='text-muted'>$count</small>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          $db->close();
          ?>
        </div>
      </div>
    </div>
  </main>
  <?php include("footer.php"); ?>

</html>