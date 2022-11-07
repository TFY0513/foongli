<?php

//auto logout if inactivity
session_start();

$minutes = 10;
if (isset($_SESSION['time']) && (time() - $_SESSION['time'] > $minutes * 60)) {

    echo "<script type='text/javascript'>alert('Inactivity for 10 minutes, now auto logout !')</script>";
    header('location:adminlogout.php');
}
?>