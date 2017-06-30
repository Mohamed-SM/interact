<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
	protected $fillable = [
        'title', 'abreviation','faculte_id',
    ];

    public function faculte()
    {
    	return $this->belongsTo(Faculte::class);
    }
}
