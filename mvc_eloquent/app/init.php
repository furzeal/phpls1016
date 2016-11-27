<?php
// Show errors
ini_set('display_errors', 1);

// Core
foreach (glob(__DIR__ . '/core/*.php') as $filename) {
    require_once $filename;
}
// Controllers
foreach (glob(__DIR__ . '/controllers/*.php') as $filename) {
    require_once $filename;
}
// Models
foreach (glob(__DIR__ . '/models/*.php') as $filename) {
    require_once $filename;
}

// Dependencies
require "../vendor/autoload.php";

// Create tables
//$model = new Model();
//$model::CreateUsers();
//$model::CreatePhotos();