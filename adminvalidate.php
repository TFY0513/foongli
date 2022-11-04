<?php

session_start();
$found = false;
//Validate admin login by reading in the database under the table of adminlogin
//--sanitize input--//
$username = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
//-------------------//
//--hashing--//
$hashpassword = hash('sha512', $password);
//-------------------//

include_once 'database.php';

//echo "$username<br/>$hashpassword";
//-----parameter bidniing on sql statement(prevent sql injecction)----------//
$stmt = $database->prepare("select * from admin_table where password=? and username=?");
$stmt->bind_param("ss", $hashpassword, $username);
//-------------------//


$stmt->execute();
$result = $stmt->get_result();

if ($result) {

    while ($row = $result->fetch_assoc()) {
        if ($row['password'] == $hashpassword && $row['username'] == $username) {
            //  echo $row['password'];

            $found = true;
            $_SESSION['time'] = time();
            $_SESSION['username'] = $username;
            
            setcookie('username', $username);
            header("Location: adminpage.php");
        }
    }
}

if (!$found) {

    $_SESSION["error"] = "Invalid username or password!";
    header("Location: adminlogin.php");
}



$database->close();
