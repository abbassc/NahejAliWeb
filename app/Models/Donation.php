<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'donor_id',
        'volunteer_id',
        'status',
        'description',
        'location',
        'pickup_time',
        'message'
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }
} 