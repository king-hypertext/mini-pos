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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('market_price', 10);
            $table->decimal('price', 10);
            $table->bigInteger('quantity')->default(0);
            $table->string('image')->nullable();
            $table->date('expiry_date')->nullable();
            $table->foreignId('product_status_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            // $table->unsignedBigInteger('product_status_id')->default(1);
            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('brand_id');
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
