<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => '1518388381.gif',
            'name' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '9.99'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => '1518388381.gif',
            'name' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '9.99'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => '1518388381.gif',
            'name' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '9.99'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => '1518388381.gif',
            'name' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '9.99'
        ]);

        $product->save();
    }
}
