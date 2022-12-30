<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

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

    public function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function username(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
        );
    }
}
