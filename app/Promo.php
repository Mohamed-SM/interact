<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['accadimic_year_id','university_year_id'];

    public function accadimic_year()
    {
        return $this->belongsTo(AccadimicYear::class,'accadimic_year_id');
    }

    public function university_year()
    {
        return $this->belongsTo(UniversityYear::class,'university_year_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
