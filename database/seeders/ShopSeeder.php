<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $shop = new Shop();
            $shop->shop_name = $faker->company();
            $shop->address = $faker->address();
            $shop->email = $faker->unique()->safeEmail();

            // Download a random image from loremflickr.com and save it to storage/app/public/images
            $image = file_get_contents('https://loremflickr.com/320/240');
            $imageName = time() . '-' . $faker->word() . '.jpg';
            file_put_contents(storage_path('app/public/images/' . $imageName), $image);
            $shop->image = $imageName;

            $shop->save();
        }
    }
}
