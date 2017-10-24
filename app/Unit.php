<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'code', 'unit_type_id','canva_id',
    ];

    public function unit_type()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function canva()
    {
        return $this->belongsTo(Canva::class);
    }

    public function group_models(){
        return $this->hasMany(Group_Modul::class);
    }
}
