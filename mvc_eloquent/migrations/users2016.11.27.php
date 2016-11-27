<?php
require_once "../app/init.php";

Connection::capsule::schema()->create('users', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('name');
    $table->integer('age');
    $table->text('description');
    $table->string('login')->unique();
    $table->string('password');
    $table->string('email');
    $table->timestamps();
});
