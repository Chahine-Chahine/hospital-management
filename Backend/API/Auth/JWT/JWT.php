<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
use Firebase\JWT\JWT;

function generateJWT($payload) {
    $sec_key = '3465lofi';
    return JWT::encode($payload, $sec_key, 'HS256');
}
