<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDineInTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "dinein_transaction_id",
        "product_id",
        "quantity",
        "quantity_price",
    ];
}
