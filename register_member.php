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
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';

        session_start();
        $count = 1;
        $username = "";
        $name = "";
        $password = "";
        $cPassword = "";
        $email = "";
        $gender = "";
        $address = "";
        $contactNum = "";

        $error = false;
        $nameErr = $emailErr = $passwordErr = $cPpasswordErr = $genderErr = $addressErr = $contactNumErr = "";

        if (isset($_POST['submit'])) {

            include_once 'database.php';

            $username = $_POST['username'];

            $name = $_POST['name'];
            if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
                $nameErr = "The name cannot contain symbol and numbers !";
                $error = true;
            }


            $password = $_POST['password'];
            if (strlen($password) < 8) {
                $error = true;
                $passwordErr = "password must have more than 8 length !";
            } else {
                $cPassword = $_POST['cPassword'];
                if ($cPassword != $password) {
                    $error = true;
                    $cPpasswordErr = "password and confirm password is not matched !";
                }
            }



            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "email must follow the email format!";
                $error = true;
            }


            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
                $error = true;
            } else {
                $gender = $_POST["gender"];
            }

            $address = $_POST['address'];

            $contactNum = $_POST['contactNum'];
            if (!preg_match("/(\+?6?01)[0-46-9]-*[0-9]{7,8}$/i", $contactNum)) {
                $contactNumErr = "The contact number must match with Malaysian mobile phone number !";
                $error = true;
            }



            $stmt = $database->prepare("select * from user_table where username=? ");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if (mysqli_num_rows($result) != 0) {
                  
                $error = true;
                echo "<script type='text/javascript'>    alert('This usename is already exist !')</script>";
            }

            $stmt = $database->prepare("select * from user_table where email=? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

           if (mysqli_num_rows($result) != 0) {
                $error = true;
                echo "<script type='text/javascript'>    alert('This email is already exist !')</script>";
            }


            //store into data base
            if (!$error) {

                $otp = rand(100000, 999999);

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "foongli123@gmail.com";
                $mail->Password = "ojrdfrbhimgvewxh";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->setFrom("foongli123@gmail.com");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Verification code";
                $mail->Body = "$otp";

                $mail->send();

                $hashpassword = hash('sha512', $password);

                $_SESSION["otp"] = $otp;

//                $_SESSION["name"] = $name;
//                $_SESSION["password"] = $hashpassword;
//                $_SESSION["email"] = $email;
//                $_SESSION["gender"] = $gender;
//                $_SESSION["address"] = $address;
//                $_SESSION["contactNum"] = $contactNum;

                $stmt = $database->prepare("insert into user_table (username,password,email,contactNum,gender,address,name, verified)Values(?, ?, ?, ?, ?, ?, ?, 'no')");

                $stmt->bind_param("sssssss", $username, $hashpassword, $email, $contactNum, $gender, $address, $name);

                $stmt->execute();

                $stmt->close();

                $sql = "SELECT userID FROM user_table ORDER BY userID DESC LIMIT 1";
                $result = mysqli_query($database, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $_SESSION["userID"] = $row["userID"];
                    }
                }

                $database->close();

                header("Location:verification.php");
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

                            <input type="text" id="username" class="form-control" maxlength="50" placeholder="Enter username" name="username" value="" required autofocus>
                            <label for="username">Username</label>
                            <span class="error"></span>
                        </div>
                        <div class="form-label-group">

                            <input type="text" id="username" class="form-control" maxlength="50" placeholder="Enter name" name="name" value="" required autofocus>
                            <label for="username">Name</label>
                            <span class="error"><?php echo $nameErr; ?></span>
                        </div>
                        <div class="form-label-group">

                            <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" value="" required>
                            <label for="password">Password</label>
                            <span class="error"><?php echo $passwordErr ?></span>
                        </div>
                        <div class="form-label-group">

                            <input type="password" id="password" class="form-control" placeholder="Confirm password" name="cPassword" value="" required>
                            <label for="password">Confirm Password</label>
                            <span class="error"><?php echo $cPpasswordErr ?></span>
                        </div>
                        <div class="form-label-group">

                            <input type="text" id="email" class="form-control" maxlength="50" placeholder="Enter email" name="email" value="" required>
                            <label for="email">Email</label>
                            <span class="error"><?php echo $emailErr ?></span>
                        </div>
                        <label for="email">Gender: </label>


                        <input type="radio" name="gender"  value="female"> Female
                        <input type="radio" name="gender" value="male"> Male

                        <span class="error"><?php echo $genderErr ?></span><br/>
                        <div class="form-label-group">

                            <input type="text" id="email" class="form-control" maxlength="100" placeholder="Enter address" name="address" value="" required>
                            <label for="email">Address</label>
                            <span class="error"><?php echo $addressErr ?></span>
                        </div>
                        <div class="form-label-group">

                            <input type="text" id="email" class="form-control" maxlength="15" placeholder="" name="contactNum" value="" required>
                            <label for="email">Contact Number</label>
                            <span class="error"><?php echo $contactNumErr ?></span>
                        </div>

                        <button class="btn btn-lg btn-primary " type="submit" name="submit">Register</button>
                        <a href="memberlogin.php">Login</a>
                    </form>
                </div>
            </div>

        </div>

    </body>
    <?php
    include 'footer.php'
    ?>

</html>