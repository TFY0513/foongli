<?php
session_start();
if (isset($_POST['submit'])) {
    $otp = $_SESSION["otp"];
    if ($_POST["otp"] == $otp) {
        include_once 'database.php';
        $userID = $_SESSION["userID"];
        $verified = "yes";
        $stmt = $database->prepare("update user_table set verified = ? where userID= ?");

        $stmt->bind_param("si", $verified, $userID);

        $stmt->execute();

        $stmt->close();

        $database->close();



        header("Location:memberlogin.php");
    } else {
        echo "<script type='text/javascript'>    alert('Invalid OTP !')</script>";
    }
}
?>



<form method="post" section="<?php echo $_SERVER['PHP_SELF'] ?>">
    <label for="username">Verification</label>
    <input type="text" id="username" class="form-control" maxlength="6" placeholder="Enter otp" name="otp" value="" required autofocus>
    <br/> <a href="register_member.php">Back</a>      

    <button class="btn btn-lg btn-primary " type="submit" name="submit">Confirm</button>
</form>