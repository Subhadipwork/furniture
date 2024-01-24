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
            $table->foreignID('category_id')->constrained()->onDelete('cascade');
            $table->foreignID('subcategory_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('titel');
            $table->string('slug')->nullable();
            $table->text('short_description');
            $table->mediumText('description');
            $table->longText('specification');
            $table->double('price', 10, 2);
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
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
