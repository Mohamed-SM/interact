<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculte extends Model
{
    protected $fillable = [
        'title', 'abreviation',
    ];
}
