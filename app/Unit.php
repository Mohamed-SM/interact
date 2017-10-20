<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'code', 'unit_type_id',
    ];

    public function unit_type()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function modules(){
        return $this->hasMany(Module::class);
    }
}
