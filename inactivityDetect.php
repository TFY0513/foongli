<?php

//auto logout if inactivity


$minutes = 10;

if (time() - $_SESSION['time'] > $minutes * 60) { //subtract new timestamp from the old one
    echo "<script type='text/javascript'>alert('Inactivity for 10 minutes, now auto logout !')</script>";
   header('location:adminlogout.php');
   
} else {
    $_SESSION['time'] = time(); //set new timestamp
}
?>