<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use app\core;
require_once '../app/init.php';
//
$connection = new core\Connection();
//var_dump($connection);
$capsule = $connection->capsule;
$capsule::schema()->create('photos', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('filename');
    $table->foreign('id_user')->references('id')->on('users');
    $table->timestamps();
});
