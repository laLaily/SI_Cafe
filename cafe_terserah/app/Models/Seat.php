<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        "seat_number",
        "seat_type",
        "admin_id",
    ];

    protected $hidden = [
        "created_at",
        "updated_at",
        "admin_id",
    ];

    public function seatNumber()
    {
        return new Attribute(
            set: fn ($value) => strtoupper($value),
        );
    }

    public function seatType()
    {
        return new Attribute(
            set: fn ($value) => strtolower($value),
        );
    }
}
