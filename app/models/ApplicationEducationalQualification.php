<?php

class ApplicationEducationalQualification extends \Eloquent {
	protected $fillable = [];
    protected $table='application_educational_qualifications';

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }
}