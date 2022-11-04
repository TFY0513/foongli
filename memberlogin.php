<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Member Login</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

  <!-- Bootstrap core CSS -->
  <link href="bs/bootstrap.min.css" rel="stylesheet">

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
  <?php
  $invalid = 0;
  if (isset($_POST['submit'])) {  //if submit, post 
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userdb = new mysqli('localhost', 'root', '', 'foongli');
    if ($userdb->connect_error) {
      die("Connection failed: " . $userdb->connect_error);
    }
    $select = "select * from user_table where username='$username'";
    $run = $userdb->query($select);
    $row = $run->fetch_assoc();
    if ($row['password'] === $password && $row['username'] === $username) {
      setcookie('username', $row['username']);  //set coookie
      header("Location:allProd.php");   //Back to allProd
    } else {
      echo "<script type='text/javascript'> alert('Invalid Credentials!')</script>";
    }
  }

  ?>
  <!-- Custom styles for this template -->
  <link href="adminlogin.css" rel="stylesheet">
</head>
<body>
  <form section="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="form-signin">

    <div class="text-center mb-4">
      <img class="mb-4" src="Bun/Logo.png" alt="" width="231" height="140">
      <h1 class="h3 mb-3 font-weight-normal">Member Login</h1>
      <p>Login page for member</p>
    </div>

    <div class="form-label-group">
      <input type="name" id="inputUsername" class="form-control" placeholder="Username" name="username" value="" required autofocus>
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
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; Foong Li Bao Dian 2020</p>
  </form>
  <h6><b>Not a Member yet?</b> [<a href="register_member.php"><b>Register as a Member</b></a>]</h6>
  <h6><b>Forget password?</b> [<a href="forgetPassword.php"><b>Password Recovery</b></a>]</h6>
  <?php
  include 'footer.php'
  ?>
</body>

</html>