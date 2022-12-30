<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_name",
        "product_category",
        "product_price",
        "product_stock",
        "updater_id",
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "updater_id",
    ];

    public function detailProduct()
    {
        return $this->hasMany(DetailDineInTransaction::class);
    }

    public function productName(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
        );
    }
}
