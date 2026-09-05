<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('sku')->unique()->after('name');
            $table->text('description')->nullable()->after('sku');
            $table->decimal('price', 12, 2)->default(0)->after('description');
            $table->unsignedInteger('stock_quantity')->default(0)->after('price');
            $table->boolean('is_active')->default(true)->after('stock_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'sku',
                'description',
                'price',
                'stock_quantity',
                'is_active',
            ]);
        });
    }
};
