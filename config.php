<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
$db_name = substr($url["path"], 1);
$db_host = $url["host"];
$user = $url["user"];
$password = $url["pass"];
    
$dsn = "mysql:dbname=".$db_name.";host=".$db_host;

$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// ini_set('display_errors', 1);
// $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
// $db['dbname'] = ltrim($db['path'], '/');
// define('DSN', "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8");
// define('DB_USERNAME', $db['user']);
// define('DB_PASSWORD', $db['pass']);
// define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

// require_once(__DIR__ . '/functions.php');

// session_start();