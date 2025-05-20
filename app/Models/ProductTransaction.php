<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'transaction_status_id',
        'customer_id',
        'quantity', 
        'date_created'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function transactionStatus() {
        return $this->belongsTo(transactionStatus::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
