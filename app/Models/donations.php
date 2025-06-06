<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'amount', 'category', 'date', 'prefered_time', 'location', 'phone', 'status'];
    
    public function donor()
    {
    return $this->belongsTo(Donor::class);
    }

    public function volunteer()
    {
    return $this->belongsTo(Volunteer::class);
    }

}
