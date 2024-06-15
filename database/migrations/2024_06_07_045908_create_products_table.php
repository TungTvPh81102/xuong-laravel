<?php

use App\Models\Catalogue;
use App\Models\Catelogue;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Catalogue::class)->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('image_thumbnail')->nullable();
            $table->double('price_regular');
            $table->double('price_sale')->nullable();
            $table->text('description')->nullable();
            $table->string('marterial')->nullable()->comment('Chất liệu');
            $table->text('user_manval')->nullable()->comment('Hướng dẫn sử dụng');
            $table->unsignedBigInteger('view')->default(0);
            $table->enum('status', [Product::STATUS_DRAFT, Product::STATUS_PENDING, Product::STATUS_PUBLISH])->default(Product::STATUS_PENDING);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_good_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_show_home')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
