<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
	protected $fillable = [
        'grade_id','recruited_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
