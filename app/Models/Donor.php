<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donor extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'location', 'phone'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
