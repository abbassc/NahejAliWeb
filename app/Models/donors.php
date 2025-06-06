<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $fillable = ['location', 'phone'];
    
    public function user()
    {
    return $this->belongsTo(User::class, 'id');
    }

    public function donations()
    {
    return $this->hasMany(Donation::class);
    }
}
