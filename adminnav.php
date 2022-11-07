<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Nav</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/navbar-fixed/">

 
  <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="navbartop.css" rel="stylesheet" type="text/css" />
  <script src="bs/bootstrap.bundle.js"></script>
</head>

<body>
 <!-- Admin navigation Panel -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="adminpage.php">Foong Li Admin</a>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"></nav>
    <a class="navbar-brand">

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="adminpage.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="orderManage.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productManage.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="viewMember.php">Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ReachToUs.php">Feedback</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminlogout.php">Log Out</a>
        </li>
      </ul>

      <?php
    session_start();
      $name = $_SESSION['username'];
      echo "<div class='name'>";
      echo " <a class='nav-link disabled'>Hello, $name</a>";
      echo "</div>";
      ?>

    </div>
  </nav>

</body>

</html>