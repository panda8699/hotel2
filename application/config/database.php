<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$active_record = TRUE;

$db['default'] = array(
    'dsn' => '',
    'hostname' => 'hoteldb.mysql.database.azure.com',
    'username' => 'tthanhtung92',
    'password' => 'abc@1234',
    'database' => 'hotel',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE,
    'ssl_key' => NULL,
    'ssl_cert' => NULL,
    'ssl_ca' => '/var/www/html/DigiCertGlobalRootCA.crt.pem',
    'ssl_capath' => NULL,
    'ssl_cipher' => NULL,
    'ssl_verify' => FALSE,
);