<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDineinTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "dinein_id",
        "product_id",
        "quantity",
        "quantity_price",
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function dinein()
    {
        return $this->belongsTo(DineInTransaction::class, 'dinein_transaction_id', 'id');
    }
}
