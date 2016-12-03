<?php
require_once dirname(__DIR__) . "/app/init.php";
$capsule = Shop\App::getCapsule();
// category
for($i=0;$i<5;$i++)
{
    $faker = Faker\Factory::create();
    $category = new Shop\Models\Category;
    $category->name = $faker->word;
    $category->type = $faker->word;
    $category->created_at = $faker->dateTime;
    $category->save();
}
// products
for($i=0;$i<30;$i++)
{
    $faker = Faker\Factory::create();
    $product = new Shop\Models\Product;
    $product->name = $faker->word;
    $product->description = $faker->paragraph;
    $product->price = $faker->numberBetween(500,25000);
    $product->id_category = $faker->numberBetween(1,5);
    $product->created_at = $faker->dateTime;
    $product->save();
}