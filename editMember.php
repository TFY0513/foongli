<!DOCTYPE html>
<?php
//get the data
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
//$newrecoveryKey = "";
$newpassword = "";
$ID = "";

$count = 1;
$invalid = 0;
$error = 0;
$msg = $usernameErr = $emailErr = $passwordErr = $ID = $contactNum = $gender = $address = $name =  "";

if (isset($_POST['submit'])) {

	//username
	
	
    //password
    if (empty($_POST['password'])) {
        $invalid = 1;
        $passwordErr = "password cannot be empty !";
    } else {
        $newpassword = $_POST['password'];
        if (strlen($newpassword) < 8) {
            $error = 1;
            $passwordErr = "password must contain 8 digits or numbers";
        }
    }
    //recovery key
  /*  if (empty($_POST['recoveryKey'])) {
        $invalid = 1;
        $recoveryKeyErr = "Recovery Key cannot be empty !";
    } else {
        $newrecoveryKey = $_POST['recoveryKey'];
        if (strlen($newrecoveryKey) < 6) {
            $error = 1;
            $recoveryKeyErr = "Recovery Key must contain 6 digits!";
        }
    }
	*/
    //email
    if (empty($_POST['email'])) {
        $invalid = 1;
        $emailErr = "email cannot be empty !";
    } else {
        $newemail = $_POST['email'];
        if (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "email must follow the email format!";
            $error = 1;
        }
    }
	//contactNum
	
	//gender
	
	//address
	
	//name
	
    //store into data base
    if ($invalid == 0 && $error == 0) {
        $userdb = new mysqli('localhost', 'root', '', 'foongli');
        if ($userdb->connect_error) {
            die("Connection failed: " . $userdb->connect_error);
        }
        $select = "select * from user_table where username='$username' ";
        $run = $userdb->query($select);
        if (mysqli_num_rows($run) == 0) {
            echo "<script type='text/javascript'>    alert('Username already exist !')</script>";
        } else {
            $update = "update user_table set password = '{$newpassword}', email ='{$newemail}', recoveryKey = '{$newrecoveryKey}' where memberID='$memberID'";
            $run = $userdb->query($update);

            if ($run) {
                header("Location:viewMember.php");
                echo "<script type='text/javascript'>    alert('Edit Member Info Success !') </script>";    //popout messasg wont work if theres headers
            } else {
                header("Location:viewMember.php");
                echo "<script type='text/javascript'>    alert('Failed to Edit Member Info !')</script>";
            }
        }

        $userdb->close();
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <link rel="stylesheet" href="bs/bootstrap.min.css">
    <script src="bs/bootstrap.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
    <!-- Bootstrap core CSS -->
    <style>
        .container {
            background-color: #F0F8FF;
            padding: 20px;
            height: 80%;

        }
    </style>
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <title>Edit status</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">
</head>

<body>
    <?php
    include 'adminnav.php';
    ?>
    <form class="col-lg-6 offset-lg-3" enctype="multipart/form-data" method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
        <fieldset>
            <div class=" container row justify-content-center">
                <!-- Form Name -->
                <legend style="text-align:center; font-size: 40px; "><b>Update member</b></legend>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="ID">Member ID</label>
                    <div class="col-md-4">
                        <input type="text" name="memberID" disabled value="<?php echo $memberID ?>">
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
                            <input type="password" name="password" value="<?php echo $password ?>"><br>
                            <span class="error"><?php echo $passwordErr ?></span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Email</label>
                        <div class="col-md-4">
                            <input type="text" name="email" value="<?php echo $email ?>"><br>
                            <span class="error"><?php echo $emailErr ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="gender">Gender</label>
                        <div class="col-md-4">
                            <input type="text" name="gender" value="<?php echo $gender ?>"><br>
                            <span class="error"><?php echo $genderErr ?></span>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label" for="address">Address</label>
                        <div class="col-md-4">
                            <input type="text" name="address" value="<?php echo $address ?>"><br>
                            <span class="error"><?php echo $addressErr ?></span>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-4 control-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input type="text" name="name" value="<?php echo $name ?>"><br>
                            <span class="error"><?php echo $nameErr ?></span>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="update" name="submit" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
        echo "<center><div class='back'>[<a  href='viewMember.php' >Back to View Member</a>] </div><center>";
        ?>
</body>
</html>