<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Member register</title>
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
    //Initialize variables

    session_start();
    $count = 1;
    $username = "";
    $recoveryKey = "";
    $password = "";
    $memberID = 0;
    $invalid = 0;
    $error = 0;
    $msg = $usernameErr = $emailErr = $passwordErr = $recoveryKeyErr = "";

    if (isset($_POST['submit'])) {

        $userdb = new mysqli('localhost', 'root', '', 'assignment');
        if ($userdb->connect_error) {
            die("Connection failed: " . $userdb->connect_error);
        }
        //generate member ID
        $counting = "select * from member";
        $result = $userdb->query($counting);
        while ($row = $result->fetch_assoc()) {
            $count++;
        }
        $memberID = "M" . $count;
        $userdb->close();

        if (empty($_POST['username'])) {    //not empty and does not contain symbol and numbers @ only alphabets
            $invalid = 1;
            $usernameErr = "Must enter user name !";
        } else {
            $username = $_POST['username'];
            if (!preg_match("/^[a-z ,.'-]+$/i", $username)) {
                $usernameErr = "The user name cannot contain symbol and numbers!";
                $error = 1;
            }
        }
        //password
        if (empty($_POST['password'])) {
            $invalid = 1;
            $passwordErr = "password cannot be empty !";
        } else {
            $password = $_POST['password'];
            if (strlen($password) < 8) {
                $error = 1;
                $passwordErr = "password must contain 8 digits or numbers";
            }
        }
        //recovery key
        if (empty($_POST['recoveryKey'])) {
            $invalid = 1;
            $recoveryKeyErr = "Recovery Key cannot be empty !";
        } else {
            $recoveryKey = $_POST['recoveryKey'];
            if (strlen($recoveryKey) < 6) {
                $error = 1;
                $recoveryKeyErr = "Recovery Key must contain 6 digits!";
            }
        }
        //email
        if (empty($_POST['email'])) {
            $invalid = 1;
            $emailErr = "email cannot be empty !";
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "email must follow the email format!";
                $error = 1;
            }
        }
        //store into data base
        if ($invalid == 0 && $error == 0) {
            $userdb = new mysqli('localhost', 'root', '', 'assignment');
            if ($userdb->connect_error) {
                die("Connection failed: " . $userdb->connect_error);
            }
            $select = "select * from member where username='$username' ";
            $run = $userdb->query($select);
            if (mysqli_num_rows($run) != 0) {
                echo "<script type='text/javascript'>    alert('Username already exist !')      "
                    . "          </script>";
            } else {
                $insert = "insert into member(memberID,username, password,email,recoveryKey,deleteAcc)Values('{$memberID}','{$username}', '{$password}','{$email}','{$recoveryKey}','No') ";
                $run = $userdb->query($insert);

                if ($run) {
                    header("Location:index.php");
                    echo "<script type='text/javascript'> alert('Member registred success !')</script>";
                } else {
                    header("Location:index.php");
                    echo "<script type='text/javascript'> alert('Failed to registered !')</script>";
                }
            }
            $userdb->close();
        }
    }
    ?>
</head>

<body>
    <div class="form-container">

        <div class="form-row justify-content-lg-center">
            <div class="row">
                <form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="text-center mb-4">
                        <img class="mb-4" src="Bun/Logo.png" alt="" width="231" height="140">
                        <h1 class="h3 mb-3 font-weight-normal">Member register</h1>
                        <p> Member registration</p>
                    </div>

                    <div class="form-label-group">

                        <input type="text" id="username" class="form-control" placeholder="Enter username" name="username" value="" required autofocus>
                        <label for="username">Username</label>
                        <span class="error"><?php echo $usernameErr;
                                            echo $msg ?></span>
                    </div>

                    <div class="form-label-group">

                        <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" value="" required>
                        <label for="password">Password</label>
                        <span class="error"><?php echo $passwordErr ?></span>
                    </div>

                    <div class="form-label-group">

                        <input type="text" id="email" class="form-control" placeholder="Enter email" name="email" value="" required>
                        <label for="email">Email</label>
                        <span class="error"><?php echo $emailErr ?></span>
                    </div>

                    <div class="form-label-group">
                        <input type="password" id="recoveryKey" class="form-control" placeholder="Enter recovery Key" name="recoveryKey" value="" required>
                        <label for="recovery key">Recovery Key</label>
                        <span class="error"><?php echo $recoveryKeyErr ?></span>
                    </div>
                    <button class="btn btn-lg btn-primary " type="submit" name="submit">Register</button>

                </form>
            </div>
        </div>

    </div>

</body>
<?php
include 'footer.php'
?>

</html>