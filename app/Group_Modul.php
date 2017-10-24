<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_Modul extends Model
{
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function modules(){
        return $this->hasMany(Module::class);
    }
}
