<?php
require_once __DIR__ . "/../vendor/autoload.php";
use JesusCalle\LogifyClient\Logify;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
function env($key){
    return $_ENV[$key];
}
Logify::debug("It works!");