<?php

class StaticDataStatus extends \Eloquent {
	protected $fillable = [];
    protected  $table ='static_data_status';

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }
}