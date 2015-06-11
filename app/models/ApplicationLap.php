<?php

class ApplicationLap extends \Eloquent {
	protected $fillable = [];

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }

}