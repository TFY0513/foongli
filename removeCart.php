<?php 
// remove from cary by running query based on the value passed

   $username=$_REQUEST['Username'];
   $ID=$_REQUEST['ID'];

  $db = new mysqli('localhost','root','', 'assignment');   
            
   if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
   } 
      $delete = "delete from shopcart where username='$username' AND ID = '$ID'";        
      $check = $db->query($delete);
   
   header("Location: shopcart.php");
   $db -> close();
?>