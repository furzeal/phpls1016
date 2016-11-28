<?php
// Show errors
ini_set('display_errors', 1);

require_once dirname(__DIR__) . "/app/init.php";

$capsule = App::getCapsule();

$capsule->schema()->create('photos', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('filename');
    $table->integer('id_user');
    $table->foreign('id_user')->references('id')->on('users');
    $table->timestamps();
});
