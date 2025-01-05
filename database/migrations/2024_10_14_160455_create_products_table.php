<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->decimal('tax', 8, 2)->default(0.00);
            $table->enum('tax_type', ['inclusive', 'exclusive'])->default('inclusive');
            $table->decimal('discount', 8, 2)->default(0.00);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('cost', 8, 2)->default(0.00);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->integer('stock')->default(0);
            $table->boolean('is_variable')->default(false);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
