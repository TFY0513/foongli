<?php

session_start();          // Start the session
$_SESSION['student'] = array(); // Makes the session an array
$student_name = array(1, "food", "snack", 2, 2.00, 4.00); //student_name form field name
$student_city = array(2, "snak", "snack", 3, 1.00, 3.00);   //city_id form field name
array_push($_SESSION['student'], $student_name, $student_city);

// echo sizeOf($_SESSION['cart']);

for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
    for ($j = 0; $j < 6; $j++) {
        echo $_SESSION['cart'][$i][$j]." | ";
    }
}
 echo"<br/>new: <br/>";
unset($_SESSION['cart'][1]); // remove item at index 0
$_SESSION['cart'] = array_values($_SESSION['cart']); // 'reindex' array
for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
    for ($j = 0; $j < 6; $j++) {
        echo $_SESSION['cart'][$i][$j]." | ";
    }
}

// print_r($_SESSION['student']);
?>
