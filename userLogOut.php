<?php
//Logout clear cookie
  setcookie("username", "", time()-3600);
  header("Location:index.php");
?>