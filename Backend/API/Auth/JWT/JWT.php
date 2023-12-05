<?php

require '../../../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$sec_key = '3465lofi';

$payload = array(
    'isd' => 'localhost',
    'aud' => 'localhost',
    'username' => 'chahine',
    'password' => 'chahine'
);

$encode = JWT::encode($payload, $sec_key, 'HS256');

$headers = getallheaders(); 

if(isset($headers['Authorization'])){
    $token = $headers['Authorization'];

    try {
        $decode = JWT::decode($token, new Key($sec_key, 'HS256'), ['HS256']);
        print_r($decode);
    } catch (\Firebase\JWT\ExpiredException $e) {
        echo 'Token has expired';
    } catch (\Exception $e) {
        echo 'Invalid token';
    }
} else {
    echo 'Authorization header not found';
}

echo $encode;
