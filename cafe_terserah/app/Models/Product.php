<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_name",
        "product_price",
        "admin_id",
    ];

    protected $hidden = [
        "crated_at",
        "updated_at",
        "admin_id",
    ];

    public function detailProduct()
    {
        return $this->hasMany(DetailDineInTransaction::class);
    }
}
