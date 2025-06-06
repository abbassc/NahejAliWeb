<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Volunteer  extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'availability', 'location', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
