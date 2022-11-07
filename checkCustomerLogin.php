<?php

if(empty($_SESSION['clientUsername'])){
       header('location:userLogOut.php');
}
?>