<?php
namespace Shop;
// Show errors
ini_set('display_errors', 1);

require_once dirname(__DIR__) . "/app/init.php";

$capsule = App::getCapsule();

$capsule->schema()->create('products', function ($table) {
    $table->increments('id')->unsigned();
    $table->string('name');
    $table->text('description');
    $table->string('picture');
    $table->integer('price');
    $table->integer('id_category')->references('id')->on('categories');
    $table->timestamps();
});
