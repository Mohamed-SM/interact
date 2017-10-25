<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $fillable = [
        'title','code', 'group_modul_id',
        'credits','coefficient',
        'time_course','time_td','time_tp',
        'controle','exame',
    ];

    public function group_modul()
    {
        return $this->belongsTo(Group_Modul::class,'group_modul_id');
    }
}
