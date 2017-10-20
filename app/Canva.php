<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canva extends Model
{
    protected $fillable = [
        'semesters_id', 'started_at',
    ];

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
    }
    
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
