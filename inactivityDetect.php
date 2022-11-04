<?php
//auto logout if inactivity
session_start();

$minutes = 10;
if (isset($_SESSION['time']) && (time() - $_SESSION['time'] > $minutes * 60)) {
    header('location:adminlogout.php');
  
} 
?>