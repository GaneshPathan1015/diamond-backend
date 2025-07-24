<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $i) {
            $masterSku = $faker->uuid;

            foreach (range(1, rand(3, 4)) as $j) {
                DB::table('products')->insert([
                    'products_name' => $faker->words(3, true),
                    'products_description' => $faker->paragraph,
                    'products_short_description' => $faker->sentence,
                    'available' => $faker->randomElement(['Yes', 'No']),
                    'products_quantity' => $faker->numberBetween(1, 100),
                    'products_model' => $faker->bothify('Model-###??'),
                    'products_sku' => $faker->bothify('SKU-###??'),
                    'master_sku' => $masterSku,
                    'products_price' => $faker->randomFloat(2, 10, 1000),
                    'products_weight' => $faker->randomFloat(2, 1, 100),
                    'products_status' => $faker->boolean,
                    'products_slug' => $faker->slug,
                    'vendor_id' => $faker->numberBetween(1, 10),
                    'country_of_origin' => $faker->numberBetween(1, 200),
                    'products_tax' => $faker->randomFloat(2, 0, 20),
                    'is_bestseller' => $faker->boolean,
                    'is_featured' => $faker->boolean,
                    'is_new' => $faker->boolean,
                    'products_meta_title' => $faker->sentence,
                    'products_meta_description' => $faker->paragraph,
                    'products_meta_keyword' => implode(', ', $faker->words(5)),
                    'date_added' => now(),
                    'date_updated' => now(),
                ]);
            }
        }
    }
}
