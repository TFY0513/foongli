<?php
$database = new mysqli('localhost', 'root', '', 'foongli');
if ($database->connect_error) {
     die("Connection failed: " . $database->connect_error);
}
?>