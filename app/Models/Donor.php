<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donor extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'location', 'phone'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donor_id', 'user_id');
    }
}
