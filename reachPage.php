<!DOCTYPE html>

<html>
<?php
session_start();
$count = 1;
$message_id = 0;
$invalid = 0;
$status = "";
$error = 0;
$msg = $nameErr = $emailErr = $msgErr = "";
if (isset($_POST['submit'])) {    //if submit

    $userdb = new mysqli('localhost', 'root', '', 'assignment');
    if ($userdb->connect_error) {
        die("Connection failed: " . $userdb->connect_error);
    }


    //get message id
    $counting = "select * from message";
    $result = $userdb->query($counting);
    while ($row = $result->fetch_assoc()) {
        $count++;
    }
    $message_id = $count;

    if (empty($_POST['name'])) {        //check empty, and only alphabets
        $invalid = 1;
        $nameErr = "Must enter name !";
    } else {
        $name = $_POST['name'];
        if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
            $nameErr = "The name cannot contain symbol and numbers!";
            $error = 1;
        }
    }
    if (empty($_POST['email'])) {   //must not be empty and follow the format
        $invalid = 1;
        $emailErr = "Must enter email !";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email must follow the email format!";
            $error = 1;
        }
    }
    if (empty($_POST['message'])) {     //Must not be empty
        $invalid = 1;
        $msgErr = "Must enter message !";
    } else {
        $message = $_POST['message'];
    }
    $status = "unsolved";


    if ($invalid == 0 && $error == 0) {     //if no invalid, insert into the table message with the values POST ed
        $userdb = new mysqli('localhost', 'root', '', 'assignment');
        if ($userdb->connect_error) {
            die("Connection failed: " . $userdb->connect_error);
        }
        $insert = "insert into message(message_id,mname, email,message,status)Values('{$message_id}','{$name}', '{$email}','{$message}','{$status}') ";
        $run = $userdb->query($insert);
        if ($run) {
            echo "<script type='text/javascript'>alert('Your message has been recorded !')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Failed to submit !')</script>";
        }
        $userdb->close();
    }
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">


    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="adminlogin.css" rel="stylesheet">
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />

    <title>Contact Us</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">
</head>


<body>
   
        
        <div class="form-row justify-content-lg-center">
            <div class="row">
                <form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="text-center mb-4">
                        <img class="mb-4" src="Bun/Logo.png" alt="" width="231" height="140">
                        <h1 class="h3 mb-3 font-weight-normal">Reach to Us</h1>
                        <p>Leave us a message</p>
                    </div>
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter name">
                        <span class="error"><?php echo $nameErr ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" name="email" class="form-control" id="email1" aria-describedby="email" placeholder="Enter email">
                        <small id="email" class="form-text text-muted text-light">We'll never share your email with anyone else.</small>
                        <span class="error"><?php echo $emailErr ?></span>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <input type="text" name="message" class="form-control" id="message" placeholder="message">
                        <span class="error"><?php echo $msgErr ?></span>
                    </div>

                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    

</body>
<?php
include 'footer.php'
?>

</html>