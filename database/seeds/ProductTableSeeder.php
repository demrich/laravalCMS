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
            'imagePath' => 'http://via.placeholder.com/250x300',
            'title' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '00.00'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://via.placeholder.com/250x300',
            'title' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '00.00'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://via.placeholder.com/250x300',
            'title' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '00.00'
        ]);

        $product->save();
        $product = new \App\Product([
            'imagePath' => 'http://via.placeholder.com/250x300',
            'title' => 'Example Text',
            'description' => 'example description. please fill a real description later',
            'price' => '00.00'
        ]);

        $product->save();
    }
}
