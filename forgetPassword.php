<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Forget password</title>
    <style>
        .error {
            color: red;
        }
    </style>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">
    <link href="adminlogin.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="bs/bootstrap.min.css" rel="stylesheet">
    <?php
    $invalid = 0;
    $password = "";
    $validate = 0;

    if (isset($_POST['submit'])) {


        //username
        if (empty($_POST['username'])) {
            $invalid = 1;
        } else {
            $username = $_POST['username'];
        }
        //recovery key
        if (empty($_POST['recoveryKey'])) {
            $invalid = 1;
        } else {
            $recoveryKey = $_POST['recoveryKey'];
        }
        //search form data base
        if ($invalid == 0) {
            $userdb = new mysqli('localhost', 'root', '', 'assignment');
            if ($userdb->connect_error) {
                die("Connection failed: " . $userdb->connect_error);
            }
            $sql = "SELECT * FROM member WHERE username='$username' AND recoveryKey='$recoveryKey'";
            $result = $userdb->query($sql);
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['username'] == $username && $row['recoveryKey'] == $recoveryKey) {
                        $password = $row['password'];
                        $validate = 1;
                        break;
                    }
                }
            }
            $userdb->close();
        }
        if ($validate == 0) {
            echo "<script type='text/javascript'> alert('Username does not found !')</script>";
        }
    }
    ?>

</head>

<body>
    <form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class="text-center mb-4">
            <img class="mb-4" src="Bun/Logo.png" alt="" width="231" height="140">
            <h1 class="h3 mb-3 font-weight-normal">Forget password</h1>
        </div>

        <div class="form-label-group">

            <input type="username" id="username" class="form-control" placeholder="Enter username" name="username" value="" required autofocus>
            <label for="name">Username</label>

        </div>

        <div class="form-label-group">

            <input type="password" id="recoveryKey" class="form-control" placeholder="recoveryKey" name="recoveryKey" required value="">
            <label for="inputPassword">Recovery key</label>
        </div>
        <?php
        if ($validate == 1) {
            echo "<div class='form-label-group'>";
            echo "<input type='test' class='form-control' disabled value='$password'>";
            echo "<label>Password</label>";
            echo "</div>";
        }
        ?>
        <input class="btn btn-lg btn-primary " type="submit" value="Search" name="submit">
    </form>
    <?php
    echo "<div class='back'>  [<a  href='memberlogin.php' >Back to Feedback</a>] </div>";
    ?>
</body>
<?php
include 'footer.php'
?>

</html>