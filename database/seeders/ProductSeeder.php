<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();


        Tag::factory(15)->create();

        // S, X, M, L, XL
        foreach (['S', 'X', 'M', 'L', 'XL'] as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        // Color 
        foreach (['blue', 'black', 'green'] as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        // Product 
        for ($i = 0; $i < 1000; $i++) {
            $name = fake()->text(100);
            Product::query()->create([
                'catalogue_id' => rand(1, 4),
                'brand_id' => rand(1, 2),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(8) . $i,
                'image_thumbnail' => 'https://beautybox.com.vn/products/tinh-chat-chong-lao-hoa-ahc-youth-focus-essence-30ml',
                'price_regular' => 350000,
                'price_sale' => 250000,
            ]);
        }

        for ($i = 0; $i < 1001; $i++) {
            ProductGallery::query()->insert([
                [
                    'product_id' => $i,
                    'image' => 'https://beautybox.com.vn/products/tinh-chat-chong-lao-hoa-ahc-youth-focus-essence-30ml',
                ],
                [
                    'product_id' => $i,
                    'image' => 'https://image.hsv-tech.io/600x600/bbx/common/ad6c3f65-9338-4ca1-ba55-d12b60e27cb1.webp'
                ]
            ]);
        }

        for ($i = 1; $i < 4; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i, 'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i, 'tag_id' => rand(9, 15)
                ],
            ]);
        }

        for ($productID = 0; $productID < 1001; $productID++) {
            $data = [];
            for ($sizeID = 0; $sizeID < 6; $sizeID++) {
                for ($colorID = 0; $colorID < 4; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://image.hsv-tech.io/600x600/bbx/common/913b95a2-bd08-42bc-b037-32db9c4fe146.webp'
                    ];
                }
            }

            DB::table('product_variants')->insert($data);
        }
    }
}
