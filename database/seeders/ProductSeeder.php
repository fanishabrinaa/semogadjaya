<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $kopi    = Category::where('name', 'Kopi')->first();
        $nonKopi = Category::where('name', 'Non Kopi')->first();
        $dessert = Category::where('name', 'Dessert')->first();

        $products = [
            ['Espresso',   'Kopi hitam pekat dengan rasa kuat.',      15000, 20000, '1778678616.png', $kopi],
            ['Cafe Latte', 'Espresso lembut dengan susu segar.',      22000, 27000, '1778679118.png', $kopi],
            ['Matcha',     'Matcha creamy dengan susu.',              24000, 29000, '1778679139.png', $nonKopi],
            ['Brownies',   'Brownies cokelat lembut untuk teman kopi.', 18000, 18000, '1778679234.png', $dessert],
        ];

        foreach ($products as [$name, $desc, $regular, $large, $image, $category]) {
            Product::create([
                'name'          => $name,
                'description'   => $desc,
                'price_regular' => $regular,
                'price_large'   => $large,
                'image'         => $image,
                'category_id'   => $category->id,
            ]);
        }
    }
}