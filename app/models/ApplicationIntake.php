<?php

class ApplicationIntake extends \Eloquent {
	protected $fillable = [];

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }

    public function scopeGetRowByID($query,$id) {
        return $query->where('id','=',$id)->first();
    }
}