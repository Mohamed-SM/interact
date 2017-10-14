<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{    
    public function year()
    {
        return $this->belongsTo('App\AccadimicYear','accadimic_year_id');
    }
}
