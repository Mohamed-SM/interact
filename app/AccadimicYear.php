<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccadimicYear extends Model
{
    protected $fillable = [
        'year','grade','study_year','domaine_id','filier_id', 'spesialite_id','deparemnet_id',
    ];

    public function domaine()
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

    public function deparemnet()
    {
        return $this->belongsTo(Departement::class);
    }

}
