<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineInTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_name",
        "seat_id",
        "total_price",
    ];

    public function detailTrx()
    {
        return $this->hasMany(DetailDineInTransaction::class);
    }
}
