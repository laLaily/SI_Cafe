<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        "username",
        "password",
    ];

    protected $hidden = [
        "passowrd",
    ];

    public $timestamps = false;

    public function seat()
    {
        return $this->hasMany(Seat::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
