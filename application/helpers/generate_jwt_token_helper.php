<?php

require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

function get_jwt_config_value($key)
{
    $config_path = APPPATH . 'config/jwt_config.php';
    $config = include $config_path;
    return $config[$key] ?? null;
}

function generate_jwt_token($sessiondata)
{
    $secret_key = get_jwt_config_value('jwt_secret_key');
    $userID = $sessiondata['UserID'] ?? null;
    $userName = $sessiondata['UserName'] ?? null;
    $userEmail = $sessiondata['UserEmail'] ?? null;

    if (!$secret_key) {
        throw new Exception('Secret key not found in config.');
    }

    $issued_at = time();
    $not_before = $issued_at;
    $expire = $issued_at + 3600; // 1 giờ

    $payload = array(
        "iat" => $issued_at,
        "nbf" => $not_before,
        "exp" => $expire,
        "data" => array(
            "UserID" => $userID,
            "UserName" => $userName,
            "UserEmail" => $userEmail
        )
    );

    $jwt = JWT::encode($payload, $secret_key, 'HS256');

    return $jwt;
}
