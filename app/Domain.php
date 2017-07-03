<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name', 'code',
    ];

    public function filier(){
        return $this->hasMany(Filier::class);
    }

    public function addFilier(Filier $filier){
        $this->filier()->save($filier);
    }

    public function accadimicyear()
    {
        return $this->hasMany(AccadimicYear::class);
    }
}
