<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
