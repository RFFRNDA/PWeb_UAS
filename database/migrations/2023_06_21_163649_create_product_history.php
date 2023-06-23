<?php

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
        Schema::create('product_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('title_bfr');
            $table->string('slug_bfr');
            $table->string('description_bfr')->nullable();
            $table->double('price_bfr',10,2);
            $table->double('compare_price_bfr',10,2)->nullable();
            $table->foreignId('category_id_bfr')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id_bfr')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id_bfr')->nullable()->constrained()->onDelete('cascade');
            $table->enum('is_featured_bfr',['Yes','No'])->default('No');
            $table->string('sku_bfr');
            $table->string('barcode_bfr')->nullable();
            $table->enum('track_qty_bfr',['Yes','No'])->default('Yes');
            $table->integer('qty_bfr')->nullable();
            $table->integer('status_bfr')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_history');
    }
};
