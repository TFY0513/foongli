<!DOCTYPE html>
<?php
//delete message, CRUD
$feedbackID = $_REQUEST['feedbackID'];
$userID = $_REQUEST['userID'];
$contactNum = $_REQUEST['contactNum'];
$content = $_REQUEST['content'];

?>
<?php
$invalid = 0;
$statusErr = "";
//delete 
if (isset($_POST['submit'])) {//Delete row from the table with the query

    $userdb = new mysqli('localhost', 'root', '', 'foongli');
    if ($userdb->connect_error) {
        die("Connection failed: " . $userdb->connect_error);
    }

    $delete = "delete from feedback_table where feedbackID='$feedbackID'";
    $run = $userdb->query($delete);
    if ($run) {
        echo "<script type='text/javascript'> alert('Message deleted sucess !')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Failed to delete message !') </script>";
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

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <style>
        .contact-container {
            background-color: #F0F8FF;
            padding: 20px;
            height: 60%;
        }
    </style>
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <title>Delete message</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">
    <link rel="stylesheet" href="bs/bootstrap.min.css">
    <script src="bs/bootstrap.min.js"></script>
</head>

<body>
    <div class="header">
        <h2 class="title">Delete message</h2>
    </div>
    <?php
    include 'adminnav.php';
    ?>
    <div class="contact-container form-horizontal">

        <form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="col-sm-10">

                <div class="form-group">
                    <label class="control-label col-sm-2">Feedback ID</label>
                    <input type="text" name="feedbackID" disabled value="<?php echo $feedbackID ?>"><br>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">User ID</label>
                    <input type="text" name="userID" disabled value="<?php echo $userID ?>"><br>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Contact Number</label>
                    <input type="text" name="contactNum" disabled value="<?php echo $contactNum ?>"><br>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">content</label>
                    <input type="text" name="content" disabled value="<?php echo $content ?>"><br>

                </div>
            </div>

            <span><?php echo $statusErr; ?></span><br>
            <input type="submit" value="Delete" name="submit" class="btn btn-primary">
            <?php
            echo "<div class='back'>  [<a  href='ReachToUs.php' >Back to Feedback</a>] </div>";
            ?>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>