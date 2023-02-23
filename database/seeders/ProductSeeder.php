<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('products')->truncate();
        DB::table('product_images')->truncate();
        DB::table('attribute_product')->truncate();

        Product::factory()
            ->count(100)
            ->has(ProductImage::factory()->count(rand(2,4)), 'images')
            ->create();

        // $attributeValues = AttributeValue::all();

        // $sizeAttributeValuesIds = $attributeValues->where('attribute_id', 1)->pluck('id');
        // $colorAttributeValuesIds = $attributeValues->where('attribute_id', 2)->pluck('id');

        // Product::all()->each(function ($product) use ($sizeAttributeValuesIds, $colorAttributeValuesIds) {
        //     $randomSize = $sizeAttributeValuesIds->random(rand(1,3));
        //     $randomColor = $colorAttributeValuesIds->random(rand(1,3));
        //     $product->attributes()->attach($randomSize->toArray());
        //     $product->attributes()->attach($randomColor->toArray());
        // });

        Schema::enableForeignKeyConstraints();
    }
}
