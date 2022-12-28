<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_name",
        "reservation_date",
        "total_person",
    ];

    public $timestamps = false;

    public function dineinTrxx()
    {
        return $this->belongsTo(DineInTransaction::class);
    }
}
