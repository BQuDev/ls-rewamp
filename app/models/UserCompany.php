<?php

class UserCompany extends \Eloquent {
	protected $fillable = [];
	protected $table = "users_companies";

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }
}