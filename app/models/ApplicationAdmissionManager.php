<?php

class ApplicationAdmissionManager extends \Eloquent {
	protected $fillable = [];

    public function scopeGetNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->name;
    }

    public function scopeGetExportNameByID($query,$id) {
        return $query->where('id','=',$id)->first()->export_name;
    }
}