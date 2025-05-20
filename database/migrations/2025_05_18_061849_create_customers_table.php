<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number')->unique();
            $table->timestamps();
        });

        $customers = [
            [
                'created_by' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'x9E4u@example.com',
                'phone_number' => '1234567890',
            ],
            [
                'created_by' => 1,
                'first_name' => 'Jane',
                'last_name' => 'Doe',
                'email' => 'x9E4u@example.com',
                'phone_number' => '1234567860',
            ]
        ];

        foreach($customers as $customer) {
            Customer::create($customer);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
