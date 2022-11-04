<?php
//connnect database, testing
$connection = mysqli_connect("localhost", "root", "","assignment");

if($connection === false){
    die("Could not connect to the database. ". mysqli_connect_error());
}

?>