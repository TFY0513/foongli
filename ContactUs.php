<?php
//Leave a message function
session_start();
$count = 1;
$message_id = 0;
$invalid = 0;
$status = "";
$msg = $nameErr = $emailErr = $msgErr = "";
if (isset($_POST['submit'])) {

    $userdb = new mysqli('localhost', 'root', '', 'foongli');
    if ($userdb->connect_error) {
        die("Connection failed: " . $userdb->connect_error);
    }


    //get message id
    $counting = "select * from feedback_table";
    $result = $userdb->query($counting);
    while ($row = $result->fetch_assoc()) {
        $count++;
    }
    $message_id = $count;


    if (empty($_POST['name'])) {//validate name
        $invalid = 1;
    } else {
        $name = $_POST['name'];
        if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
            $nameErr = "The name cannot contain symbol and numbers!";
            $invalid = 1;
        }
    }
	if (empty($_POST['name'])) {//validate name
        $invalid = 1;
    } else {
        $name = $_POST['name'];
        if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
            $nameErr = "The name cannot contain symbol and numbers!";
            $invalid = 1;
        }
    }
	
    /*if (empty($_POST['email'])) { //validate email
        $invalid = 1;
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "email must follow the email format!";
            $invalid = 1;
        }
    }
	*/
    if (empty($_POST['content'])) {//check if empty message
        $invalid = 1;
    } else {
        $content = $_POST['content'];
    }

    $status = "unsolve";

    if ($invalid == 1) {//if invalid, pop error message
        echo "<script type='text/javascript'>alert('Error !')</script>";
    }
    if ($invalid == 0) {//if no invalid fields, connect to database and add value to the table of message.
        $userdb = new mysqli('localhost', 'root', '', 'foongli');
        if ($userdb->connect_error) {
            die("Connection failed: " . $userdb->connect_error);
        }


        $insert = "insert into feedback_table(feedbackID, name,contactNum,content)Values('{$feedbackID}','{$userID}', '{$contactNum}','{$content}') ";
        $run = $userdb->query($insert);
        if ($run) {
            echo "<script type='text/javascript'>alert('Sucessfuly !')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Failed to submit !')</script>";
        }

        $userdb->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">


    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Contact Us</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include 'topnav.php';
    ?>
    <div class="header">
        <h2 class="title">Contact Us</h2>
    </div>
    <div class="#">
        <h2 class="text-lg-left" style="padding: 15px;">Contact Number</h2>
        <hr class="divider">
        <div class="row">
            <div class="col-md-4"><img src="Bun/WhatsApp.svg" alr="#" style="max-width: 70%;max-height: 70%"> </div>
            <div class="col-md-8">

                <ul class="links">
                    <li><a href="https://api.whatsapp.com/send?phone=+60174975833&text=I%27m%20interested%20to%20place%20an%20order"> 017-4975833 (Mrs.Ngoh)</a> </li>
                    <li> <a href="https://api.whatsapp.com/send?phone=+60124711751&text=I%27m%20interested%20to%20place%20an%20order">012-4711751 (Mr.Ding)</li>
                    <li><a href="https://api.whatsapp.com/send?phone=+601128963566&text=I%27m%20interested%20in%20your%20car%20for%20sale">04-7625995 (Office)</a></li>
                </ul>
            </div>

        </div>
        <hr class="divider">
        <h2 class="text-lg-left" style="padding: 15px;">Business opening</h2>
        <div class="row">
            <div class="col-md-4"><img src="Bun/open.jpg" alt="#" style="max-width: 70%;max-height: 70%"></div>
            <div class="col-md-8">
                <ul class="links">
                    <li><strong>Working days : </strong>Every day(except 1st & 15th in Lunar calender)</li>
                    <li><strong>Business hour : </strong> 8:00am - 4:00pm</li>
                </ul>
            </div>
        </div>
        <hr class="divider">
        <!--   button of reach to us-->
        <div class="row">
            <div class="col-md-4">
                <img src="Bun/contact.jpg" alt="" style="max-width: 70%;max-height: 70%">

            </div>
            <div class="col-md-8" text-center style="padding-left: 55px;">

                <h3>Feel free to leave a message for us by clicking the button below.</h3><br><br>

                <button onclick="document.location = 'reachPage.php'" class="btn-lg btn-primary text-center"> Reach to Us</button>
            </div>

        </div>


    </div>

</body>
<?php
include 'footer.php';
?>

</html>