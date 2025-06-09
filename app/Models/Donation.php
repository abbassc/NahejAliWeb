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
        'title',
        'category',
        'amount',
        'description',
        'location',
        'phone',
        'date',
        'prefered_time',
        'status',
        'message'
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'user_id');
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'user_id');
    }
} 