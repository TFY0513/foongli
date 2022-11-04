<!DOCTYPE html>

<?php

//DEMONSRATE CRUD

$feedbackID = $_REQUEST['feedbackID'];
$userID = $_REQUEST['userID'];
$contactNum = $_REQUEST['contactNum'];
$content = $_REQUEST['content'];
?>
<?php
$invalid = 0;
$statusErr = "";
//update
if (isset($_POST['submit'])) {
   /* if (empty($_POST['status'])) {
        $invalid = 1;
        $statusErr = 'This field is required !';
    } else {
        $status = $_POST['status'];
        if ($status == "") {
            $invalid = 1;
            $statusErr = 'This field is required !';
        }
    }
	*/
    if ($invalid == 0) {
        $userdb = new mysqli('localhost', 'root', '', 'foongli');
        if ($userdb->connect_error) {
            die("Connection failed: " . $userdb->connect_error);
        }

        $update = "update message set status='{$status}' where feedbackID='$feedbackID'";
        $run = $userdb->query($update);
        if ($run) {
            echo "<script type='text/javascript'>    alert('Sucessfuly update status !') </script>";
        } else {
            echo "<script type='text/javascript'>    alert('Failed to update status !') </script>";
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
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
    <script src="bs/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
    <style>
        .contact-container {
            background-color: #F0F8FF;
            padding: 20px;
            height: 60%;

        }
    </style>
    <link href="bs/bootstrap.css" rel="stylesheet" type="text/css" />
    <title>Edit status</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale =1">

</head>

<body>
    <div class="header">
        <h2 class="title">Edit status</h2>
    </div>

    <?php
    include 'adminnav.php';
    ?>
    <div class="contact-container form-horizontal">

        <form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="col-sm-10">
                <div class="form-group">
                    <label class="control-label col-sm-2">Feedback ID</label>
                    <input type="text" name="feedbackID" disabled value="<?php echo $feedbackID ?>"><br></div>

                <div class="form-group">
                    <label class="control-label col-sm-2">User ID</label>
                    <input type="text" name="userID" disabled value="<?php echo $userID ?>"><br>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Contact Number</label>
                    <input type="text" name="contactNum" disabled value="<?php echo $contactNum ?>"><br>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Content</label>
                    <input type="text" name="Content" disabled value="<?php echo $Content ?>"><br>
                </div>
 /*
            <div class="form-group">
                <label class="control col-sm-2">Status</label>

                <select name="status">
                    <option value="">Choose one </option>
                    <option value="solved" <?php
                                            if (!empty($_POST['submit'])) {
                                                if ($currentStatus == 'solved')
                                                    echo 'selected';
                                            } else {
                                                if ($currentStatus == 'solved') {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>>Solved</option>
                    <option value="unsolved" <?php
                                                if (!empty($_POST['submit'])) {
                                                    if ($currentStatus == 'unsolved')
                                                        echo 'selected';
                                                } else {
                                                    if ($currentStatus == 'unsolved') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>>Unsolved</option>
                </select>
            </div>
			*/	
            <span><?php echo $statusErr; ?></span><br>
            </div>
            <input type="submit" value="update" name="submit" class="btn btn-primary">
            <?php
            echo "<div class='back'>  [<a  href='ReachToUs.php' >Back to Feedback</a>] </div>";
            ?>
        </form>
    </div>
</body>

</html>