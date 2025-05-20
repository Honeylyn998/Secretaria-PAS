<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

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
            $table->string('description');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });

        $products = [
            [
                'name' => 'Gold Ring',
                'description' => '14K gold ring with small diamond',
                'quantity' => 10,
                'price' => 5000.00,
            ],
            [
                'name' => 'Electric Guitar',
                'description' => 'Yamaha Pacifica, red finish, with soft case',
                'quantity' => 10,
                'price' => 7500.00,
            ],
            [
                'name' => 'LED TV',
                'description' => 'Samsung 32-inch Smart LED TV, 1080p',
                'quantity' => 10,
                'price' => 6800.00,
            ],
        ];

        foreach($products as $product) {
            Product::create($product);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
