<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker -> name,
        'description' => $faker -> paragraph(1),
        'quantity' => $faker -> numberBetween(1,10),
        'status' => $faker ->randomElement([Product::PRODUCTO_DISPONIBLE,Product::PRODUCT_NO_DISPONIBLE]),
        'seller_id' => factory(User::class)->create()->id,
        'image' => $faker->imageUrl(),
    ];
});
