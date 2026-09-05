<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Business Laptop Pro',
                'sku' => 'JKIT-LAP-001',
                'type' => 'Product',
                'description' => 'Professional laptop for business and accounting work.',
                'price' => 54999.00,
                'stock_quantity' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Wireless Office Keyboard',
                'sku' => 'JKIT-KEY-002',
                'type' => 'Product',
                'description' => 'Compact wireless keyboard for office workstations.',
                'price' => 1499.00,
                'stock_quantity' => 35,
                'is_active' => true,
            ],
            [
                'name' => '24-inch Business Monitor',
                'sku' => 'JKIT-MON-003',
                'type' => 'Product',
                'description' => 'Full HD monitor for productive office setups.',
                'price' => 8999.00,
                'stock_quantity' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Network Setup Service',
                'sku' => 'JKIT-SVC-004',
                'type' => 'Service',
                'description' => 'Professional small-office network installation service.',
                'price' => 12500.00,
                'stock_quantity' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Annual IT Support Plan',
                'sku' => 'JKIT-SVC-005',
                'type' => 'Service',
                'description' => 'Annual technical support and maintenance coverage.',
                'price' => 30000.00,
                'stock_quantity' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product,
            );
        }
    }
}
