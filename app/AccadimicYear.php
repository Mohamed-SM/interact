<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccadimicYear extends Model
{
    protected $fillable = [
        'year','grade','study_year','domain_id','filier_id', 'spesialite_id','departement_id',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function filier()
    {
        return $this->belongsTo(Filier::class);
    }

    public function spesialite()
    {
        return $this->belongsTo(Spesialite::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
