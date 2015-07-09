<?php

class ModuleMarker extends \Eloquent {
	protected $fillable = [];
	protected $table = 'module_markers';

	    public function scopeGetNameByID($query,$id) {
            return $query->where('id','=',$id)->first()->name;
        }
}