<?php

include 'encryption.php';
include 'decryption.php';

$data="ewqeqwe";
echo "original: ".$data."</br>";
$encryp = encrpytion($data);

echo "encrpyted: ".$encryp[0]."</br>";

$decryp = decrpytion($encryp); 
echo "decrpyted: ".$decryp."</br>";
echo gettype((int)$decryp);
?>