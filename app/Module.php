<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $fillable = [
        'title','code', 'unit_id',
        'credits','coefficient',
        'time_course','time_td','time_tp',
        'controle','exame',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
