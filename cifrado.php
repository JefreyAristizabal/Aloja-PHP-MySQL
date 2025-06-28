<?php
$clave = hex2bin("14485940e7b744fc60867fcc77c96fe28c29cbe15a668ba6b4e7dc8bb38814e1");
$iv = openssl_random_pseudo_bytes(16);
$password = "adminpass";

$cifrado = openssl_encrypt($password, "aes-256-cbc", $clave, OPENSSL_RAW_DATA, $iv);
echo base64_encode($iv . $cifrado) . PHP_EOL;
