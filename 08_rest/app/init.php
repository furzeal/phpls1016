<?php
namespace Shop;
// Show errors
ini_set('display_errors', 1);
// Dependencies
require_once dirname(__DIR__) . "/vendor/autoload.php";

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
