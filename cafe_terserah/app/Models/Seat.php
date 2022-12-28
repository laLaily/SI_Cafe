<?php

namespace App\Models;

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
}
