<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filier extends Model
{
    protected $fillable = [
        'name', 'domain_id',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function spesialite(){
        return $this->hasMany(Spesialite::class);
    }
}
