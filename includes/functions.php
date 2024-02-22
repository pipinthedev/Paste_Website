<?php


require 'server/connect.php';



function generateUniqueId($length = 5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $uniqueId = '';
    for ($i = 0; $i < $length; $i++) {
        $uniqueId .= $characters[rand(0, $charactersLength - 1)];
    }
    return $uniqueId;
}

function encryptMessage($message, $key, $iv, $encrypt_method)
{
    $key = hash('sha256', $key);
    $iv = substr(hash('sha256', $iv), 0, 16);
    $encryptedMessage = openssl_encrypt($message, $encrypt_method, $key, 0, $iv);
    return base64_encode($encryptedMessage);
}


function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function calculateExpiry($expiry) {
    switch ($expiry) {
        case '1_hour':
            return date('Y-m-d H:i:s', strtotime('+1 hour'));
        case '1_day':
            return date('Y-m-d H:i:s', strtotime('+1 day'));
        case '1_week':
            return date('Y-m-d H:i:s', strtotime('+1 week'));
        case '1_month':
            return date('Y-m-d H:i:s', strtotime('+1 month'));
        case '1_year':
            return date('Y-m-d H:i:s', strtotime('+1 year'));
        case '10_years':
            return date('Y-m-d H:i:s', strtotime('+10 years'));
        default:
            return NULL;
    }
}


function decryptMessage($encryptedMessage, $key, $iv, $encrypt_method)
{
    $key = hash('sha256', $key);
    $iv = substr(hash('sha256', $iv), 0, 16);
    $output = openssl_decrypt(base64_decode($encryptedMessage), $encrypt_method, $key, 0, $iv);
    return $output;
}
