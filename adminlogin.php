<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Admin Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

  <!-- Bootstrap core CSS -->
  <link href="bs/bootstrap.min.css" rel="stylesheet">
  <?php
session_start();
//  if (!empty($_SESSION["error"])) {
//    echo "<script type='text/javascript'>    alert('{$_SESSION["error"]}')</script>";
//     unset($_SESSION['$_SESSION']);
//  }
 
  ?>
  <style>
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
  <!-- Custom styles for this template -->
  <link href="adminlogin.css" rel="stylesheet">
    <!-- Submit and pass value to adminvalidate.php to do log in -->
</head>

<body>
  <form action="adminvalidate.php" method="post" class="form-signin">

    <div class="text-center mb-4">
      <img class="mb-4" src="Bun/Logo.png" alt="" width="231" height="140">
      <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>
      <p>Login page for admin</p>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="name" value="" required autofocus>
      <label for="name">Username</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" value="" required>
      <label for="inputPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign In" name="submit">
    <p class="mt-5 mb-3 text-muted text-center">&copy; Foong Li Bao Dian 2020</p>
    <center> <h6><b>Pressed Wrong??</b> [<a href="memberlogin.php"><b>Member Login</b></a>]</h6></center>
  </form>
 
 
 
</body>

</html>