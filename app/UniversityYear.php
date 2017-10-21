<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityYear extends Model
{
    protected $fillable = [
        'year'
    ];

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }
}
