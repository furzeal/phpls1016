<?php
namespace Shop;
// Show errors
ini_set('display_errors', 1);

require_once dirname(__DIR__) . "/app/init.php";

$capsule = App::getCapsule();

$capsule->schema()->create('categories', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('name');
    $table->string('type');
    $table->timestamps();
});
