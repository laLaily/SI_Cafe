<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineinTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_name",
        "seat_id",
        "total_price"
    ];

    public $timestamps = false;

    public function detailTrx()
    {
        return $this->hasMany(DetailDineInTransaction::class);
    }

    public function customerName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
        );
    }
}
