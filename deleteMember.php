<!DOCTYPE html>
<?php
//get the passed value
$userID = $_GET['userID'];
$username = $_GET['username'];
$password = $_GET['password'];
$email = $_GET['email'];
$contactNum = $_GET['contactNum'];
$gender = $_GET['gender'];
$address = $_GET['address'];
$name = $_GET['name'];
?>
<?php
session_start();
$newusername = "";
//$newrecoveryKey = "";
$newpassword = "";
$newemail ="";
$newcontactNum = "";
$newgender = "";
$newaddress = "";
$newname = "";

//$ID = "";

$count = 1;
$invalid = 0;
$error = 0;
$msg = $usernameErr = $emailErr = $passwordErr = $ID = $emailErr = $contactNumErr = $genderErr = $addressErr = $nameErr = "";

if (isset($_POST['submit'])) {//click to delete the value from the table, CRUD
    $userdb = new mysqli('localhost', 'root', '', 'foongli');
    if ($userdb->connect_error) {
        die("Connection failed: " . $userdb->connect_error);
    }
    $delete = "update member set deleteAcc = 'Yes'where userID='$userID'";
    $run = $userdb->query($delete);

    if ($run) {
        header("Location:viewMember.php");
        echo "<script type='text/javascript'> alert('Delete Member Success !')</script>";//Will not echo
    } else {
        header("Location:viewMember.php");
        echo "<script type='text/javascript'> alert('Failed to Delete Member !') </script>";//Will not echo
    }
    $userdb->close();
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
    <script src="bs/bootstrap.min.js"></script>
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core CSS -->
    <style>
        .container {
            background-color: #F0F8FF;
            padding: 20px;
            height: 80%;
        }
    </style>
    <title>Edit Member</title>
</head>

<body>
    <?php
    include 'adminnav.php';
    ?>
    <form class="col-lg-6 offset-lg-3" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
        <fieldset>
            <div class=" container row justify-content-center">
                <!-- Form Name -->
                <legend style="text-align:center; font-size: 40px; "><b>Update member</b></legend>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="ID">User ID</label>
                    <div class="col-md-4">
                        <input type="text" name="userID" disabled value="<?php echo $userID ?>">
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">UserName</label>
                        <div class="col-md-4">
                            <input type="text" name="username" disabled value="<?php echo $username ?>"><br>
                            <span class="error"><?php echo $usernameErr ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password">Password</label>
                        <div class="col-md-4">
                            <input type="password" name="password" disabled value="<?php echo $password ?>"><br>
                            <span class="error"><?php echo $passwordErr ?></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Email</label>
                        <div class="col-md-4">
                            <input type="text" name="email" disabled value="<?php echo $email ?>"><br>
                            <span class="error"><?php echo $emailErr ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="contactNum">contact number</label>
                        <div class="col-md-4">
                            <input type="text" name="contactNum" disabled value="<?php echo $contactNum ?>"><br>
                            <span class="error"><?php echo $contactNumErr ?></span>
                        </div>
                    </div>
					 <div class="form-group">
                        <label class="col-md-4 control-label" for="gender">gender</label>
                        <div class="col-md-4">
                            <input type="text" name="gender" disabled value="<?php echo $gender ?>"><br>
                            <span class="error"><?php echo $genderErr ?></span>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label" for="address">address</label>
                        <div class="col-md-4">
                            <input type="text" name="address" disabled value="<?php echo $address ?>"><br>
                            <span class="error"><?php echo $addressrErr ?></span>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label" for="name">name</label>
                        <div class="col-md-4">
                            <input type="text" name="contactNum" disabled value="<?php echo $name ?>"><br>
                            <span class="error"><?php echo $nameErr ?></span>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Delete" name="submit" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

</body>
<?php
include 'footer.php'
?>

</html>