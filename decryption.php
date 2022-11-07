<?php

function decrpytion($encrypted, $encryption_iv) {

    // Store cipher method
    $ciphering = "BF-CBC";

// Use OpenSSl encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    $decryption_iv = random_bytes($iv_length);

// Store the decryption key
    $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

// Descrypt the string
    $decryption = openssl_decrypt($encrypted, $ciphering,
            $decryption_key, $options, $encryption_iv);

    return $decryption;
}

?>
