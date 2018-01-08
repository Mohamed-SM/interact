<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
