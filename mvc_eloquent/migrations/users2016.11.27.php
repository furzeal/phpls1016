<?php
// Show errors
ini_set('display_errors', 1);

require_once dirname(__DIR__) . "/app/init.php";

$capsule = App::getCapsule();

$capsule->schema()->create('users', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('name');
    $table->integer('age');
    $table->text('description');
    $table->string('login')->unique();
    $table->string('password');
    $table->string('email');
    $table->timestamps();
});
