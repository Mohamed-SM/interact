<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesialite extends Model
{
    protected $fillable = [
        'name', 'filier_id',
    ];

    public function filier()
    {
        return $this->belongsTo(Filier::class);
    }

    public function accadimicyear()
    {
        return $this->hasMany(AccadimicYear::class);
    }
}
