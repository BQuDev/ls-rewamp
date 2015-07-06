<?php

class UserMoreDetail extends \Eloquent {
	protected $fillable = [];
	protected $table = "users_more_details";

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }
}